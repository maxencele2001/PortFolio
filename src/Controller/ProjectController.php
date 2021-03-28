<?php

namespace App\Controller;

use App\Entity\Project;
use App\Service\Project\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projects", name="project.all")
     */
    public function index(ProjectService $serviceProject): Response
    {
        $projects = $serviceProject->getProjects();
        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    /**
     * @Route ("/projects/{slug}-{id}", name="project.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function showOne(Project $project, string $slug): Response
    {
        if($project->getSlug()!== $slug){
            return $this->redirectToRoute('project.show',[
                'id'=> $project->getId(),
                'slug'=> $project->getSlug()
            ],301);
        }
        return $this->render('project/project.html.twig', [
            'project' => $project,
        ]);
    }
}
