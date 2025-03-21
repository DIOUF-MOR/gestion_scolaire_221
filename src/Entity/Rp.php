<?php

namespace App\Entity;

use App\Repository\RpRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RpRepository::class)]
class Rp extends User
{
    #[ORM\Column(length: 25)]
    private ?string $telephone = null;

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }
}
