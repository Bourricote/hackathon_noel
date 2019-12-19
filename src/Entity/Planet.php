<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlanetRepository")
 */
class Planet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    private $distance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageArt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageTech;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $temperature;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $population;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getImageArt(): ?string
    {
        return $this->imageArt;
    }

    public function setImageArt(?string $imageArt): self
    {
        $this->imageArt = $imageArt;

        return $this;
    }

    public function getImageTech(): ?string
    {
        return $this->imageTech;
    }

    public function setImageTech(?string $imageTech): self
    {
        $this->imageTech = $imageTech;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(?string $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getPopulation(): ?string
    {
        return $this->population;
    }

    public function setPopulation(?string $population): self
    {
        $this->population = $population;

        return $this;
    }
}
