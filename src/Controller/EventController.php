<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EventRepository;
use App\Entity\Event;
use App\Form\EventType;
use App\Entity\MainTask;
use App\Entity\Task;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event')]
    public function index(EventRepository $rep): Response
    {
        $events = $rep->findAll();
        return $this->render('event/index.html.twig', [
            'title' => 'Event',
            'events' => $events,
        ]);
    }

    #[Route('/new', name: 'app_event_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();
            // title is a field of Task entity, creating it now
            $title = $form->get('title')->getData();
            $task = new Task();
            $task->setTitle($title);
            $task->setEvent($event);
            $entityManager->persist($task);

            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event');
        }

        return $this->render('event/new.html.twig', [
            'title' => 'New Event',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_event_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Event $event): Response
    {
        $task = $event->getTask();
        $form = $this->createForm(EventType::class, $event);
        // handling title separately, since it's on a different entity (Task)
        $form->get('title')->setData($task->getTitle());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();
            // handling title separetely
            $title = $form->get('title')->getData();
            $task->setTitle($title);
            $entityManager->persist($task);
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event');
        }

        return $this->render('event/new.html.twig', [
            'title' => 'Edit Main Task',
            'form' => $form,
        ]);
    }
}
