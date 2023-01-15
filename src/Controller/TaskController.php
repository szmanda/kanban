<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TaskRepository;
use App\Entity\Task;
use App\Form\TaskUserType;

#[Route('/task')]
class TaskController extends AbstractController
{
    // #[Route('/', name: 'app_task')]
    // public function index(TaskRepository $rep): Response
    // {
    //     $tasks = $rep->findAll();
    //     return $this->render('task/index.html.twig', [
    //         'title' => 'Taskes',
    //         'tasks' => $tasks,
    //     ]);
    // }

    /// requires parameter task
    #[Route('/assign/{id}', name: 'app_task_assign')]
    public function assignUser(Request $request, EntityManagerInterface $entityManager, Task $task): Response
    {
        $form = $this->createForm(TaskUserType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $entityManager->persist($task);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_main_task_view', array( "id" => $task->findMainTask()->getId() ));
            
        }

        return $this->render('task/assign.html.twig', [
            'title' => 'Assign user',
            'task' => $task,
            'form' => $form,
        ]);
    }
}
