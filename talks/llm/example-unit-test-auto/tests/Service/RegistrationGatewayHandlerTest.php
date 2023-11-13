<?php

namespace Tests\App\Customer\Service;

use App\Customer\Entity\Registration;
use App\Customer\Service\RegistrationGatewayHandler;
use PHPUnit\Framework\TestCase;

class RegistrationGatewayHandlerTest extends TestCase
{
    private string $url;
    private RegistrationGatewayHandler $registrationGatewayHandler;

    protected function setUp(): void
    {
        $this->url = 'http://example.com';
        $this->registrationGatewayHandler = new RegistrationGatewayHandler($this->url);
    }

    public function testGenerateResumeRegistrationUrl(): void
    {
        $uuid = 'test-uuid';
        $registration = $this->createMock(Registration::class);

        $registration->method('getUuid')
            ->willReturn($uuid);

        $expectedUrl = $this->url . "/resume/" . $uuid;

        $this->assertSame(
            $expectedUrl,
            $this->registrationGatewayHandler->generateResumeRegistrationUrl($registration)
        );
    }
}

?>
