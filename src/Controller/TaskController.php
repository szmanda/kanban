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
    #[Route('/', name: 'app_task')]
    public function index(TaskRepository $rep): Response
    {
        $tasks = $rep->findAll();
        return $this->render('task/index.html.twig', [
            'title' => 'Tasks',
            'tasks' => $tasks,
        ]);
    }

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

    #[Route('/search', methods: ['GET'], name: 'app_task_search')]
    public function search(Request $request, TaskRepository $rep): Response
    {
        $query = (string) $request->query->get('q', '');
        $limit = (int) $request->query->get('l', 10);

        if (!$request->isXmlHttpRequest()) {
            return $this->render('task/search.html.twig', ['query' => $query]);
        }

        $foundTasks = $rep->findBySearchQuery($query, $limit);

        $results = [];
        foreach ($foundTasks as $task) {
            /** @var string $title */
            $title = $task->getTitle();

            // /** @var string $summary */
            // $summary = $post->getSummary();

            /** @var string $summary */
            $url = $this->generateUrl('app_main_task_view', ['id' => $task->findMainTask()->getId()]);

            $results[] = [
                'title' => htmlspecialchars($title, \ENT_COMPAT | \ENT_HTML5),
                'url' => $url,
            ];
        }

        return $this->json($results);
    }
}
