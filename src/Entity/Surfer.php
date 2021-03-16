<?php

namespace App\Entity;

use App\Repository\SurferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SurferRepository::class)
 */
class Surfer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */

    private $first_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $emailadress;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=RendezVous::class, mappedBy="mail",cascade={"all"},orphanRemoval=true)
     */
    private $rendezVouses;

    /**
     * @ORM\OneToMany(targetEntity=Test::class, mappedBy="mail",cascade={"all"},orphanRemoval=true)
     */
    private $tests;

    /**
     * @ORM\OneToMany(targetEntity=Correctiontest::class, mappedBy="mail",cascade={"all"},orphanRemoval=true)
     */
    private $correctiontests;

    public function __construct()
    {
        $this->rendezVouses = new ArrayCollection();
        $this->tests = new ArrayCollection();
        $this->correctiontests = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }




    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(?int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getEmailadress(): ?string
    {
        return $this->emailadress;
    }

    public function setEmailadress(?string $emailadress): self
    {
        $this->emailadress = $emailadress;

        return $this;
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

    /**
     * @return Collection|RendezVous[]
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): self
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses[] = $rendezVouse;
            $rendezVouse->setMail($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getMail() === $this) {
                $rendezVouse->setMail(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Test[]
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
            $test->setMail($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getMail() === $this) {
                $test->setMail(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Correctiontest[]
     */
    public function getCorrectiontests(): Collection
    {
        return $this->correctiontests;
    }

    public function addCorrectiontest(Correctiontest $correctiontest): self
    {
        if (!$this->correctiontests->contains($correctiontest)) {
            $this->correctiontests[] = $correctiontest;
            $correctiontest->setMail($this);
        }

        return $this;
    }

    public function removeCorrectiontest(Correctiontest $correctiontest): self
    {
        if ($this->correctiontests->removeElement($correctiontest)) {
            // set the owning side to null (unless already changed)
            if ($correctiontest->getMail() === $this) {
                $correctiontest->setMail(null);
            }
        }

        return $this;
    }

}
