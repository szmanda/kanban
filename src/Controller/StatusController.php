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

    #[Route('/new', name: 'app_status_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $status = new Status();

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
}
