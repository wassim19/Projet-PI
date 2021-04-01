<?php

namespace App\Entity;

use App\Repository\CvImportedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CvImportedRepository::class)
 */
class CvImported
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }


    public function setFilename(string $filename):  self
    {
        $this->filename = $filename;
        return $this;
    }


}
