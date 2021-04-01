<?php

namespace App\Entity;

use App\Repository\CorrectiontestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CorrectiontestRepository::class)
 */
class Correctiontest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ7;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ8;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ9;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ10;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ11;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ12;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ13;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ14;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ15;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ16;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ17;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ18;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ19;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"a", "b", "c", "d"})
     */
    private $reponseQ20;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;


    /**
     * @ORM\ManyToOne(targetEntity=Surfer::class, inversedBy="correctiontests")
     */
    private $mail;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponseQ1(): ?string
    {
        return $this->reponseQ1;
    }

    public function setReponseQ1(string $reponseQ1): self
    {
        $this->reponseQ1 = $reponseQ1;

        return $this;
    }

    public function getReponseQ2(): ?string
    {
        return $this->reponseQ2;
    }

    public function setReponseQ2(string $reponseQ2): self
    {
        $this->reponseQ2 = $reponseQ2;

        return $this;
    }

    public function getReponseQ3(): ?string
    {
        return $this->reponseQ3;
    }

    public function setReponseQ3(string $reponseQ3): self
    {
        $this->reponseQ3 = $reponseQ3;

        return $this;
    }

    public function getReponseQ4(): ?string
    {
        return $this->reponseQ4;
    }

    public function setReponseQ4(string $reponseQ4): self
    {
        $this->reponseQ4 = $reponseQ4;

        return $this;
    }

    public function getReponseQ5(): ?string
    {
        return $this->reponseQ5;
    }

    public function setReponseQ5(string $reponseQ5): self
    {
        $this->reponseQ5 = $reponseQ5;

        return $this;
    }

    public function getReponseQ6(): ?string
    {
        return $this->reponseQ6;
    }

    public function setReponseQ6(string $reponseQ6): self
    {
        $this->reponseQ6 = $reponseQ6;

        return $this;
    }

    public function getReponseQ7(): ?string
    {
        return $this->reponseQ7;
    }

    public function setReponseQ7(string $reponseQ7): self
    {
        $this->reponseQ7 = $reponseQ7;

        return $this;
    }

    public function getReponseQ8(): ?string
    {
        return $this->reponseQ8;
    }

    public function setReponseQ8(string $reponseQ8): self
    {
        $this->reponseQ8 = $reponseQ8;

        return $this;
    }

    public function getReponseQ9(): ?string
    {
        return $this->reponseQ9;
    }

    public function setReponseQ9(string $reponseQ9): self
    {
        $this->reponseQ9 = $reponseQ9;

        return $this;
    }

    public function getReponseQ10(): ?string
    {
        return $this->reponseQ10;
    }

    public function setReponseQ10(string $reponseQ10): self
    {
        $this->reponseQ10 = $reponseQ10;

        return $this;
    }

    public function getReponseQ11(): ?string
    {
        return $this->reponseQ11;
    }

    public function setReponseQ11(string $reponseQ11): self
    {
        $this->reponseQ11 = $reponseQ11;

        return $this;
    }

    public function getReponseQ12(): ?string
    {
        return $this->reponseQ12;
    }

    public function setReponseQ12(string $reponseQ12): self
    {
        $this->reponseQ12 = $reponseQ12;

        return $this;
    }

    public function getReponseQ13(): ?string
    {
        return $this->reponseQ13;
    }

    public function setReponseQ13(string $reponseQ13): self
    {
        $this->reponseQ13 = $reponseQ13;

        return $this;
    }

    public function getReponseQ14(): ?string
    {
        return $this->reponseQ14;
    }

    public function setReponseQ14(string $reponseQ14): self
    {
        $this->reponseQ14 = $reponseQ14;

        return $this;
    }

    public function getReponseQ15(): ?string
    {
        return $this->reponseQ15;
    }

    public function setReponseQ15(string $reponseQ15): self
    {
        $this->reponseQ15 = $reponseQ15;

        return $this;
    }

    public function getReponseQ16(): ?string
    {
        return $this->reponseQ16;
    }

    public function setReponseQ16(string $reponseQ16): self
    {
        $this->reponseQ16 = $reponseQ16;

        return $this;
    }

    public function getReponseQ17(): ?string
    {
        return $this->reponseQ17;
    }

    public function setReponseQ17(string $reponseQ17): self
    {
        $this->reponseQ17 = $reponseQ17;

        return $this;
    }

    public function getReponseQ18(): ?string
    {
        return $this->reponseQ18;
    }

    public function setReponseQ18(string $reponseQ18): self
    {
        $this->reponseQ18 = $reponseQ18;

        return $this;
    }

    public function getReponseQ19(): ?string
    {
        return $this->reponseQ19;
    }

    public function setReponseQ19(string $reponseQ19): self
    {
        $this->reponseQ19 = $reponseQ19;

        return $this;
    }

    public function getReponseQ20(): ?string
    {
        return $this->reponseQ20;
    }

    public function setReponseQ20(string $reponseQ20): self
    {
        $this->reponseQ20 = $reponseQ20;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }



    public function getMail(): ?Surfer
    {
        return $this->mail;
    }

    public function setMail(?Surfer $mail): self
    {
        $this->mail = $mail;

        return $this;
    }


}
