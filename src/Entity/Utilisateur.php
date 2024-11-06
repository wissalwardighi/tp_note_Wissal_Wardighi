<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Film;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $motDePasse = null;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $role = null;

    // Relation ManyToMany avec Film
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Film", inversedBy="utilisateurs")
     * @ORM\JoinTable(name="utilisateur_film")
     */

    private Collection $filmsFavoris;

    public function __construct()
    {
        $this->filmsFavoris = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): static
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    // Getter pour les films favoris
    public function getFilmsFavoris(): Collection
    {
        return $this->filmsFavoris;
    }

    // Ajouter un film à la collection de films favoris
    public function addFilmFavori(Film $film): static
    {
        if (!$this->filmsFavoris->contains($film)) {
            $this->filmsFavoris[] = $film;
        }

        return $this;
    }

    // Retirer un film de la collection de films favoris
    public function removeFilmFavori(Film $film): static
    {
        $this->filmsFavoris->removeElement($film);

        return $this;
    }


}
