<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Jouer;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column]
    private ?int $anneeSortie = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Jouer", mappedBy="film")
     */
    private Collection $joueurs;

    // Le constructeur pour initialiser la collection
    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAnneeSortie(): ?int
    {
        return $this->anneeSortie;
    }

    public function setAnneeSortie(int $anneeSortie): static
    {
        $this->anneeSortie = $anneeSortie;

        return $this;
    }

    // Getter pour les joueurs (relation OneToMany)
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    // Setter pour les joueurs (optionnel, mais vous pouvez l'ajouter si nécessaire)
    public function setJoueurs(Collection $joueurs): static
    {
        $this->joueurs = $joueurs;

        return $this;
    }
}
