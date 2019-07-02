<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AboutRepository")
 */
class About
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Landing", mappedBy="about")
     */
    private $landings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AboutImage", mappedBy="about", cascade={"persist"})
     */
    private $aboutImage;

    public function __construct()
    {
        $this->landings = new ArrayCollection();
        $this->aboutImage = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
            $landing->addAbout($this);
        }

        return $this;
    }

    public function removeLanding(Landing $landing): self
    {
        if ($this->landings->contains($landing)) {
            $this->landings->removeElement($landing);
            $landing->removeAbout($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Collection|AboutImage[]
     */
    public function getAboutImage(): Collection
    {
        return $this->aboutImage;
    }

    public function addAboutImage(AboutImage $aboutImage): self
    {
        if (!$this->aboutImage->contains($aboutImage)) {
            $this->aboutImage[] = $aboutImage;
            $aboutImage->setAbout($this);
        }

        return $this;
    }

    public function removeAboutImage(AboutImage $aboutImage): self
    {
        if ($this->aboutImage->contains($aboutImage)) {
            $this->aboutImage->removeElement($aboutImage);
            // set the owning side to null (unless already changed)
            if ($aboutImage->getAbout() === $this) {
                $aboutImage->setAbout(null);
            }
        }

        return $this;
    }
}
