<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=CampagneRepository::class)
 */
class Campagne
{
      /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Doctrine\Bundle\DoctrineBundle\IdGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $nameCampagne;

    /**
     * @ORM\Column(type="text")
     */
    private $contenuCampagne;

    /**
     * @ORM\Column(type="integer")
     */
    private $objectifCagnotte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNameCampagne(): ?string
    {
        return $this->nameCampagne;
    }

    public function setNameCampagne(string $nameCampagne): self
    {
        $this->nameCampagne = $nameCampagne;

        return $this;
    }

    public function getContenuCampagne(): ?string
    {
        return $this->contenuCampagne;
    }

    public function setContenuCampagne(string $contenuCampagne): self
    {
        $this->contenuCampagne = $contenuCampagne;

        return $this;
    }

    public function getObjectifCagnotte(): ?int
    {
        return $this->objectifCagnotte;
    }

    public function setObjectifCagnotte(int $objectifCagnotte): self
    {
        $this->objectifCagnotte = $objectifCagnotte;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

}
