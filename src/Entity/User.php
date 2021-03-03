<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     * /**
     * @ORM\OneToMany(targetEntity="App\Entity\surfer", mappedBy="user")
     */
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WorkReseacher", mappedBy="user")
     */
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\user", mappedBy="category")
     */

    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
