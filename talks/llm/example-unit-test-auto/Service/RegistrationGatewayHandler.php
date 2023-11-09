<?php

namespace App\Customer\Service;

use App\Core\Util\PathUtil;
use App\Customer\Entity\Registration;

class RegistrationGatewayHandler
{
    public function __construct(
        private string $santeacademieRegistrationGatewayServiceUrl
    ) {
    }

    public function generateResumeRegistrationUrl(Registration $registration): string
    {
        return sprintf('%s/resume/%s', PathUtil::withoutTrailingSlash($this->santeacademieRegistrationGatewayServiceUrl), $registration->getUuid());
    }
}
