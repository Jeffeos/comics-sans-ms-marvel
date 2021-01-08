<?php


namespace App\Entity;


class Character
{
    protected $id;
    protected $name;
    protected $picture;

    public function __construct($data)
    {
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setPicture($data['picture']);
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
}