<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActionRepository")
 */
class Action
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
    private $action_pic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo_pic;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $text_color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label_color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Landing", mappedBy="action")
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

    public function getActionPic(): ?string
    {
        return $this->action_pic;
    }

    public function setActionPic(?string $action_pic): self
    {
        $this->action_pic = $action_pic;

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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->text_color;
    }

    public function setTextColor(?string $text_color): self
    {
        $this->text_color = $text_color;

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

    public function getLabelText(): ?string
    {
        return $this->label_text;
    }

    public function setLabelText(?string $label_text): self
    {
        $this->label_text = $label_text;

        return $this;
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
            $landing->addAction($this);
        }

        return $this;
    }

    public function removeLanding(Landing $landing): self
    {
        if ($this->landings->contains($landing)) {
            $this->landings->removeElement($landing);
            $landing->removeAction($this);
        }

        return $this;
    }
}
