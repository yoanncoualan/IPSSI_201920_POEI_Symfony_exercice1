<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity("email")
 */
class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      allowEmptyString = false
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      allowEmptyString = false
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      allowEmptyString = false
     * )
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $inscription;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tache", mappedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $taches;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
        $this->inscription = new \DateTime();
    }

    public function __toString()
    {
        return $this->prenom .' '. $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getInscription(): ?\DateTimeInterface
    {
        return $this->inscription;
    }

    public function setInscription(\DateTimeInterface $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    /**
     * @return Collection|Tache[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
            $tach->setUtilisateur($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->contains($tach)) {
            $this->taches->removeElement($tach);
            // set the owning side to null (unless already changed)
            if ($tach->getUtilisateur() === $this) {
                $tach->setUtilisateur(null);
            }
        }

        return $this;
    }
}
