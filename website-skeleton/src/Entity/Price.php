<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $person;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $price_week;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $price_wednesday;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerson(): ?string
    {
        return $this->person;
    }

    public function setPerson(string $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getPriceWeek(): ?string
    {
        return $this->price_week;
    }

    public function setPriceWeek(string $price_week): self
    {
        $this->price_week = $price_week;

        return $this;
    }

    public function getPriceWednesday(): ?string
    {
        return $this->price_wednesday;
    }

    public function setPriceWednesday(string $price_wednesday): self
    {
        $this->price_wednesday = $price_wednesday;

        return $this;
    }
}
