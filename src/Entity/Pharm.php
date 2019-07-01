<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PharmRepository")
 */
class Pharm
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
    private $pharm_pic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coords;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Landing", mappedBy="pharm")
     */
    private $landings;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Advantage", inversedBy="pharms", cascade={"persist"})
     */
    private $advantage;

    public function __construct()
    {
        $this->landings = new ArrayCollection();
        $this->advantage = new ArrayCollection();
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

    public function getPharmPic(): ?string
    {
        return $this->pharm_pic;
    }

    public function setPharmPic(?string $pharm_pic): self
    {
        $this->pharm_pic = $pharm_pic;

        return $this;
    }

    public function getCoords(): ?string
    {
        return $this->coords;
    }

    public function setCoords(?string $coords): self
    {
        $this->coords = $coords;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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
            $landing->addPharm($this);
        }

        return $this;
    }

    public function removeLanding(Landing $landing): self
    {
        if ($this->landings->contains($landing)) {
            $this->landings->removeElement($landing);
            $landing->removePharm($this);
        }

        return $this;
    }

    /**
     * @return Collection|advantage[]
     */
    public function getAdvantage(): Collection
    {
        return $this->advantage;
    }

    public function addAdvantage(advantage $advantage): self
    {
        if (!$this->advantage->contains($advantage)) {
            $this->advantage[] = $advantage;
        }

        return $this;
    }

    public function removeAdvantage(advantage $advantage): self
    {
        if ($this->advantage->contains($advantage)) {
            $this->advantage->removeElement($advantage);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
