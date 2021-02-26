<?php

namespace App\Entity;

use App\Repository\ParticipationFRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipationFRepository::class)
 */
class ParticipationF
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
    private $id_formation;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_participant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFormation(): ?int
    {
        return $this->id_formation;
    }

    public function setIdFormation(int $id_formation): self
    {
        $this->id_formation = $id_formation;

        return $this;
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
}
