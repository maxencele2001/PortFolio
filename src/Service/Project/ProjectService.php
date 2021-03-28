<?php

namespace App\Service\Project;

use App\Repository\ProjectRepository;

class ProjectService{

    private $repoProject;

    public function __construct(ProjectRepository $repoProject)
    {
        $this->repoProject = $repoProject;
    }
    public function getProjects()
    {
        $projects = $this->repoProject->findAllVisible();
        return $projects;
    }
}