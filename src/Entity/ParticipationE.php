<?php

namespace App\Entity;

use App\Repository\ParticipationERepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipationERepository::class)
 */
class ParticipationE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_participant;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdParticipant(): ?int
    {
        return $this->id_participant;
    }

    public function setIdParticipant(int $id_participant): self
    {
        $this->id_participant = $id_participant;

        return $this;
    }

    public function getIdEvenement(): ?int
    {
        return $this->id_evenement;
    }

    public function setIdEvenement(int $id_evenement): self
    {
        $this->id_evenement = $id_evenement;

        return $this;
    }
}
