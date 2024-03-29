<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LandingRepository")
 */
class Landing
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone = "8 800 755 00 03";

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pharm", inversedBy="landings", cascade={"persist"})
     * @ORM\OrderBy({"sort" = "DESC"})
     */
    private $pharm;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\About", inversedBy="landings", cascade={"persist"})
     * @ORM\OrderBy({"sort" = "DESC"})     
     */
    private $about;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bonus", inversedBy="landings", cascade={"persist"})
     */
    private $bonus;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Action", inversedBy="landings", cascade={"persist"})
     * @ORM\OrderBy({"sort" = "DESC"})     
     */
    private $action;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="landings", cascade={"persist"})
     * @ORM\OrderBy({"sort" = "DESC"})
     */
    private $product;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $requisite_left;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $requisite_right;

    public function __construct()
    {
        $this->pharm = new ArrayCollection();
        $this->about = new ArrayCollection();
        $this->action = new ArrayCollection();
        $this->product = new ArrayCollection();
        $this->updatedAt = new \DateTime();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Pharm[]
     */
    public function getPharm(): Collection
    {
        return $this->pharm;
    }

    public function addPharm(Pharm $pharm): self
    {
        if (!$this->pharm->contains($pharm)) {
            $this->pharm[] = $pharm;
        }

        return $this;
    }

    public function removePharm(Pharm $pharm): self
    {
        if ($this->pharm->contains($pharm)) {
            $this->pharm->removeElement($pharm);
        }

        return $this;
    }

    /**
     * @return Collection|about[]
     */
    public function getAbout(): Collection
    {
        return $this->about;
    }

    public function addAbout(about $about): self
    {
        if (!$this->about->contains($about)) {
            $this->about[] = $about;
        }

        return $this;
    }

    public function removeAbout(about $about): self
    {
        if ($this->about->contains($about)) {
            $this->about->removeElement($about);
        }

        return $this;
    }

    public function getBonus(): ?bonus
    {
        return $this->bonus;
    }

    public function setBonus(?bonus $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * @return Collection|action[]
     */
    public function getAction(): Collection
    {
        return $this->action;
    }

    public function addAction(action $action): self
    {
        if (!$this->action->contains($action)) {
            $this->action[] = $action;
        }

        return $this;
    }

    public function removeAction(action $action): self
    {
        if ($this->action->contains($action)) {
            $this->action->removeElement($action);
        }

        return $this;
    }

    /**
     * @return Collection|product[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
        }

        return $this;
    }

    public function removeProduct(product $product): self
    {
        if ($this->product->contains($product)) {
            $this->product->removeElement($product);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getRequisiteLeft(): ?string
    {
        return $this->requisite_left;
    }

    public function setRequisiteLeft(?string $requisite_left): self
    {
        $this->requisite_left = $requisite_left;

        return $this;
    }

    public function getRequisiteRight(): ?string
    {
        return $this->requisite_right;
    }

    public function setRequisiteRight(?string $requisite_right): self
    {
        $this->requisite_right = $requisite_right;

        return $this;
    }
}
