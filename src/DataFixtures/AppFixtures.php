<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project
            ->setTitle("PAKI PAKI")
            ->setDescription("Création d'un site de livraison de repas")
            ->setLink("https://github.com/maxencele2001/ProjetTechnoWeb.git")
            ->setDisplay(true);
        $manager->persist($project);

        $user = new User();
        $user
            ->setEmail("a@a.com")
            ->setRoles(User::USER_ROLE[0])
            ->setPassword($this->encoder->encodePassword(
                $user,'toor'
            ));
        $manager->persist($user);

        $comment = new Comment();
        $comment
            ->setContent("Ceci est un simple commentaire")
            ->setProject($project)
            ->setUser($user)
            ->setDisplay(true);
        $manager->persist($comment);

        $reply = new Comment();
        $reply
            ->setContent("Ceci est une simple réponse")
            ->setProject($project)
            ->setUser($user)
            ->setDisplay(true)
            ->setRelated($comment);
        $manager->persist($reply);
        $manager->flush();
    }
}
