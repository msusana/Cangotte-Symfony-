<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PaymentRepository::class)
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThan(
     *     value = 0,
     *     message = "Le montant doit être supérieur à 0"
     * )
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Participant::class, inversedBy="payments", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $participantId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getParticipantId(): ?Participant
    {
        return $this->participantId;
    }

    public function setParticipantId(?Participant $participantId): self
    {
        $this->participantId = $participantId;

        return $this;
    }
}
