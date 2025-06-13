<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprietaireRepository::class)]
class Proprietaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $contatrat = null;

    #[ORM\Column(length: 255)]
    private ?string $idVehicule = null;

    /**
     * @var Collection<int, Vehicule>
     */
    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: 'id_Proprety')]
    private Collection $vehicules;

    /**
     * @var Collection<int, Tomobiles>
     */
    #[ORM\OneToMany(targetEntity: Tomobiles::class, mappedBy: 'proprietaire')]
    private Collection $description;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
        $this->description = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): static
    {
        $this->cin = $cin;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getContatrat(): ?string
    {
        return $this->contatrat;
    }

    public function setContatrat(string $contatrat): static
    {
        $this->contatrat = $contatrat;

        return $this;
    }

    public function getIdVehicule(): ?string
    {
        return $this->idVehicule;
    }

    public function setIdVehicule(string $idVehicule): static
    {
        $this->idVehicule = $idVehicule;

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): static
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setIdProprety($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): static
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getIdProprety() === $this) {
                $vehicule->setIdProprety(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tomobiles>
     */
    public function getDescription(): Collection
    {
        return $this->description;
    }

    public function addDescription(Tomobiles $description): static
    {
        if (!$this->description->contains($description)) {
            $this->description->add($description);
            $description->setProprietaire($this);
        }

        return $this;
    }

    public function removeDescription(Tomobiles $description): static
    {
        if ($this->description->removeElement($description)) {
            // set the owning side to null (unless already changed)
            if ($description->getProprietaire() === $this) {
                $description->setProprietaire(null);
            }
        }

        return $this;
    }
}
