<?php

namespace App\Customer\Service;

use App\Customer\Entity\Registration;

class RegistrationRedundancySetter
{
    public function setAllRedundanciesOnRegistration(Registration $registration): Registration
    {
        $this->setPriceOnRegistration($registration);
        $this->setFeesOnRegistration($registration);
        $this->setCourseDurationOnRegistration($registration);

        return $registration;
    }

    public function setCourseDurationOnRegistration(Registration $registration): Registration
    {
        return $registration->setCourseDuration($registration->getProduct()->getCourse()->getDuration());
    }

    public function setPriceOnRegistration(Registration $registration): Registration
    {
        if (null === $registration->getPrice()) {
            $registration->setPrice($registration->getProduct()->getPrice());
        }

        return $registration;
    }

    public function setFeesOnRegistration(Registration $registration): Registration
    {
        $this->setPartnerFeesOnRegistration($registration);
        $this->setTrainerFeesOnRegistration($registration);

        return $registration;
    }

    public function setPartnerFeesOnRegistration(Registration $registration): Registration
    {
        $registration->setPartnerFees($registration->getProduct()->getCourse()->getPartnerFees());

        return $registration;
    }

    public function setTrainerFeesOnRegistration(Registration $registration): Registration
    {
        foreach ($registration->getProduct()->getCourse()->getCourseTrainers() as $courseTrainer) {
            $registration->setTrainerFees($courseTrainer->getTrainer()->getCode(), $courseTrainer->getTrainerFees());
        }

        return $registration;
    }
}
