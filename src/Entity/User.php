<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $namesociete;

    /**
     * @ORM\Column(type="float")
     */
    private $matriculefiscale;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $nomad;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $prenomadd;

    /**
     * @ORM\Column(type="float")
     */
    private $cin;

    /**
     * @ORM\Column(type="integer")
     */
    private $numtelad;

    /**
     * @ORM\Column(type="date")
     */
    private $datead;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $nomch;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $prenomcher;

    /**
     * @ORM\Column(type="integer")
     */
    private $cincher;

    /**
     * @ORM\Column(type="integer")
     */
    private $ntelcher;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $adressecher;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamesociete(): ?string
    {
        return $this->namesociete;
    }

    public function setNamesociete(string $namesociete): self
    {
        $this->namesociete = $namesociete;

        return $this;
    }

    public function getMatriculefiscale(): ?float
    {
        return $this->matriculefiscale;
    }

    public function setMatriculefiscale(float $matriculefiscale): self
    {
        $this->matriculefiscale = $matriculefiscale;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

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

    public function getNomad(): ?string
    {
        return $this->nomad;
    }

    public function setNomad(string $nomad): self
    {
        $this->nomad = $nomad;

        return $this;
    }

    public function getPrenomadd(): ?string
    {
        return $this->prenomadd;
    }

    public function setPrenomadd(string $prenomadd): self
    {
        $this->prenomadd = $prenomadd;

        return $this;
    }

    public function getCin(): ?float
    {
        return $this->cin;
    }

    public function setCin(float $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNumtelad(): ?int
    {
        return $this->numtelad;
    }

    public function setNumtelad(int $numtelad): self
    {
        $this->numtelad = $numtelad;

        return $this;
    }

    public function getDatead(): ?\DateTimeInterface
    {
        return $this->datead;
    }

    public function setDatead(\DateTimeInterface $datead): self
    {
        $this->datead = $datead;

        return $this;
    }

    public function getNomch(): ?string
    {
        return $this->nomch;
    }

    public function setNomch(string $nomch): self
    {
        $this->nomch = $nomch;

        return $this;
    }

    public function getPrenomcher(): ?string
    {
        return $this->prenomcher;
    }

    public function setPrenomcher(string $prenomcher): self
    {
        $this->prenomcher = $prenomcher;

        return $this;
    }

    public function getCincher(): ?int
    {
        return $this->cincher;
    }

    public function setCincher(int $cincher): self
    {
        $this->cincher = $cincher;

        return $this;
    }

    public function getNtelcher(): ?int
    {
        return $this->ntelcher;
    }

    public function setNtelcher(int $ntelcher): self
    {
        $this->ntelcher = $ntelcher;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getAdressecher(): ?string
    {
        return $this->adressecher;
    }

    public function setAdressecher(string $adressecher): self
    {
        $this->adressecher = $adressecher;

        return $this;
    }
}
