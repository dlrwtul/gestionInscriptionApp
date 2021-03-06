<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends Personne
{
    #[ORM\Column(type: 'string', length: 25, nullable: false, unique: false)]
    #[Assert\NotBlank(message:"grade obligatoire")]
    private $grade;

    #[ORM\ManyToMany(targetEntity: Module::class, inversedBy: 'professeurs',cascade:['persist'])]
    #[Assert\NotBlank(message:"veuillez choisir au moins un module")]
    private $modules;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'professeurs')]
    #[Assert\NotBlank(message:"veuillez choisir au moins une classe")]
    private $classes;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }


    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        $this->modules->removeElement($module);

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        $this->classes->removeElement($class);

        return $this;
    }

    public static function getGrades():array 
    {
        return array("choisir grade" => null,"Licence" => "Licence","Master" => "Master","Docteur" => "Docteur","Ingenieur" => "Ingenieur","Technicien" => "Technicien");
    }
}
