<?php

namespace App\Messenger\Contract;

interface JsonSerializableInterface
{
    public function getJsonType(): string;
}