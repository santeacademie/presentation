<?php

namespace App\Customer\Service;

use App\Customer\Entity\Registration;
use Santeacademie\BusinessLogic\Customer\Select\SelectRegistrationCancellationReason;
use Santeacademie\BusinessLogic\Customer\Select\SelectRegistrationStatusTransition;
use Symfony\Component\Workflow\WorkflowInterface;

class RegistrationBulkCancellationHelper
{
    public function __construct(private WorkflowInterface $registrationStatusStateMachine)
    {
    }

    /**
     * @param array|Registration[] $registrations
     * @param string $cancellationReason
     * @return array|Registration[]
     */
    public function bulkCancellation(array $registrations, string $cancellationReason): array
    {
        foreach ($registrations as $registration) {
            try {
                $this->registrationStatusStateMachine->apply($registration, SelectRegistrationStatusTransition::$CANCELLATION);
                $registration->setCancellationReason(in_array($cancellationReason, SelectRegistrationCancellationReason::keys()) ? $cancellationReason : $registration->getCancellationReason());
            } catch (\Exception) {
                //
            }
        }

        return $registrations;
    }
}
