<?php

namespace App\Entity;

use App\Repository\NotificationrdvRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotificationrdvRepository::class)
 */
class Notificationrdv
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
    private $notification;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotification(): ?string
    {
        return $this->notification;
    }

    public function setNotification(string $notification): self
    {
        $this->notification = $notification;

        return $this;
    }
}
