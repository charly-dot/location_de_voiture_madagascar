<?php

namespace App\Entity;

use App\Repository\DiscutionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscutionRepository::class)]
class Discution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $discution = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    private ?string $id_vehicule = null;

    #[ORM\Column(length: 255)]
    private ?string $confirmation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscution(): ?string
    {
        return $this->discution;
    }

    public function setDiscution(string $discution): static
    {
        $this->discution = $discution;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getIdVehicule(): ?string
    {
        return $this->id_vehicule;
    }

    public function setIdVehicule(string $id_vehicule): static
    {
        $this->id_vehicule = $id_vehicule;

        return $this;
    }

    public function getConfirmation(): ?string
    {
        return $this->confirmation;
    }

    public function setConfirmation(string $confirmation): static
    {
        $this->confirmation = $confirmation;

        return $this;
    }
}
