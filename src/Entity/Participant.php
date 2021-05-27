<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ParticipantRepository::class)
 */
class Participant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit comporter au moins 2 des caractères",
     *      maxMessage = "Votre nom ne peut pas comporter plus de 250 caractères"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAnonymous;

    /**
     * @ORM\ManyToOne(targetEntity=Campagne::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $campagneId;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="participantId")
     */
    private $payments;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsAnonymous(): ?bool
    {
        return $this->isAnonymous;
    }

    public function setIsAnonymous(bool $isAnonymous): self
    {
        $this->isAnonymous = $isAnonymous;

        return $this;
    }

    public function getCampagneId(): ?Campagne
    {
        return $this->campagneId;
    }

    public function setCampagneId(?Campagne $campagneId): self
    {
        $this->campagneId = $campagneId;

        return $this;
    }
 

    /**
     * @return Collection|Payment[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setParticipantId($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getParticipantId() === $this) {
                $payment->setParticipantId(null);
            }
        }

        return $this;
    }

}
