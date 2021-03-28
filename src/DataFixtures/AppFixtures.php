<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project
            ->setTitle("PAKI PAKI")
            ->setDescription("Création d'un site de livraison de repas")
            ->setLink("https://github.com/maxencele2001/ProjetTechnoWeb.git");
        $manager->persist($project);

        $manager->flush();
    }
}
