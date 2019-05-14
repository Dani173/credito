<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LevelRepository")
 */
class Level
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
    private $namelevel;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="subscriptionid")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Routine", mappedBy="idlevel")
     */
    private $idlevel;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->idlevel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamelevel(): ?string
    {
        return $this->namelevel;
    }

    public function setNamelevel(string $namelevel): self
    {
        $this->namelevel = $namelevel;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|Routine[]
     */
    public function getIdlevel(): Collection
    {
        return $this->idlevel;
    }

    public function addIdlevel(Routine $idlevel): self
    {
        if (!$this->idlevel->contains($idlevel)) {
            $this->idlevel[] = $idlevel;
            $idlevel->setIdlevel($this);
        }

        return $this;
    }

    public function removeIdlevel(Routine $idlevel): self
    {
        if ($this->idlevel->contains($idlevel)) {
            $this->idlevel->removeElement($idlevel);
            // set the owning side to null (unless already changed)
            if ($idlevel->getIdlevel() === $this) {
                $idlevel->setIdlevel(null);
            }
        }

        return $this;
    }
}
