<?php


namespace App\Entity;


class Character
{
    protected $id;
    protected $name = '';
    protected $picture = '';
    protected $description = '';
    protected $comicsAppearances = [];

    public function __construct($data)
    {
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setPicture($data['picture']);
        $this->setDescription($data['description']);
        $this->setComicsAppearances($data['comicsAppearances']);
    }

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

    public function setComicsAppearances(array $comicsAppearances): self
    {
        $this->comicsAppearances = $comicsAppearances;

        return $this;
    }

    public function getComicsAppearances(): ?array
    {
        return $this->comicsAppearances;
    }
}