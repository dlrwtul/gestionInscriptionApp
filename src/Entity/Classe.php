<?php

namespace App\Entity;

use App\Entity\Professeur;
use App\Entity\Inscription;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 25, nullable: false, unique:true)]
    #[Assert\NotBlank(message:"nom de classe obligatoire")]
    #[Assert\Length(min:3,max:20)]
    private $libelle;

    #[ORM\Column(type: 'string', length: 25, nullable: false, unique: false)]
    #[Assert\NotBlank(message:"filiere obligatoire")]
    private $filiere;

    #[ORM\Column(type: 'string', length: 25, nullable: false, unique: false)]
    #[Assert\NotBlank(message:"niveau obligatoire")]
    private $niveau;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Inscription::class)]
    private $inscriptions;

    #[ORM\ManyToMany(targetEntity: Professeur::class, mappedBy: 'classes')]
    private $professeurs;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setClasse($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getClasse() === $this) {
                $inscription->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
            $professeur->addClass($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeClass($this);
        }

        return $this;
    }

    public static function getNiveaux():array 
    {
        return array("choisir niveau" => null,"L1" => "L1","L2" => "L2","L3" => "L3","M1" => "M1","M2" => "M2","D1" => "D1","D2" => "D2","D3" => "D3");
    }
    
    public static function getFilieres():array 
    {
        return array("choisir filiere" => null,"Dev Web/Mobile" => "Dev Web/Mobile","Dev Data" => "Dev Data","Ref Dig" => "Ref Dig");
    }

    public function __toString():string
    {
        return $this->getLibelle();
    }


}
