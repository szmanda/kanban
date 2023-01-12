<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BoardRepository;
use App\Entity\Board;
use App\Form\BoardType;

#[Route('/board')]
class BoardController extends AbstractController
{
    #[Route('/', name: 'app_board')]
    public function index(BoardRepository $rep): Response
    {
        $boards = $rep->findAll();
        return $this->render('board/index.html.twig', [
            'title' => 'Boards',
            'boards' => $boards,
        ]);
    }

    /// Board view including statuses and tasks 
    #[Route('/view/{id}', name: 'app_board_view')]
    public function view(BoardRepository $rep, Board $board): Response
    {
        return $this->render('board/view.html.twig', [
            'title' => 'Boards',
            'board' => $board,
        ]);
    }

    #[Route('/new', name: 'app_board_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $board = new Board();

        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $board = $form->getData();

            $entityManager->persist($board);
            $entityManager->flush();

            return $this->redirectToRoute('app_board');
        }

        return $this->render('board/new.html.twig', [
            'title' => 'New Board',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_board_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Board $board): Response
    {
        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $board = $form->getData();

            $entityManager->persist($board);
            $entityManager->flush();

            return $this->redirectToRoute('app_board');
        }

        return $this->render('board/new.html.twig', [
            'title' => 'New Board',
            'form' => $form,
        ]);
    }
}
