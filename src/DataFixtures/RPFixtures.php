<?php

namespace App\DataFixtures;

use App\Entity\AC;
use App\Entity\RP;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RPFixtures extends Fixture
{

    /**
     * @var UserPasswordHasherInterface
     */
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $rp = new RP();
        $rp->setNomComplet("Admin 07");
        $rp->setLogin("admin07@gmail.com");
        $hashed = $this->encoder->hashPassword($rp,"Admin07");
        $rp->setPassword($hashed);

        
        $manager->persist($rp);

        $ac = new AC();
        $ac->setNomComplet("Admin 09");
        $ac->setLogin("admin09@gmail.com");
        $hashedP = $this->encoder->hashPassword($ac,"Admin09");
        $ac->setPassword($hashedP);

        $manager->persist($ac);

        $manager->flush();
    }
}
