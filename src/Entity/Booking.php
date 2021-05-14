<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity
 */
class Booking
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     */
    private $idEvent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="A1", type="integer", nullable=true)
     */
    private $a1;

    /**
     * @var int|null
     *
     * @ORM\Column(name="A2", type="integer", nullable=true)
     */
    private $a2;

    /**
     * @var int|null
     *
     * @ORM\Column(name="A3", type="integer", nullable=true)
     */
    private $a3;

    /**
     * @var int|null
     *
     * @ORM\Column(name="A4", type="integer", nullable=true)
     */
    private $a4;

    /**
     * @var int|null
     *
     * @ORM\Column(name="A5", type="integer", nullable=true)
     */
    private $a5;

    /**
     * @var int|null
     *
     * @ORM\Column(name="A6", type="integer", nullable=true)
     */
    private $a6;

    /**
     * @var int|null
     *
     * @ORM\Column(name="B1", type="integer", nullable=true)
     */
    private $b1;

    /**
     * @var int|null
     *
     * @ORM\Column(name="B2", type="integer", nullable=true)
     */
    private $b2;

    /**
     * @var int|null
     *
     * @ORM\Column(name="B3", type="integer", nullable=true)
     */
    private $b3;

    /**
     * @var int|null
     *
     * @ORM\Column(name="B4", type="integer", nullable=true)
     */
    private $b4;

    /**
     * @var int|null
     *
     * @ORM\Column(name="B5", type="integer", nullable=true)
     */
    private $b5;

    /**
     * @var int|null
     *
     * @ORM\Column(name="B6", type="integer", nullable=true)
     */
    private $b6;

    /**
     * @var int|null
     *
     * @ORM\Column(name="C1", type="integer", nullable=true)
     */
    private $c1;

    /**
     * @var int|null
     *
     * @ORM\Column(name="C2", type="integer", nullable=true)
     */
    private $c2;

    /**
     * @var int|null
     *
     * @ORM\Column(name="C3", type="integer", nullable=true)
     */
    private $c3;

    /**
     * @var int|null
     *
     * @ORM\Column(name="C4", type="integer", nullable=true)
     */
    private $c4;

    /**
     * @var int|null
     *
     * @ORM\Column(name="C5", type="integer", nullable=true)
     */
    private $c5;

    /**
     * @var int|null
     *
     * @ORM\Column(name="C6", type="integer", nullable=true)
     */
    private $c6;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function setIdEvent(int $idEvent): self
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    public function getA1(): ?int
    {
        return $this->a1;
    }

    public function setA1(?int $a1): self
    {
        $this->a1 = $a1;

        return $this;
    }

    public function getA2(): ?int
    {
        return $this->a2;
    }

    public function setA2(?int $a2): self
    {
        $this->a2 = $a2;

        return $this;
    }

    public function getA3(): ?int
    {
        return $this->a3;
    }

    public function setA3(?int $a3): self
    {
        $this->a3 = $a3;

        return $this;
    }

    public function getA4(): ?int
    {
        return $this->a4;
    }

    public function setA4(?int $a4): self
    {
        $this->a4 = $a4;

        return $this;
    }

    public function getA5(): ?int
    {
        return $this->a5;
    }

    public function setA5(?int $a5): self
    {
        $this->a5 = $a5;

        return $this;
    }

    public function getA6(): ?int
    {
        return $this->a6;
    }

    public function setA6(?int $a6): self
    {
        $this->a6 = $a6;

        return $this;
    }

    public function getB1(): ?int
    {
        return $this->b1;
    }

    public function setB1(?int $b1): self
    {
        $this->b1 = $b1;

        return $this;
    }

    public function getB2(): ?int
    {
        return $this->b2;
    }

    public function setB2(?int $b2): self
    {
        $this->b2 = $b2;

        return $this;
    }

    public function getB3(): ?int
    {
        return $this->b3;
    }

    public function setB3(?int $b3): self
    {
        $this->b3 = $b3;

        return $this;
    }

    public function getB4(): ?int
    {
        return $this->b4;
    }

    public function setB4(?int $b4): self
    {
        $this->b4 = $b4;

        return $this;
    }

    public function getB5(): ?int
    {
        return $this->b5;
    }

    public function setB5(?int $b5): self
    {
        $this->b5 = $b5;

        return $this;
    }

    public function getB6(): ?int
    {
        return $this->b6;
    }

    public function setB6(?int $b6): self
    {
        $this->b6 = $b6;

        return $this;
    }

    public function getC1(): ?int
    {
        return $this->c1;
    }

    public function setC1(?int $c1): self
    {
        $this->c1 = $c1;

        return $this;
    }

    public function getC2(): ?int
    {
        return $this->c2;
    }

    public function setC2(?int $c2): self
    {
        $this->c2 = $c2;

        return $this;
    }

    public function getC3(): ?int
    {
        return $this->c3;
    }

    public function setC3(?int $c3): self
    {
        $this->c3 = $c3;

        return $this;
    }

    public function getC4(): ?int
    {
        return $this->c4;
    }

    public function setC4(?int $c4): self
    {
        $this->c4 = $c4;

        return $this;
    }

    public function getC5(): ?int
    {
        return $this->c5;
    }

    public function setC5(?int $c5): self
    {
        $this->c5 = $c5;

        return $this;
    }

    public function getC6(): ?int
    {
        return $this->c6;
    }

    public function setC6(?int $c6): self
    {
        $this->c6 = $c6;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


}
