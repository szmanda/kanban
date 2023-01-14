<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\StatusRepository;
use App\Entity\Status;
use App\Form\StatusType;
use App\Repository\BoardRepository;

#[Route('/status')]
class StatusController extends AbstractController
{
    #[Route('/', name: 'app_status')]
    public function index(StatusRepository $rep): Response
    {
        $statuses = $rep->findAll();
        return $this->render('status/index.html.twig', [
            'title' => 'Statuses',
            'statuses' => $statuses,
        ]);
    }

    /// accepts *optional parameter board
    #[Route('/new/{boardId}', name: 'app_status_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, BoardRepository $repBoard, int $boardId = null): Response
    {
        $status = new Status();
        $board = $repBoard->findOneById($boardId);
        $status->setBoard($board);

        $form = $this->createForm(StatusType::class, $status);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $status = $form->getData();

            $entityManager->persist($status);
            $entityManager->flush();

            if ($status->getBoard() != null) return $this->redirectToRoute('app_board_view', array( "id" => $status->getBoard()->getId() ));
            return $this->redirectToRoute('app_status');
        }

        return $this->render('status/new.html.twig', [
            'title' => 'New Status',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_status_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Status $status): Response
    {
        $form = $this->createForm(StatusType::class, $status);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $status = $form->getData();

            $entityManager->persist($status);
            $entityManager->flush();

            return $this->redirectToRoute('app_status');
        }

        return $this->render('status/new.html.twig', [
            'title' => 'New Status',
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_status_delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager, Status $status): Response
    {
        $boardId = $status->getBoard()->getId();
        $entityManager->remove($status);
        $entityManager->flush();
        return $this->redirectToRoute('app_board_view', array("id" => $boardId));
    }
}
