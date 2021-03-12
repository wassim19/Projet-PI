<?php

namespace App\Entity;

use App\Repository\NotifOffreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotifOffreRepository::class)
 */
class NotifOffre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $notifoffre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotifoffre(): ?string
    {
        return $this->notifoffre;
    }

    public function setNotifoffre(string $notifoffre): self
    {
        $this->notifoffre = $notifoffre;

        return $this;
    }
}
