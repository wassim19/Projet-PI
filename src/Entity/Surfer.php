<?php

namespace App\Entity;

use App\Repository\SurferRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SurferRepository::class)
 */
class Surfer
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
    private $name;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */

    private $first_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $emailadress;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $password;


    public function getId(): ?int
    {
        return $this->id;
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




    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(?int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getEmailadress(): ?string
    {
        return $this->emailadress;
    }

    public function setEmailadress(?string $emailadress): self
    {
        $this->emailadress = $emailadress;

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

}
