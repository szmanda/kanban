<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MainTaskRepository;
use App\Entity\MainTask;
use App\Form\MainTaskType;
use App\Entity\Task;

#[Route('/main_task')]
class MainTaskController extends AbstractController
{
    #[Route('/', name: 'app_main_task')]
    public function index(MainTaskRepository $rep): Response
    {
        $mainTasks = $rep->findAll();
        return $this->render('main_task/index.html.twig', [
            'title' => 'MainTask',
            'main_tasks' => $mainTasks,
        ]);
    }

    #[Route('/new', name: 'app_main_task_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mainTask = new MainTask();

        $form = $this->createForm(MainTaskType::class, $mainTask);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mainTask = $form->getData();
            // title is a field of Task entity, creating it now
            $title = $form->get('title')->getData();
            $task = new Task();
            $task->setTitle($title);
            $task->setMainTask($mainTask);
            $entityManager->persist($task);

            $entityManager->persist($mainTask);
            $entityManager->flush();

            return $this->redirectToRoute('app_main_task');
        }

        return $this->render('main_task/new.html.twig', [
            'title' => 'New MainTask',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_main_task_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, MainTask $mainTask): Response
    {
        $task = $mainTask->getTask();
        $form = $this->createForm(MainTaskType::class, $mainTask);
        // handling title separately, since it's on a different entity (Task)
        $form->get('title')->setData($task->getTitle());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mainTask = $form->getData();
            // handling title separetely
            $title = $form->get('title')->getData();
            $task->setTitle($title);
            $entityManager->persist($task);
            $entityManager->persist($mainTask);
            $entityManager->flush();

            return $this->redirectToRoute('app_main_task');
        }

        return $this->render('main_task/new.html.twig', [
            'title' => 'Edit Main Task',
            'form' => $form,
        ]);
    }
}
