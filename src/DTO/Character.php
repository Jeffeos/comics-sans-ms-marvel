<?php

namespace App\DTO;

class Character
{
    private int $id;
    private string $name = '';
    private string $picture = '';
    private string $description = '';
    /** @var Comics[] */
    private array $comicsAppearances = [];

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function addComicsAppearances(Comics $comic): self
    {
        $this->comicsAppearances[] = $comic;

        return $this;
    }

    /**
     * @return Comics[]
     */
    public function getComicsAppearances()
    {
        return $this->comicsAppearances;
    }
}
