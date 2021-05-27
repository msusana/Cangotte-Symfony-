<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\IdGenerator;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom de votre campagne doit comporter au moins 2 des caractères",
     *      maxMessage = "Le nom de votre campagne ne peut pas comporter plus de 50 caractères"
     * )
     */
    private $nameCampagne;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le description de votre campagne doit comporter au moins 2 des caractères",
     *      maxMessage = "Le description de votre campagne ne peut pas comporter plus de 250 caractères"
     * )
     */
    private $contenuCampagne;

    /**
     * @ORM\Column(type="integer")     
     * @Assert\GreaterThan(
     *     value = 0,
     *     message = "Le montant doit être supérieur à 0"
     * )
     * @Assert\LessThan(
     *     value = 1000000000,
     *     message = "Le montant doit être inferieur à 1.000.000.000"
     * )
     * 
     */
    private $objectifCagnotte;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit comporter au moins 2 des caractères",
     *      maxMessage = "Votre nom ne peut pas comporter plus de 250 caractères"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide"
     * )
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="campagnes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function toArray(){
        return ['id'=>$this->getId(), 'nameCampagne'=>$this->getNameCampagne(), 'objectifCagnotte'=>$this->getObjectifCagnotte(), 'name'=>$this->getName() ];
    }

}
