<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CvRepository::class)
 */
class Cv
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length (
     *     min = 10,
     *     max = 255,
     *     minMessage = "Your description  must be at least {{ limit }} characters long",
     *     minMessage = "Your description  cannot be longer than {{ limit }} characters",
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email (
     *     message ="The email '{{value}}' is not a valid email"
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pro1_titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pro1_socie;

    /**
     * @ORM\Column(type="integer")
     */
    private $pro1_date_debut;

    /**
     *  @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="pro1_date_debut"
     * )
     */
    private $pro1_date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etabl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etabl_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $etab_date_debut;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="etab_date_debut"
     * )
     */
    private $etab_date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skill_pro1;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skill_perso1;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $interest1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lang1;



    //***************************
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pro2_titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pro2_socie;

    /**
     * @ORM\Column(type="integer")
     */
    private $pro2_date_debut;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="pro2_date_debut"
     * )
     */
    private $pro2_date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etabl2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etabl2_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $etab2_date_debut;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="etab2_date_debut"
     * )
     */
    private $etab2_date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skill_pro2;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skill_perso2;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $interest2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lang2;



    //***************************
    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $pro3_titre;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $pro3_socie;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $pro3_date_debut;

    /**
     * @ORM\Column(type="integer",nullable=true)
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="pro3_date_debut"
     * )
     */
    private $pro3_date_fin;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $etabl3;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $etabl3_type;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $etab3_date_debut;

    /**
     * @ORM\Column(type="integer",nullable=true)
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="etab3_date_debut"
     * )
     */
    private $etab3_date_fin;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $skill_pro3;



    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $skill_perso3;


    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $interest3;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $lang3;



    //***************************
    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $pro4_titre;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $pro4_socie;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $pro4_date_debut;

    /**
     * @ORM\Column(type="integer",nullable=true)
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="pro4_date_debut"
     * )
     */
    private $pro4_date_fin;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $etabl4;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $etabl4_type;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $etab4_date_debut;

    /**
     * @ORM\Column(type="integer",nullable=true)
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="etab4_date_debut"
     * )
     */
    private $etab4_date_fin;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $skill_pro4;



    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $skill_perso4;



    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $interest4;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $lang4;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $skill_pro1_data;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $skill_pro2_data;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $skill_pro3_data;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $skill_pro4_data;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $skill_perso1_data;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $skill_perso2_data;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $skill_perso3_data;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $skill_perso4_data;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $lang1_data;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $lang2_data;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $lang3_data;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $lang4_data;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;



    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\CvTech")
     * @ORM\JoinColumn(name="categoryType_id",referencedColumnName="id")
     */

    private   $categoryType;
    /**
     * @return mixed
     */
    public function getCategoryType()
    {
        return $this->categoryType;
    }

    /**
     * @param mixed $categoryType
     */
    public function setCategoryType($categoryType): void
    {
        $this->categoryType = $categoryType;
    }





    /**
     * @return mixed
     */
    public function getPro2Titre()
    {
        return $this->pro2_titre;
    }

    /**
     * @param mixed $pro2_titre
     */
    public function setPro2Titre($pro2_titre): void
    {
        $this->pro2_titre = $pro2_titre;
    }

    /**
     * @return mixed
     */
    public function getPro2Socie()
    {
        return $this->pro2_socie;
    }

    /**
     * @param mixed $pro2_socie
     */
    public function setPro2Socie($pro2_socie): void
    {
        $this->pro2_socie = $pro2_socie;
    }

    /**
     * @return mixed
     */
    public function getPro2DateDebut()
    {
        return $this->pro2_date_debut;
    }

    /**
     * @param mixed $pro2_date_debut
     */
    public function setPro2DateDebut($pro2_date_debut): void
    {
        $this->pro2_date_debut = $pro2_date_debut;
    }

    /**
     * @return mixed
     */
    public function getPro2DateFin()
    {
        return $this->pro2_date_fin;
    }

    /**
     * @param mixed $pro2_date_fin
     */
    public function setPro2DateFin($pro2_date_fin): void
    {
        $this->pro2_date_fin = $pro2_date_fin;
    }

    /**
     * @return mixed
     */
    public function getEtabl2()
    {
        return $this->etabl2;
    }

    /**
     * @param mixed $etabl2
     */
    public function setEtabl2($etabl2): void
    {
        $this->etabl2 = $etabl2;
    }

    /**
     * @return mixed
     */
    public function getEtabl2Type()
    {
        return $this->etabl2_type;
    }

    /**
     * @param mixed $etabl2_type
     */
    public function setEtabl2Type($etabl2_type): void
    {
        $this->etabl2_type = $etabl2_type;
    }

    /**
     * @return mixed
     */
    public function getEtab2DateDebut()
    {
        return $this->etab2_date_debut;
    }

    /**
     * @param mixed $etab2_date_debut
     */
    public function setEtab2DateDebut($etab2_date_debut): void
    {
        $this->etab2_date_debut = $etab2_date_debut;
    }

    /**
     * @return mixed
     */
    public function getEtab2DateFin()
    {
        return $this->etab2_date_fin;
    }

    /**
     * @param mixed $etab2_date_fin
     */
    public function setEtab2DateFin($etab2_date_fin): void
    {
        $this->etab2_date_fin = $etab2_date_fin;
    }

    /**
     * @return mixed
     */
    public function getSkillPro2()
    {
        return $this->skill_pro2;
    }

    /**
     * @param mixed $skill_pro2
     */
    public function setSkillPro2($skill_pro2): void
    {
        $this->skill_pro2 = $skill_pro2;
    }

    /**
     * @return mixed
     */
    public function getSkillPro2Data()
    {
        return $this->skill_pro2_data;
    }

    /**
     * @param mixed $skill_pro2_data
     */
    public function setSkillPro2Data($skill_pro2_data): void
    {
        $this->skill_pro2_data = $skill_pro2_data;
    }

    /**
     * @return mixed
     */
    public function getSkillPerso2()
    {
        return $this->skill_perso2;
    }

    /**
     * @param mixed $skill_perso2
     */
    public function setSkillPerso2($skill_perso2): void
    {
        $this->skill_perso2 = $skill_perso2;
    }

    /**
     * @return mixed
     */
    public function getSkillPerso2Data()
    {
        return $this->skill_perso2_data;
    }

    /**
     * @param mixed $skill_perso2_data
     */
    public function setSkillPerso2Data($skill_perso2_data): void
    {
        $this->skill_perso2_data = $skill_perso2_data;
    }

    /**
     * @return mixed
     */
    public function getInterest2()
    {
        return $this->interest2;
    }

    /**
     * @param mixed $interest2
     */
    public function setInterest2($interest2): void
    {
        $this->interest2 = $interest2;
    }

    /**
     * @return mixed
     */
    public function getLang2()
    {
        return $this->lang2;
    }

    /**
     * @param mixed $lang2
     */
    public function setLang2($lang2): void
    {
        $this->lang2 = $lang2;
    }

    /**
     * @return mixed
     */
    public function getLang2Data()
    {
        return $this->lang2_data;
    }

    /**
     * @param mixed $lang2_data
     */
    public function setLang2Data($lang2_data): void
    {
        $this->lang2_data = $lang2_data;
    }

    /**
     * @return mixed
     */
    public function getPro3Titre()
    {
        return $this->pro3_titre;
    }

    /**
     * @param mixed $pro3_titre
     */
    public function setPro3Titre($pro3_titre): void
    {
        $this->pro3_titre = $pro3_titre;
    }

    /**
     * @return mixed
     */
    public function getPro3Socie()
    {
        return $this->pro3_socie;
    }

    /**
     * @param mixed $pro3_socie
     */
    public function setPro3Socie($pro3_socie): void
    {
        $this->pro3_socie = $pro3_socie;
    }

    /**
     * @return mixed
     */
    public function getPro3DateDebut()
    {
        return $this->pro3_date_debut;
    }

    /**
     * @param mixed $pro3_date_debut
     */
    public function setPro3DateDebut($pro3_date_debut): void
    {
        $this->pro3_date_debut = $pro3_date_debut;
    }

    /**
     * @return mixed
     */
    public function getPro3DateFin()
    {
        return $this->pro3_date_fin;
    }

    /**
     * @param mixed $pro3_date_fin
     */
    public function setPro3DateFin($pro3_date_fin): void
    {
        $this->pro3_date_fin = $pro3_date_fin;
    }

    /**
     * @return mixed
     */
    public function getEtabl3()
    {
        return $this->etabl3;
    }

    /**
     * @param mixed $etabl3
     */
    public function setEtabl3($etabl3): void
    {
        $this->etabl3 = $etabl3;
    }

    /**
     * @return mixed
     */
    public function getEtabl3Type()
    {
        return $this->etabl3_type;
    }

    /**
     * @param mixed $etabl3_type
     */
    public function setEtabl3Type($etabl3_type): void
    {
        $this->etabl3_type = $etabl3_type;
    }

    /**
     * @return mixed
     */
    public function getEtab3DateDebut()
    {
        return $this->etab3_date_debut;
    }

    /**
     * @param mixed $etab3_date_debut
     */
    public function setEtab3DateDebut($etab3_date_debut): void
    {
        $this->etab3_date_debut = $etab3_date_debut;
    }

    /**
     * @return mixed
     */
    public function getEtab3DateFin()
    {
        return $this->etab3_date_fin;
    }

    /**
     * @param mixed $etab3_date_fin
     */
    public function setEtab3DateFin($etab3_date_fin): void
    {
        $this->etab3_date_fin = $etab3_date_fin;
    }

    /**
     * @return mixed
     */
    public function getSkillPro3()
    {
        return $this->skill_pro3;
    }

    /**
     * @param mixed $skill_pro3
     */
    public function setSkillPro3($skill_pro3): void
    {
        $this->skill_pro3 = $skill_pro3;
    }

    /**
     * @return mixed
     */
    public function getSkillPro3Data()
    {
        return $this->skill_pro3_data;
    }

    /**
     * @param mixed $skill_pro3_data
     */
    public function setSkillPro3Data($skill_pro3_data): void
    {
        $this->skill_pro3_data = $skill_pro3_data;
    }

    /**
     * @return mixed
     */
    public function getSkillPerso3()
    {
        return $this->skill_perso3;
    }

    /**
     * @param mixed $skill_perso3
     */
    public function setSkillPerso3($skill_perso3): void
    {
        $this->skill_perso3 = $skill_perso3;
    }

    /**
     * @return mixed
     */
    public function getSkillPerso3Data()
    {
        return $this->skill_perso3_data;
    }

    /**
     * @param mixed $skill_perso3_data
     */
    public function setSkillPerso3Data($skill_perso3_data): void
    {
        $this->skill_perso3_data = $skill_perso3_data;
    }

    /**
     * @return mixed
     */
    public function getInterest3()
    {
        return $this->interest3;
    }

    /**
     * @param mixed $interest3
     */
    public function setInterest3($interest3): void
    {
        $this->interest3 = $interest3;
    }

    /**
     * @return mixed
     */
    public function getLang3()
    {
        return $this->lang3;
    }

    /**
     * @param mixed $lang3
     */
    public function setLang3($lang3): void
    {
        $this->lang3 = $lang3;
    }

    /**
     * @return mixed
     */
    public function getLang3Data()
    {
        return $this->lang3_data;
    }

    /**
     * @param mixed $lang3_data
     */
    public function setLang3Data($lang3_data): void
    {
        $this->lang3_data = $lang3_data;
    }

    /**
     * @return mixed
     */
    public function getPro4Titre()
    {
        return $this->pro4_titre;
    }

    /**
     * @param mixed $pro4_titre
     */
    public function setPro4Titre($pro4_titre): void
    {
        $this->pro4_titre = $pro4_titre;
    }

    /**
     * @return mixed
     */
    public function getPro4Socie()
    {
        return $this->pro4_socie;
    }

    /**
     * @param mixed $pro4_socie
     */
    public function setPro4Socie($pro4_socie): void
    {
        $this->pro4_socie = $pro4_socie;
    }

    /**
     * @return mixed
     */
    public function getPro4DateDebut()
    {
        return $this->pro4_date_debut;
    }

    /**
     * @param mixed $pro4_date_debut
     */
    public function setPro4DateDebut($pro4_date_debut): void
    {
        $this->pro4_date_debut = $pro4_date_debut;
    }

    /**
     * @return mixed
     */
    public function getPro4DateFin()
    {
        return $this->pro4_date_fin;
    }

    /**
     * @param mixed $pro4_date_fin
     */
    public function setPro4DateFin($pro4_date_fin): void
    {
        $this->pro4_date_fin = $pro4_date_fin;
    }

    /**
     * @return mixed
     */
    public function getEtabl4()
    {
        return $this->etabl4;
    }

    /**
     * @param mixed $etabl4
     */
    public function setEtabl4($etabl4): void
    {
        $this->etabl4 = $etabl4;
    }

    /**
     * @return mixed
     */
    public function getEtabl4Type()
    {
        return $this->etabl4_type;
    }

    /**
     * @param mixed $etabl4_type
     */
    public function setEtabl4Type($etabl4_type): void
    {
        $this->etabl4_type = $etabl4_type;
    }

    /**
     * @return mixed
     */
    public function getEtab4DateDebut()
    {
        return $this->etab4_date_debut;
    }

    /**
     * @param mixed $etab4_date_debut
     */
    public function setEtab4DateDebut($etab4_date_debut): void
    {
        $this->etab4_date_debut = $etab4_date_debut;
    }

    /**
     * @return mixed
     */
    public function getEtab4DateFin()
    {
        return $this->etab4_date_fin;
    }

    /**
     * @param mixed $etab4_date_fin
     */
    public function setEtab4DateFin($etab4_date_fin): void
    {
        $this->etab4_date_fin = $etab4_date_fin;
    }

    /**
     * @return mixed
     */
    public function getSkillPro4()
    {
        return $this->skill_pro4;
    }

    /**
     * @param mixed $skill_pro4
     */
    public function setSkillPro4($skill_pro4): void
    {
        $this->skill_pro4 = $skill_pro4;
    }

    /**
     * @return mixed
     */
    public function getSkillPro4Data()
    {
        return $this->skill_pro4_data;
    }

    /**
     * @param mixed $skill_pro4_data
     */
    public function setSkillPro4Data($skill_pro4_data): void
    {
        $this->skill_pro4_data = $skill_pro4_data;
    }

    /**
     * @return mixed
     */
    public function getSkillPerso4()
    {
        return $this->skill_perso4;
    }

    /**
     * @param mixed $skill_perso4
     */
    public function setSkillPerso4($skill_perso4): void
    {
        $this->skill_perso4 = $skill_perso4;
    }

    /**
     * @return mixed
     */
    public function getSkillPerso4Data()
    {
        return $this->skill_perso4_data;
    }

    /**
     * @param mixed $skill_perso4_data
     */
    public function setSkillPerso4Data($skill_perso4_data): void
    {
        $this->skill_perso4_data = $skill_perso4_data;
    }

    /**
     * @return mixed
     */
    public function getInterest4()
    {
        return $this->interest4;
    }

    /**
     * @param mixed $interest4
     */
    public function setInterest4($interest4): void
    {
        $this->interest4 = $interest4;
    }

    /**
     * @return mixed
     */
    public function getLang4()
    {
        return $this->lang4;
    }

    /**
     * @param mixed $lang4
     */
    public function setLang4($lang4): void
    {
        $this->lang4 = $lang4;
    }

    /**
     * @return mixed
     */
    public function getLang4Data()
    {
        return $this->lang4_data;
    }

    /**
     * @param mixed $lang4_data
     */
    public function setLang4Data($lang4_data): void
    {
        $this->lang4_data = $lang4_data;
    }



    //***************************

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
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

    public function getPro1Titre(): ?string
    {
        return $this->pro1_titre;
    }

    public function setPro1Titre(string $pro1_titre): self
    {
        $this->pro1_titre = $pro1_titre;

        return $this;
    }

    public function getPro1Socie(): ?string
    {
        return $this->pro1_socie;
    }

    public function setPro1Socie(string $pro1_socie): self
    {
        $this->pro1_socie = $pro1_socie;

        return $this;
    }

    public function getPro1DateDebut(): ?string
    {
        return $this->pro1_date_debut;
    }

    public function setPro1DateDebut(string $pro1_date_debut): self
    {
        $this->pro1_date_debut = $pro1_date_debut;

        return $this;
    }

    public function getPro1DateFin(): ?string
    {
        return $this->pro1_date_fin;
    }

    public function setPro1DateFin(string $pro1_date_fin): self
    {
        $this->pro1_date_fin = $pro1_date_fin;

        return $this;
    }

    public function getEtabl(): ?string
    {
        return $this->etabl;
    }

    public function setEtabl(string $etabl): self
    {
        $this->etabl = $etabl;

        return $this;
    }

    public function getEtablType(): ?string
    {
        return $this->etabl_type;
    }

    public function setEtablType(string $etabl_type): self
    {
        $this->etabl_type = $etabl_type;

        return $this;
    }

    public function getEtabDateDebut(): ?string
    {
        return $this->etab_date_debut;
    }

    public function setEtabDateDebut(string $etab_date_debut): self
    {
        $this->etab_date_debut = $etab_date_debut;

        return $this;
    }

    public function getEtabDateFin(): ?string
    {
        return $this->etab_date_fin;
    }

    public function setEtabDateFin(string $etab_date_fin): self
    {
        $this->etab_date_fin = $etab_date_fin;

        return $this;
    }

    public function getSkillPro1(): ?string
    {
        return $this->skill_pro1;
    }

    public function setSkillPro1(string $skill_pro1): self
    {
        $this->skill_pro1 = $skill_pro1;

        return $this;
    }

    public function getSkillPro1Data(): ?String
    {
        return $this->skill_pro1_data;
    }

    public function setSkillPro1Data(string $skill_pro1_data): self
    {
        $this->skill_pro1_data = $skill_pro1_data;

        return $this;
    }

    public function getSkillPerso1(): ?string
    {
        return $this->skill_perso1;
    }

    public function setSkillPerso1(string $skill_perso1): self
    {
        $this->skill_perso1 = $skill_perso1;

        return $this;
    }

    public function getSkillPerso1Data(): ?String
    {
        return $this->skill_perso1_data;
    }

    public function setSkillPerso1Data(String $skill_perso1_data): self
    {
        $this->skill_perso1_data = $skill_perso1_data;

        return $this;
    }

    public function getInterest1(): ?string
    {
        return $this->interest1;
    }

    public function setInterest1(string $interest1): self
    {
        $this->interest1 = $interest1;

        return $this;
    }

    public function getLang1(): ?string
    {
        return $this->lang1;
    }

    public function setLang1(string $lang1): self
    {
        $this->lang1 = $lang1;

        return $this;
    }

    public function getLang1Data(): ?string
    {
        return $this->lang1_data;
    }

    public function setLang1Data(string $lang1_data): self
    {
        $this->lang1_data = $lang1_data;

        return $this;
    }
    public function  compaire(String $a,String $b):Bool
    {

        if (strcmp($a,$b)<=0){

            return  true;
        }else{
            return false;
        }

    }





}
