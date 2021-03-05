<?php

namespace App\Entity;

use App\Repository\WorkReseacherRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkReseacherRepository::class)
 */
class WorkReseacher
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
    private $name_reseacher;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $first_name_reseacher;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_of_birth;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameReseacher(): ?string
    {
        return $this->name_reseacher;
    }

    public function setNameReseacher(?string $name_reseacher): self
    {
        $this->name_reseacher = $name_reseacher;

        return $this;
    }

    public function getFirstNameReseacher(): ?string
    {
        return $this->first_name_reseacher;
    }

    public function setFirstNameReseacher(?string $first_name_reseacher): self
    {
        $this->first_name_reseacher = $first_name_reseacher;

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

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(?\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }
}
