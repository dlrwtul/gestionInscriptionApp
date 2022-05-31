<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=1; $i <= 25 ; $i++) { 
            $module = new Module();
            $module->setLibelle("module".$i);
            $manager->persist($module);
        }
        $manager->flush();
    }
}
