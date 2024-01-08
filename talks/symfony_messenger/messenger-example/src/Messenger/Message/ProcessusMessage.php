<?php

namespace App\Messenger\Message;

use App\Entity\Processus;

class ProcessusMessage
{
    public function __construct(
       private readonly Processus $processus,
    ) {
    }

    public function getProcessus(): Processus
    {
        return $this->processus;
    }
}