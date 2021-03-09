<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{

    /**
     * Many Users have Many Groups.
     * @@ORM\ManyToMany(targetEntity="ParticipantF")
     * @ORM\JoinTable(name="ParticipationF",
     *      joinColumns={@ORM\JoinColumn(name="id_formation", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_participant", referencedColumnName="id")}
     *      )
     */
    private $formations;

    

    public function __construct() {
        $this->formations = new ArrayCollection();
    }
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

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
    private $localisation;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_soc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagef;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getIdSoc(): ?int
    {
        return $this->id_soc;
    }

    public function setIdSoc(int $id_soc): self
    {
        $this->id_soc = $id_soc;

        return $this;
    }

    public function getImagef(): ?string
    {
        return $this->imagef;
    }

    public function setImagef(string $imagef): self
    {
        $this->imagef = $imagef;

        return $this;
    }
}
