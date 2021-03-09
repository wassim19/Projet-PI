<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 * @UniqueEntity(fields={"emailadresse"},
 * message="Already used")
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
   public $name_company;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
  public  $tax_registration_number;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $localisation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     * @Assert\Length(min="8",minMessage="your password must be at least 8 characters long")
     * @Assert\EqualTo(propertyPath="confirm_password",message="
    you did not type the same password")
     */
    private $pass;
    /**

     * @Assert\EqualTo(propertyPath="pass",message="
    you did not type the same password")
     */
    public $confirm_password;
    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     * @Assert\Email (
     *     message = "The emailadresse '{{ value }}' is not a valid emailadresse."
     * )
     */


    private $emailadresse;


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

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(?string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    public function getEmailadresse(): ?string
    {
        return $this->emailadresse;
    }

    public function setEmailadresse(?string $emailadresse): self
    {
        $this->emailadresse = $emailadresse;

        return $this;
    }/*
    public function eraseCredentials(){
    }
    public function getSalt(){}
    public function getRoles(){return['Role_company'];}*/
}
