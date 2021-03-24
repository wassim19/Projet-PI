<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{

    /**
     * Many Users have Many Groups.
     * @@ORM\ManyToMany(targetEntity="ParticipantE")
     * @ORM\JoinTable(name="ParticipationE",
     *      joinColumns={@ORM\JoinColumn(name="id_evenement", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_participant", referencedColumnName="id")}
     *      )
     */
    private $events;

    // ...

    public function __construct() {
        $this->events = new ArrayCollection();
        $this->eventlikes = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string")
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localitation;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_societe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Viewed;

    /**
     * @ORM\OneToMany(targetEntity=Eventlikes::class, mappedBy="event")
     */
    private $eventlikes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function getDateAt(): ?\DateTimeInterface
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeInterface $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getLocalitation(): ?string
    {
        return $this->localitation;
    }

    public function setLocalitation(string $localitation): self
    {
        $this->localitation = $localitation;

        return $this;
    }

    public function getIdSociete(): ?int
    {
        return $this->id_societe;
    }

    public function setIdSociete(int $id_societe): self
    {
        $this->id_societe = $id_societe;

        return $this;
    }

    public function getViewed(): ?int
    {
        return $this->Viewed;
    }

    public function setViewed(?int $Viewed): self
    {
        $this->Viewed = $Viewed;

        return $this;
    }

    public function __toString()
    {
        return $this->type;
    }

    /**
     * @return Collection|Eventlikes[]
     */
    public function getEventlikes(): Collection
    {
        return $this->eventlikes;
    }

    public function addEventlike(Eventlikes $eventlike): self
    {
        if (!$this->eventlikes->contains($eventlike)) {
            $this->eventlikes[] = $eventlike;
            $eventlike->setEvent($this);
        }

        return $this;
    }

    public function removeEventlike(Eventlikes $eventlike): self
    {
        if ($this->eventlikes->removeElement($eventlike)) {
            // set the owning side to null (unless already changed)
            if ($eventlike->getEvent() === $this) {
                $eventlike->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @param ParticipantE $participantE
     * @return bool
     */
    public function  isLikedByUser(ParticipantE $participantE) : bool{
        foreach ($this->eventlikes as $eventlike){
            if($eventlike->getUser() == $participantE) return false;
        }
        return false;

    }


}
