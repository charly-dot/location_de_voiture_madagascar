<?php

namespace App\Entity;

use App\Repository\NegosiationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NegosiationRepository::class)]
class Negosiation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $discution = null;

    #[ORM\Column(length: 255)]
    private ?string $emails = null;

    #[ORM\Column(length: 255)]
    private ?string $contacte = null;

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

    public function getEmails(): ?string
    {
        return $this->emails;
    }

    public function setEmails(string $emails): static
    {
        $this->emails = $emails;

        return $this;
    }

    public function getContacte(): ?string
    {
        return $this->contacte;
    }

    public function setContacte(string $contacte): static
    {
        $this->contacte = $contacte;

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
