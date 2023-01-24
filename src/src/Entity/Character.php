<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
#[ApiResource]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $imageUrl = null;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'characters')]
    private Collection $films;

    #[ORM\ManyToMany(targetEntity: TvShows::class, mappedBy: 'characters')]
    private Collection $tvShows;

    #[ORM\ManyToMany(targetEntity: VideoGames::class, mappedBy: 'characters')]
    private Collection $videoGames;

    #[ORM\ManyToMany(targetEntity: ParkAttractions::class, mappedBy: 'characters')]
    private Collection $parkAttractions;

    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->tvShows = new ArrayCollection();
        $this->videoGames = new ArrayCollection();
        $this->parkAttractions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films->add($film);
            $film->addCharacter($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->removeElement($film)) {
            $film->removeCharacter($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, TvShows>
     */
    public function getTvShows(): Collection
    {
        return $this->tvShows;
    }

    public function addTvShow(TvShows $tvShow): self
    {
        if (!$this->tvShows->contains($tvShow)) {
            $this->tvShows->add($tvShow);
            $tvShow->addCharacter($this);
        }

        return $this;
    }

    public function removeTvShow(TvShows $tvShow): self
    {
        if ($this->tvShows->removeElement($tvShow)) {
            $tvShow->removeCharacter($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, VideoGames>
     */
    public function getVideoGames(): Collection
    {
        return $this->videoGames;
    }

    public function addVideoGame(VideoGames $videoGame): self
    {
        if (!$this->videoGames->contains($videoGame)) {
            $this->videoGames->add($videoGame);
            $videoGame->addCharacter($this);
        }

        return $this;
    }

    public function removeVideoGame(VideoGames $videoGame): self
    {
        if ($this->videoGames->removeElement($videoGame)) {
            $videoGame->removeCharacter($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ParkAttractions>
     */
    public function getParkAttractions(): Collection
    {
        return $this->parkAttractions;
    }

    public function addParkAttraction(ParkAttractions $parkAttraction): self
    {
        if (!$this->parkAttractions->contains($parkAttraction)) {
            $this->parkAttractions->add($parkAttraction);
            $parkAttraction->addCharacter($this);
        }

        return $this;
    }

    public function removeParkAttraction(ParkAttractions $parkAttraction): self
    {
        if ($this->parkAttractions->removeElement($parkAttraction)) {
            $parkAttraction->removeCharacter($this);
        }

        return $this;
    }
}
