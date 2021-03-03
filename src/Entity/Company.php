<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     * * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="Company")
     */
    private $name_company;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tax_registration_number;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $localisation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCompany(): ?string
    {
        return $this->name_company;
    }

    public function setNameCompany(?string $name_company): self
    {
        $this->name_company = $name_company;

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

    public function getTaxRegistrationNumber(): ?int
    {
        return $this->tax_registration_number;
    }

    public function setTaxRegistrationNumber(?int $tax_registration_number): self
    {
        $this->tax_registration_number = $tax_registration_number;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(?string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}
