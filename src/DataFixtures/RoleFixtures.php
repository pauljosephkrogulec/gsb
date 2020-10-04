<?php


namespace App\DataFixtures;


use App\Entity\Roles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $roleParcAuto = new Roles();
        $roleParcAuto->setSlug("ROLE_PARC_AUTO")
            ->setName("Gestion Parc Auto");
        $manager->persist($roleParcAuto);
        $this->addReference("ROLE_PARC_AUTO", $roleParcAuto);

        $roleVisiteur = new Roles();
        $roleVisiteur->setSlug("ROLE_VISITEUR")
            ->setName("Visiteur");
        $manager->persist($roleVisiteur);
        $this->addReference("ROLE_VISITEUR", $roleVisiteur);
        $manager->flush();
    }
}