<?php

namespace App\Messenger\Serializer;

use App\Messenger\Contract\JsonSerializableInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface as TransportSerializerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class JsonSerializer implements TransportSerializerInterface
{
    public function __construct(
       private readonly SerializerInterface $serializer,
    ) {
    }

    public function decode(array $encodedEnvelope): Envelope
    {
        $className = $encodedEnvelope['headers']['type'];

        if (!class_exists($className)) {
            throw new \LogicException(sprintf('No class "%s" found for message.', $className));
        }

        $message = $this->serializer->deserialize($encodedEnvelope['body'], $className, 'json');


        return new Envelope($message);
    }

    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();

        if (!$message instanceof JsonSerializableInterface) {
            throw new \LogicException(sprintf('The message must implement "%s".', JsonSerializableInterface::class));
        }

        return [
            'body' => $this->serializer->serialize($message, 'json'),
            'headers' => [
                'type' => $message->getJsonType(),
            ],
        ];
    }
}