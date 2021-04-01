<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)

 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"emailadresse"},
 * message="Already used")
 */

class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    public $Username;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    public $tax_registration_number;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $images; //fhmt chy chsar crash

    /**
     * @ORM\Column(type="string", length=240, nullable=true)

     * @Assert\Length(min="8",minMessage="your password must be at least 8 characters long")
     * @Assert\EqualTo(propertyPath="confirm_password",message="
    you did not type the same password")
     */

    private $password;
    /**

     * @Assert\EqualTo(propertyPath="password",message="
    you did not type the same password")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="integer", nullable=true)

     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     * @Assert\Email (
     *     message = "The emailadresse '{{ value }}' is not a valid emailadresse."
     * )

     */


    private $emailadresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)

     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)

     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setNameCompany(?string $Username): self
    {
        $this->Username= $Username;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTaxRegistrationNumber(): ?string
    {
        return $this->tax_registration_number;
    }

    public function setTaxRegistrationNumber(?string $tax_registration_number): self
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

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

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

    public function getEmailadresse(): ?string
    {
        return $this->emailadresse;
    }

    public function setEmailadresse(?string $emailadresse): self
    {
        $this->emailadresse = $emailadresse;

        return $this;
    }



    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    public function getRoles()
    {
        return['role'];
    }

}
