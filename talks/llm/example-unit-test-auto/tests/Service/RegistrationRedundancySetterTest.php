<?php

use PHPUnit\Framework\TestCase;
use App\Customer\Service\RegistrationRedundancySetter;
use App\Customer\Entity\Registration;

class RegistrationRedundancySetterTest extends TestCase
{
    private $redundancySetter;

    protected function setUp(): void
    {
        $this->redundancySetter = new RegistrationRedundancySetter();
    }

    public function testSetAllRedundanciesOnRegistration()
    {
        $registration = $this->createMock(Registration::class);
        $result = $this->redundancySetter->setAllRedundanciesOnRegistration($registration);
        $this->assertInstanceOf(Registration::class, $result);
    }

    public function testSetCourseDurationOnRegistration()
    {
        $registration = $this->createMock(Registration::class);
        $result = $this->redundancySetter->setCourseDurationOnRegistration($registration);
        $this->assertInstanceOf(Registration::class, $result);
    }

    public function testSetPriceOnRegistration()
    {
        $registration = $this->createMock(Registration::class);
        $registration->method('getPrice')
            ->willReturn(null);
        $result = $this->redundancySetter->setPriceOnRegistration($registration);
        $this->assertInstanceOf(Registration::class, $result);
    }

    public function testSetFeesOnRegistration()
    {
        $registration = $this->createMock(Registration::class);
        $result = $this->redundancySetter->setFeesOnRegistration($registration);
        $this->assertInstanceOf(Registration::class, $result);
    }

    public function testSetPartnerFeesOnRegistration()
    {
        $registration = $this->createMock(Registration::class);
        $result = $this->redundancySetter->setPartnerFeesOnRegistration($registration);
        $this->assertInstanceOf(Registration::class, $result);
    }

    public function testSetTrainerFeesOnRegistration()
    {
        $registration = $this->createMock(Registration::class);
        $result = $this->redundancySetter->setTrainerFeesOnRegistration($registration);
        $this->assertInstanceOf(Registration::class, $result);
    }
}
?>
