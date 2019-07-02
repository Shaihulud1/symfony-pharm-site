<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AboutImageRepository")
 */
class AboutImage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo_pic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\About", inversedBy="aboutImage")
     */
    private $about;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAbout(): ?About
    {
        return $this->about;
    }

    public function setAbout(?About $about): self
    {
        $this->about = $about;

        return $this;
    }
}
