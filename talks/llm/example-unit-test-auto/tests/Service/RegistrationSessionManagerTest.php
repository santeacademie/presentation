<?php

use App\Customer\Entity\Registration;
use App\Accounting\Service\PaymentOrchestrator;
use App\Catalog\Entity\Session;
use App\Catalog\Repository\SessionRepository;
use App\Customer\Service\RegistrationSessionManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Santeacademie\BusinessLogic\Customer\Select\SelectRegistrationStatus;

class RegistrationSessionManagerTest extends TestCase
{
    private $entityManager;
    private $sessionRepository;
    private $eventDispatcher;
    private $paymentOrchestrator;
    private $registrationSessionManager;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->sessionRepository = $this->createMock(SessionRepository::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->paymentOrchestrator = $this->createMock(PaymentOrchestrator::class);

        $this->registrationSessionManager = new RegistrationSessionManager(
            $this->entityManager,
            $this->sessionRepository,
            $this->eventDispatcher,
            $this->paymentOrchestrator
        );
    }

    public function testGuessSessionAssignationOnRegistration() 
    {
        $registration = new Registration();

        $this->sessionRepository->expects($this->once())
            ->method('findForRegistrationOneOrNull')
            ->willReturn(new Session());

        $this->assertIsBool($this->registrationSessionManager->guessSessionAssignationOnRegistration($registration));
    }

    public function testAssignSessionOnRegistration() 
    {
        $registration = new Registration();
        $session = new Session();

        $this->assertIsBool($this->registrationSessionManager->assignSessionOnRegistration($registration, $session, 100));
    }

    public function testIsRegistrationSessionAssignable() 
    {
        $registration = new Registration();
        $registration->setProduct(new Product());
        $registration->setStatus(SelectRegistrationStatus::$DRAFT);

        $this->assertTrue($this->registrationSessionManager->isRegistrationSessionAssignable($registration)->isTrue());
    }

    public function testIsRegistrationSessionEditable() 
    {
        $registration = new Registration();
        $registration->setProduct(new Product());
        $registration->setStatus(SelectRegistrationStatus::$DRAFT);
        $registration->setStartDateWanted(new \DateTime());

        $this->assertIsBool($this->registrationSessionManager->isRegistrationSessionEditable($registration));
    } 

    public function testIsRegistrationMatchingSession() 
    {
        $registration = new Registration();
        $session = new Session();
        $product = new Product();

        $registration->setProduct($product);
        $session->setCourse($product->getCourse());

        $this->assertTrue($this->registrationSessionManager->isRegistrationMatchingSession($registration, $session)->isTrue());
    }  
}
?>
