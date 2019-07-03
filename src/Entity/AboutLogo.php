<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AboutLogoRepository")
 */
class AboutLogo
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
    private $logo_pic;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\About", mappedBy="aboutLogo")
     */
    private $abouts;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sort = 1;

    public function __construct()
    {
        $this->abouts = new ArrayCollection();
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

    public function getLogoPic(): ?string
    {
        return $this->logo_pic;
    }

    public function setLogoPic(?string $logo_pic): self
    {
        $this->logo_pic = $logo_pic;

        return $this;
    }

    /**
     * @return Collection|About[]
     */
    public function getAbouts(): Collection
    {
        return $this->abouts;
    }

    public function addAbout(About $about): self
    {
        if (!$this->abouts->contains($about)) {
            $this->abouts[] = $about;
            $about->addAboutLogo($this);
        }

        return $this;
    }

    public function removeAbout(About $about): self
    {
        if ($this->abouts->contains($about)) {
            $this->abouts->removeElement($about);
            $about->removeAboutLogo($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(?int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }
}
