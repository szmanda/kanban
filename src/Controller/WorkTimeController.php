<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\WorkTimeRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\Entity\WorkTime;
use App\Form\WorkTimeType;

#[Route('/worktime')]
class WorkTimeController extends AbstractController
{
    #[Route('/', name: 'app_work_time')]
    public function index(WorkTimeRepository $rep): Response
    {
        $workTimes = $rep->findAll();
        return $this->render('work_time/index.html.twig', [
            'title' => 'WorkTime',
            'work_times' => $workTimes,
        ]);
    }

    /// requires taskId
    #[Route('/new/{taskId}/{userId}', name: 'app_work_time_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        TaskRepository $repTask,
        UserRepository $repUser,
        int $taskId = null,
        int $userId = null
    ): Response {
        $workTime = new WorkTime();
        $task = $repTask->findOneById($taskId);
        $workTime->setTask($task);
        $user = $repUser->findOneById($userId);
        $workTime->setWorkBy($user);

        dump($task);
        dump($user);

        $form = $this->createForm(WorkTimeType::class, $workTime);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $workTime = $form->getData();

            $entityManager->persist($workTime);
            $entityManager->flush();

            return $this->redirectToRoute('app_main_task_view', array('id' => $workTime->getTask()->findMainTask()->getId()));
        }

        return $this->render('work_time/new.html.twig', [
            'title' => 'New WorkTime',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_work_time_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, WorkTime $workTime): Response
    {
        $form = $this->createForm(WorkTimeType::class, $workTime);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $workTime = $form->getData();

            $entityManager->persist($workTime);
            $entityManager->flush();

            return $this->redirectToRoute('app_work_time');
        }

        return $this->render('work_time/new.html.twig', [
            'title' => 'New WorkTime',
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_work_time_delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager, WorkTime $workTime): Response
    {
        $taskId = $workTime->getTask()->getId();
        $entityManager->remove($workTime);
        $entityManager->flush();
        return $this->redirectToRoute('app_work_time');
    }
}
