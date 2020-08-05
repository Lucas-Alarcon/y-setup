<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="equipments")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity=Setup::class, mappedBy="equipments")
     */
    private $setups;

    public function __construct()
    {
        $this->setups = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Setup[]
     */
    public function getSetups(): Collection
    {
        return $this->setups;
    }

    public function addSetup(Setup $setup): self
    {
        if (!$this->setups->contains($setup)) {
            $this->setups[] = $setup;
            $setup->addEquipment($this);
        }

        return $this;
    }

    public function removeSetup(Setup $setup): self
    {
        if ($this->setups->contains($setup)) {
            $this->setups->removeElement($setup);
            $setup->removeEquipment($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
