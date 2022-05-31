<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $filiere = array("Dev Web/Mobile","Dev Data","Ref Dig");
        $niveaux = array("L1","L2","L3");
        for ($i=0; $i < 25 ; $i++) { 
            $rnd = rand(0,2);
            $classe = new Classe();
            $classe->setLibelle($niveaux[$rnd]." ".$filiere[$rnd])
            ->setFiliere($filiere[$rnd])
            ->setNiveau($niveaux[$rnd]);
            $this->setReference("classe".$i,$classe);
            $manager->persist($classe);
        }
        $manager->flush();
    }
}
