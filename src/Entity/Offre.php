<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\ManyToOne(targetEntity="CategorieOffre", inversedBy="type")
     * @ORM\Column(type="string", length=255)
     */
    private $typecategorie;

    public function getTypecategorie(): ?string
    {
        return $this->typecategorie;
    }

    public function setTypecategorie(?string $typecategorie): self
    {
        $this->typecategorie = $typecategorie;

        return $this;
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
    private $specialite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_dem;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

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

    public function getNbDem(): ?int
    {
        return $this->nb_dem;
    }

    public function setNbDem(int $nb_dem): self
    {
        $this->nb_dem = $nb_dem;

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




}
