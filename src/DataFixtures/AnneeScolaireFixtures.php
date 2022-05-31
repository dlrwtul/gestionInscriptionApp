<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AnneeScolaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $annee = new AnneeScolaire;
        $annee->setLibelle("2021/2022")
                ->setEtat("en cours");
        $manager->persist($annee);
        $manager->flush();
    }
}
