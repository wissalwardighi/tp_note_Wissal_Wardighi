<?php

namespace App\Entity;

use App\Repository\JouerRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Film;
use App\Entity\Acteur;

#[ORM\Entity(repositoryClass: JouerRepository::class)]
class Jouer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Relation ManyToOne avec Film
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Film", inversedBy="joueurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Film $film = null;

    // Relation ManyToOne avec Acteur
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Acteur", inversedBy="joueurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Acteur $acteur = null;

    // Vous pouvez ajouter d'autres champs si nécessaire
    #[ORM\Column(length: 100)]
    private ?string $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter et Setter pour Film
    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): static
    {
        $this->film = $film;
        return $this;
    }

    // Getter et Setter pour Acteur
    public function getActeur(): ?Acteur
    {
        return $this->acteur;
    }

    public function setActeur(?Acteur $acteur): static
    {
        $this->acteur = $acteur;
        return $this;
    }

    // Getter et Setter pour le rôle
    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

}
