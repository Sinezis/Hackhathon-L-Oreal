<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $discountPrice = null;

    #[ORM\Column(nullable: true)]
    private ?bool $giftWrap = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $personalizedMessage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscountPrice(): ?float
    {
        return $this->discountPrice;
    }

    public function setDiscountPrice(?float $discountPrice): static
    {
        $this->discountPrice = $discountPrice;

        return $this;
    }

    public function isGiftWrap(): ?bool
    {
        return $this->giftWrap;
    }

    public function setGiftWrap(?bool $giftWrap): static
    {
        $this->giftWrap = $giftWrap;

        return $this;
    }

    public function getPersonalizedMessage(): ?string
    {
        return $this->personalizedMessage;
    }

    public function setPersonalizedMessage(?string $personalizedMessage): static
    {
        $this->personalizedMessage = $personalizedMessage;

        return $this;
    }
}
