<?php

namespace App\Messenger\Message;

use App\Entity\Processus;
use App\Messenger\Contract\JsonSerializableInterface;

class ProcessusApiMessage implements JsonSerializableInterface
{
    public function __construct(
        public readonly string $operation,
    ) {
    }

    public function getJsonType(): string
    {
        return Processus::class;
    }
}