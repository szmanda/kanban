<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProjectRepository;
use App\Entity\Project;
use App\Form\ProjectType;

#[Route('/project')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_project')]
    public function index(ProjectRepository $rep): Response
    {
        $projects = $rep->findAll();
        return $this->render('project/index.html.twig', [
            'title' => 'Projects',
            'projects' => $projects,
        ]);
    }

    /// MainTask view including subtasks 
    #[Route('/view/{id}', name: 'app_project_view')]
    public function view(ProjectRepository $rep, Project $project): Response
    {
        return $this->render('project/view.html.twig', [
            'title' => 'Project',
            'project' => $project,
        ]);
    }

    #[Route('/new', name: 'app_project_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();

            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project');
        }

        return $this->render('project/new.html.twig', [
            'title' => 'New Project',
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_project_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();

            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_project');
        }

        return $this->render('project/new.html.twig', [
            'title' => 'New Project',
            'form' => $form,
        ]);
    }
}
