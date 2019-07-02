<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BonusRepository")
 */
class Bonus
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label_color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title_color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bonus_pic;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Landing", mappedBy="bonus")
     */
    private $landings;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getLabelText(): ?string
    {
        return $this->label_text;
    }

    public function setLabelText(?string $label_text): self
    {
        $this->label_text = $label_text;

        return $this;
    }

    public function getLabelColor(): ?string
    {
        return $this->label_color;
    }

    public function setLabelColor(?string $label_color): self
    {
        $this->label_color = $label_color;

        return $this;
    }

    public function getTitleColor(): ?string
    {
        return $this->title_color;
    }

    public function setTitleColor(?string $title_color): self
    {
        $this->title_color = $title_color;

        return $this;
    }

    public function getBonusPic(): ?string
    {
        return $this->bonus_pic;
    }

    public function setBonusPic(?string $bonus_pic): self
    {
        $this->bonus_pic = $bonus_pic;

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
            $landing->setBonus($this);
        }

        return $this;
    }

    public function removeLanding(Landing $landing): self
    {
        if ($this->landings->contains($landing)) {
            $this->landings->removeElement($landing);
            // set the owning side to null (unless already changed)
            if ($landing->getBonus() === $this) {
                $landing->setBonus(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
