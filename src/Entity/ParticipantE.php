<?php

namespace App\Entity;

use App\Repository\ParticipantERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ParticipantERepository::class)
 */
class ParticipantE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     * message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Eventlikes::class, mappedBy="user")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $eventlikes;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    public function __construct()
    {
        $this->eventlikes = new ArrayCollection();
    }


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
            $eventlike->setUser($this);
        }

        return $this;
    }

    public function removeEventlike(Eventlikes $eventlike): self
    {
        if ($this->eventlikes->removeElement($eventlike)) {
            // set the owning side to null (unless already changed)
            if ($eventlike->getUser() === $this) {
                $eventlike->setUser(null);
            }
        }

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

}
