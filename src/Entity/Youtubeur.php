<?php

namespace App\Entity;

use App\Repository\YoutubeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=YoutubeurRepository::class)
 */
class Youtubeur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
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
     * @ORM\OneToMany(targetEntity=Setup::class, mappedBy="youtubeur")
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

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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
            $setup->setYoutubeur($this);
        }

        return $this;
    }

    public function removeSetup(Setup $setup): self
    {
        if ($this->setups->contains($setup)) {
            $this->setups->removeElement($setup);
            // set the owning side to null (unless already changed)
            if ($setup->getYoutubeur() === $this) {
                $setup->setYoutubeur(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
