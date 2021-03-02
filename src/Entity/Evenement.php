<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
}
