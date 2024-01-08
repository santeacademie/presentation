<?php

namespace App\Messenger\Handler;

use App\Entity\Processus;
use App\Messenger\Message\ProcessusApiMessage;
use App\Service\ServiceWhoDoSomething;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ProcessusApiMessageHandler
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ServiceWhoDoSomething  $service,
    )
    {
    }

    public function __invoke(Processus $message): void
    {
        try {
//            $this->service->do();
        } catch (\Exception) {
            return;
        }
        $message->setDone(true);

        $this->entityManager->persist($message);
        $this->entityManager->flush();
    }
}