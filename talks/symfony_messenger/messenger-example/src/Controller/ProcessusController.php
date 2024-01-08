<?php

namespace App\Controller;

use App\Entity\Processus;
use App\Messenger\Message\ProcessusApiMessage;
use App\Messenger\Message\ProcessusMessage;
use App\Service\ServiceWhoDoSomething;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProcessusType;

class ProcessusController extends AbstractController
{
    public function __construct(
        readonly private ServiceWhoDoSomething $service,
        readonly private EntityManagerInterface $entityManager,
        readonly private MessageBusInterface $bus
    ) {
    }

    #[Route('/', name: 'slow')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ProcessusType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            /** @var Processus $processus */
            $processus = $form->getData();

            $this->entityManager->persist($processus);
            $this->entityManager->flush();

            try {
                $this->service->do();
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
                return $this->render('processus/index.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            $processus->setDone(true);

            $this->entityManager->flush();

            $this->addFlash('success', 'Processus terminé');

        }

        return $this->render('processus/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/messenger', name: 'messenger')]
    public function faster(Request $request): Response
    {
        $form = $this->createForm(ProcessusType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            /** @var Processus $processus */
            $processus = $form->getData();

            $this->entityManager->persist($processus);
            $this->entityManager->flush();

            $this->bus->dispatch(new ProcessusMessage($processus));

            $this->addFlash('success', 'Processus en cours de traitement');
        }

        return $this->render('processus/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/api/messenger', name: 'api_messenger')]
    public function apiMessenger(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $message = new ProcessusApiMessage($json['operation']);
        $envelope = new Envelope($message, [
            new DelayStamp(5000)
        ]);

        $this->bus->dispatch($envelope);

        return $this->json('processus en cours de traitement');
    }
}
