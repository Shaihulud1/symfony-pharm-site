<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $product_pic;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Landing", mappedBy="product")
     */
    private $landings;

    public function __construct()
    {
        $this->landings = new ArrayCollection();
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProductPic(): ?string
    {
        return $this->product_pic;
    }

    public function setProductPic(?string $product_pic): self
    {
        $this->product_pic = $product_pic;

        return $this;
    }

    /**
     * @return Collection|Landing[]
     */
    public function getLandings(): Collection
    {
        return $this->landings;
    }

    public function addLanding(Landing $landing): self
    {
        if (!$this->landings->contains($landing)) {
            $this->landings[] = $landing;
            $landing->addProduct($this);
        }

        return $this;
    }

    public function removeLanding(Landing $landing): self
    {
        if ($this->landings->contains($landing)) {
            $this->landings->removeElement($landing);
            $landing->removeProduct($this);
        }

        return $this;
    }
}
