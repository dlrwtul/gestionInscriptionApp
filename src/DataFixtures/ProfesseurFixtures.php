<?php

namespace App\DataFixtures;

use App\Entity\Module;
use App\Entity\Professeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $modules = array("PHP","JS","Html/Css","Java","Symfony","Laravel","UML");
        for ($i=0; $i < 25; $i++) { 

            $professeur = new Professeur();
            $professeur->setNomComplet("Professeur ".$i);
            $professeur->setGrade("Grade".$i);

            for ($j=0; $j <3 ; $j++) { 
                $rnd = rand(0,24);
                $professeur->addClass($this->getReference("classe".$rnd));
            }

            for ($k=0; $k < 3; $k++) { 
                $rnd = rand(0,6);
                $newModule = new Module();
                $newModule->setLibelle($modules[$rnd]);
                $professeur->addModule($newModule);
            }
            $manager->persist($professeur);
        }
        
        
        $manager->flush();
    }
}
