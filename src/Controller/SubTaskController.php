<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SubTaskRepository;
use App\Repository\MainTaskRepository;
use App\Entity\SubTask;
use App\Form\SubTaskType;
use App\Entity\Task;

#[Route('/sub_task')]
class SubTaskController extends AbstractController
{
    #[Route('/', name: 'app_sub_task')]
    public function index(SubTaskRepository $rep): Response
    {
        $subTasks = $rep->findAll();
        return $this->render('sub_task/index.html.twig', [
            'title' => 'SubTask',
            'sub_tasks' => $subTasks,
        ]);
    }

    #[Route('/new/{mainTaskId}', name: 'app_sub_task_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, MainTaskRepository $repMainTask, int $mainTaskId = null): Response
    {
        $subTask = new SubTask();
        $mainTask = $repMainTask->findOneById($mainTaskId);
        $subTask->setMainTask($mainTask);

        $form = $this->createForm(SubTaskType::class, $subTask);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $subTask = $form->getData();
            // title is a field of Task entity, creating it now
            $title = $form->get('title')->getData();
            $task = new Task();
            $task->setTitle($title);
            $task->setSubTask($subTask);
            $entityManager->persist($task);

            $entityManager->persist($subTask);
            $entityManager->flush();

            return $this->redirectToRoute('app_main_task_view', array( 'id' => $subTask->getMainTask()->getId() ));
        }

        return $this->render('sub_task/new.html.twig', [
            'title' => 'New SubTask',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_sub_task_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, SubTask $subTask): Response
    {
        $task = $subTask->getTask();
        $form = $this->createForm(SubTaskType::class, $subTask);
        // handling title separately, since it's on a different entity (Task)
        $form->get('title')->setData($task->getTitle());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $subTask = $form->getData();
            // handling title separetely
            $title = $form->get('title')->getData();
            $task->setTitle($title);
            $entityManager->persist($task);
            $entityManager->persist($subTask);
            $entityManager->flush();

            return $this->redirectToRoute('app_main_task_view', array( 'id' => $subTask->getMainTask()->getId() ));
        }

        return $this->render('sub_task/new.html.twig', [
            'title' => 'Edit Main Task',
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_sub_task_delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager, SubTask $subTask): Response
    {
        $mainTaskId = $subTask->getMainTask()->getId();
        $entityManager->remove($subTask);
        $entityManager->flush();
        return $this->redirectToRoute('app_main_task_view', array("id" => $mainTaskId));
    }
}
