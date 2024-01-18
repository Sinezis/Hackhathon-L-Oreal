<?php

namespace App\Entity;

use App\Repository\ChatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
class Chat
{
    CONST GENDER = [
        1 => 'Non Renseigné',
        2 => 'Féminin',
        3 => 'Masculin',
        4 => 'Autre'
    ];

    CONST SKIN_TYPE = [
        1 => 'Non Renseigné',
        2 => 'Normale',
        3 => 'Sèche',
        4 => 'Grasse',
        5 => 'Mixte'
    ];

    CONST SKIN_COLOR = [
        1 => 'Non Renseigné',
        2 => 'I - Très pâle',
        3 => 'II - Très claire',
        4 => 'III - Claire',
        5 => 'IV - Mate',
        6 => 'V - Foncée',
        7 => 'VI - Très foncée ou noire'
    ];

    CONST HAIR_TYPE = [
        1 => 'Non Renseigné',
        2 => 'Cheveux Gras',
        3 => 'Cheveux normaux',
        4 => 'Cheveux abîmés',
        5 => 'Cheveux secs'
    ];

    CONST HAIR_TEXTURE = [
        1 => 'Non Renseigné',
        2 => 'Cheveux raides',
        3 => 'Cheveux ondulés',
        4 => 'Cheveux bouclés',
        5 => 'Cheveux frisés',
        6 => 'Cheveux crépus',
    ];

    CONST HAIR_COLOR = [
        1 => 'Non Renseigné',
        2 => 'Noir',
        3 => 'Brun',
        4 => 'Auburn',
        5 => 'Châtain',
        6 => 'Roux',
        7 => 'Blond Vénitien',
        8 => 'Blond',
        9 => 'Blanc'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $gender = 1;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(nullable: true)]
    private ?int $skinType = 1;

    #[ORM\Column(nullable: true)]
    private ?int $skinColor = 1;

    #[ORM\Column]
    private ?int $hairType = 1;

    #[ORM\Column]
    private ?int $hairTexture = 1;

    #[ORM\Column(nullable: true)]
    private ?int $hairColor = 1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function getGenderLabel(): string
    {
        return self::GENDER[$this->gender];
    }

    public function setGender(int $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getSkinType(): ?int
    {
        return $this->skinType;
    }

    public function getSkinTypeLabel(): string
    {
        return self::SKIN_TYPE[$this->skinType];
    }

    public function setSkinType(?int $skinType): static
    {
        $this->skinType = $skinType;

        return $this;
    }

    public function getSkinColor(): ?int
    {
        return $this->skinColor;
    }

    public function getSkinColorLabel(): string
    {
        return self::SKIN_COLOR[$this->skinColor];
    }

    public function setSkinColor(?int $skinColor): static
    {
        $this->skinColor = $skinColor;

        return $this;
    }

    public function getHairType(): ?int
    {
        return $this->hairType;
    }

    public function getHairTypeLabel(): string
    {
        return self::HAIR_TYPE[$this->hairType];
    }

    public function setHairType(int $hairType): static
    {
        $this->hairType = $hairType;

        return $this;
    }

    public function getHairTexture(): ?int
    {
        return $this->hairTexture;
    }

    public function getHairTextureLabel(): string
    {
        return self::TEXTURE_LABEL[$this->hairTexture];
    }

    public function setHairTexture(int $hairTexture): static
    {
        $this->hairTexture = $hairTexture;

        return $this;
    }

    public function getHairColor(): ?int
    {
        return $this->hairColor;
    }

    public function getHairColorLabel(): string
    {
        return self::HAIR-COLOR[$this->hairColor];
    }

    public function setHairColor(?int $hairColor): static
    {
        $this->hairColor = $hairColor;

        return $this;
    }
}
