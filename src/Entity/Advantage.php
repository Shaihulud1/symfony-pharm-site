<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdvantageRepository")
 */
class Advantage
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
    private $adv_pic;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pharm", mappedBy="advantage")
     */
    private $pharms;

    public function __construct()
    {
        $this->pharms = new ArrayCollection();
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

    public function getAdvPic(): ?string
    {
        return $this->adv_pic;
    }

    public function setAdvPic(string $adv_pic): self
    {
        $this->adv_pic = $adv_pic;

        return $this;
    }

    /**
     * @return Collection|Pharm[]
     */
    public function getPharms(): Collection
    {
        return $this->pharms;
    }

    public function addPharm(Pharm $pharm): self
    {
        if (!$this->pharms->contains($pharm)) {
            $this->pharms[] = $pharm;
            $pharm->addAdvantage($this);
        }

        return $this;
    }

    public function removePharm(Pharm $pharm): self
    {
        if ($this->pharms->contains($pharm)) {
            $this->pharms->removeElement($pharm);
            $pharm->removeAdvantage($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
