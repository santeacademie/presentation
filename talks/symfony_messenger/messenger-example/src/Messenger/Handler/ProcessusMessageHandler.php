<?php

namespace App\Messenger\Handler;

use App\Entity\Processus;
use App\Messenger\Message\ProcessusMessage;
use App\Service\ServiceWhoDoSomething;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ProcessusMessageHandler
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ServiceWhoDoSomething  $service,
    )
    {
    }

    public function __invoke(ProcessusMessage $message): void
    {
        $processus = $message->getProcessus();
        $processus = $this->entityManager->getRepository(Processus::class)->find($processus->getId());

        try {
            $this->service->do();
        } catch (\Exception) {
            return;
        }

        $processus->setDone(true);

        $this->entityManager->flush();
    }
}