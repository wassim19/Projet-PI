<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="time")
     */
    private $chronometre;


    /**
     * @ORM\ManyToOne(targetEntity=Surfer::class, inversedBy="tests")
     */
    private $mail;



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getChronometre(): ?\DateTimeInterface
    {
        return $this->chronometre;
    }

    public function setChronometre(\DateTimeInterface $chronometre): self
    {
        $this->chronometre = $chronometre;

        return $this;
    }

    public function getMail(): ?Surfer
    {
        return $this->mail;
    }

    public function setMail(?Surfer $mail): self
    {
        $this->mail = $mail;

        return $this;
    }


}
