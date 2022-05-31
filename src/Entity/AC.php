<?php

namespace App\Entity;

use App\Repository\ACRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ACRepository::class)]
class AC extends User
{
    
    public function __construct()
    {
        $this->roles[] = "ROLE_AC";
    }

}
