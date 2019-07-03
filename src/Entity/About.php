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

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $slide_text;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSlide2Text;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AboutLogo", inversedBy="abouts")
     */
    private $aboutLogo;

    public function __construct()
    {
        $this->landings = new ArrayCollection();
        $this->aboutImage = new ArrayCollection();
        $this->aboutLogo = new ArrayCollection();
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

    public function getSlideText(): ?string
    {
        return $this->slide_text;
    }

    public function setSlideText(?string $slide_text): self
    {
        $this->slide_text = $slide_text;

        return $this;
    }

    public function getIsSlide2Text(): ?bool
    {
        return $this->isSlide2Text;
    }

    public function setIsSlide2Text(bool $isSlide2Text): self
    {
        $this->isSlide2Text = $isSlide2Text;

        return $this;
    }

    /**
     * @return Collection|AboutLogo[]
     */
    public function getAboutLogo(): Collection
    {
        return $this->aboutLogo;
    }

    public function addAboutLogo(AboutLogo $aboutLogo): self
    {
        if (!$this->aboutLogo->contains($aboutLogo)) {
            $this->aboutLogo[] = $aboutLogo;
        }

        return $this;
    }

    public function removeAboutLogo(AboutLogo $aboutLogo): self
    {
        if ($this->aboutLogo->contains($aboutLogo)) {
            $this->aboutLogo->removeElement($aboutLogo);
        }

        return $this;
    }
}
