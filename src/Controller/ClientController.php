<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ClientRepository;
use App\Entity\Client;
use App\Form\ClientType;

#[Route('/client')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client')]
    public function index(ClientRepository $rep): Response
    {
        $clients = $rep->findAll();
        return $this->render('client/index.html.twig', [
            'title' => 'Clients',
            'clients' => $clients,
        ]);
    }

    #[Route('/new', name: 'app_client_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();

            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_client');
        }

        return $this->render('client/new.html.twig', [
            'title' => 'New Client',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_client_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();

            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_client');
        }
        // for now, reusing the same template as for 'new'
        return $this->render('client/new.html.twig', [
            'title' => 'Client',
            'form' => $form,
        ]);
    }
}
