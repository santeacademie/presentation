<?php

namespace App\Customer\Service;

use App\Accounting\Service\PaymentOrchestrator;
use App\Catalog\Entity\Session;
use App\Catalog\Repository\SessionRepository;
use Santeacademie\ExplainedCondition\ConditionList;
use App\Customer\Entity\Registration;
use Doctrine\ORM\EntityManagerInterface;
use App\Catalog\Event\Session\SessionAttachedOnRegistrationEvent;
use App\Catalog\Exception\NoSessionAvailableException;
use App\Customer\Exception\BadRegistrationSessionException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Customer\Exception\NotRegisterableRegistrationException;
use Santeacademie\BusinessLogic\Customer\Select\SelectRegistrationStatus;

class RegistrationSessionManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SessionRepository $sessionRepository,
        private EventDispatcherInterface $eventDispatcher,
        private PaymentOrchestrator $paymentOrchestrator
    ) {
    }

    public function guessSessionAssignationOnRegistration(Registration $registration): bool
    {
        return $this->assignOrGuessSessionOnRegistration($registration);
    }

    public function assignSessionOnRegistration(Registration $registration, Session $session, ?float $backedAmount = null): bool
    {
        return $this->assignOrGuessSessionOnRegistration($registration, $session, $backedAmount);
    }

    private function assignOrGuessSessionOnRegistration(Registration $registration, ?Session $session = null, ?float $backedAmount = null): bool
    {
        if (($conditionList = $this->isRegistrationSessionAssignable($registration))->isFalse()) {
            throw new NotRegisterableRegistrationException(sprintf(
                'L\'inscription n\'est pas assignable à une session.%s%s',
                PHP_EOL,
                $conditionList->stringifyResolvedConditions()
            ));
        }

        if (!is_null($session)) {
            if ($this->isRegistrationMatchingSession($registration, $session)->isFalse()) {
                throw new BadRegistrationSessionException(sprintf(
                    'La session et l\'inscription ne correspondent pas.%s%s',
                    PHP_EOL,
                    $conditionList->stringifyResolvedConditions()
                ));
            }
        } else {
            $session = $this->sessionRepository->findForRegistrationOneOrNull($registration);
        }

        if (is_null($session)) {
            throw new NoSessionAvailableException('Il n\'y a pas de session disponible pour cette inscription.');
        }

        $remainingDue = $this->paymentOrchestrator->getRemainingDueAmountForRegistration($registration);

        if (is_null($backedAmount)) {
            $backedAmount = $remainingDue;
        }

        $session->addRegistration($registration);

        $sessionAddRegistrationEvent = new SessionAttachedOnRegistrationEvent($session, $registration, $backedAmount);
        $this->eventDispatcher->dispatch($sessionAddRegistrationEvent);

        $this->entityManager->persist($registration);
        $this->entityManager->persist($session);

        return true;
    }

    public function isRegistrationSessionAssignable(Registration $registration): ConditionList
    {
        return ConditionList::AND([
            'Registration has a product' => !is_null($registration->getProduct()),
            'Registration doesn\'t have a session' => is_null($registration->getSession()),
            'Registration has start date wanted' => !is_null($registration->getStartDateWanted()),
            'Registration has draft status' => $registration->getStatus() === SelectRegistrationStatus::$DRAFT
        ]);
    }

    public function isRegistrationSessionEditable(Registration $registration): bool
    {
        $registrationIsDraftOrValidated = in_array($registration->getStatus(), [SelectRegistrationStatus::$DRAFT, SelectRegistrationStatus::$VALIDATED]);

        $registrationHasProduct = null !== $registration->getProduct();
        $productHasFunding = null !== $funding = $registration->getProduct()?->getFunding();

        $fundingAllowChangingSession = false;

        if ($registrationHasProduct && $productHasFunding) {
            $fundingAllowChangingSession = $funding->getAllowRegistrationToChangeSession();
        }

        $registrationHaveStartDate = !is_null($registration->getStartDateWanted());

        return $registrationIsDraftOrValidated && $fundingAllowChangingSession && $registrationHaveStartDate;
    }

    public function isRegistrationMatchingSession(Registration $registration, Session $session): ConditionList
    {
        $regProduct = $registration->getProduct();

        // Check if same course, same funding, same startDate
        return ConditionList::AND([
            'Course match' => $regProduct->getCourse() === $session->getCourse(),
            'Funding match' => $regProduct->getFunding() === $session->getFunding(),
            'Start Date match' => $registration->getStartDateWanted()->format('Y-m-d') === $session->getStartDate()->format('Y-m-d'),
        ]);
    }
}
