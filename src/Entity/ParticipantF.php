<?php

namespace App\Entity;

use App\Repository\ParticipantfRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ParticipantfRepository::class)
 */
class ParticipantF
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("participantsf")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     * message = "The email '{{ value }}' is not a valid email."
     * )
     * @Groups("participantsf")
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("participantsf")
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
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


}
