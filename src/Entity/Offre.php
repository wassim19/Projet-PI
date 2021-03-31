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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialite;

    public function __toString()
    {
        return $this->specialite;
    }
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagesoffre;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieOffre::class, inversedBy="types")
     */
    private $typecategorie;



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

    public function getImagesoffre(): ?string
    {
        return $this->imagesoffre;
    }

    public function setImagesoffre(string $imagesoffre): self
    {
        $this->imagesoffre = $imagesoffre;

        return $this;
    }

    public function getTypecategorie(): ?CategorieOffre
    {
        return $this->typecategorie;
    }

    public function setTypecategorie(?CategorieOffre $typecategorie): self
    {
        $this->typecategorie = $typecategorie;

        return $this;
    }




}
