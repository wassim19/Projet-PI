<?php

namespace App\Entity;

use App\Repository\EventlikesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventlikesRepository::class)
 */
class Eventlikes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ParticipantE::class, inversedBy="eventlikes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="eventlikes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $event;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?ParticipantE
    {
        return $this->user;
    }

    public function setUser(?ParticipantE $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEvent(): ?Evenement
    {
        return $this->event;
    }

    public function setEvent(?Evenement $event): self
    {
        $this->event = $event;

        return $this;
    }
}
