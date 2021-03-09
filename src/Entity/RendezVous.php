<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 */
class RendezVous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Range(
     *      min = "now",
     *      max = "+1 month"
     * )
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url
     */
    private $meet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;



    /**
     * @ORM\ManyToOne(targetEntity=Surfer::class, inversedBy="rendezVouses")
     */
    private $mail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMeet(): ?string
    {
        return $this->meet;
    }

    public function setMeet(string $meet): self
    {
        $this->meet = $meet;

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
