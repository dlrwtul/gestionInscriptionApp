<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant extends User
{

    #[ORM\Column(type: 'string', length: 2,nullable:false,unique:false)]
    #[Assert\NotBlank(message:"sexe obligatoire",)]
    private $sexe;

    #[ORM\Column(type: 'string', length: 50,nullable:false,unique:false)]
    #[Assert\NotBlank(message:"adresse obligatoire")]
    private $adresse;

    #[ORM\Column(type: 'string', length: 25,nullable:false,unique:true)]
    private $matricule;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Inscription::class)]
    private $inscriptions;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Demande::class)]
    private $demandes;


    public function __construct()
    {
        $this->setRoles(array("ROLE_ETUDANT"));
        $this->matricule = self::generateMatricule();
        $this->setPassword(substr($this->matricule,0,6));
        $this->inscriptions = new ArrayCollection();
        $this->demandes = new ArrayCollection();
    }


    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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
            $inscription->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEtudiant() === $this) {
                $inscription->setEtudiant(null);
            }
        }

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public static function generateMatricule(){
        $date = new \DateTime;
        $matricule = $date->format("h").$date->format("i").$date->format("s").$date->format("Y").$date->format("d").$date->format("m");
        return $matricule;
    }

    public static function generatePassword(){
        $matricule = self::generateMatricule();
        return substr($matricule,0,6);
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setEtudiant($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getEtudiant() === $this) {
                $demande->setEtudiant(null);
            }
        }

        return $this;
    }
}
