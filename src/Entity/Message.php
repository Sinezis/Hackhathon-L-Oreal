<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[Broadcast]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $received = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $send = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReceived(): ?string
    {
        return $this->received;
    }

    public function setReceived(?string $received): static
    {
        $this->received = $received;

        return $this;
    }

    public function getSend(): ?string
    {
        return $this->send;
    }

    public function setSend(?string $send): static
    {
        $this->send = $send;

        return $this;
    }
}
