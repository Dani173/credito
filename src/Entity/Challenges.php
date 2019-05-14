<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChallengesRepository")
 */
class Challenges
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
    private $namechallenges;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Routine", inversedBy="challenges")
     */
    private $routine;

    public function __construct()
    {
        $this->routine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamechallenges(): ?string
    {
        return $this->namechallenges;
    }

    public function setNamechallenges(string $namechallenges): self
    {
        $this->namechallenges = $namechallenges;

        return $this;
    }

    /**
     * @return Collection|Routine[]
     */
    public function getRoutine(): Collection
    {
        return $this->routine;
    }

    public function addRoutine(Routine $routine): self
    {
        if (!$this->routine->contains($routine)) {
            $this->routine[] = $routine;
        }

        return $this;
    }

    public function removeRoutine(Routine $routine): self
    {
        if ($this->routine->contains($routine)) {
            $this->routine->removeElement($routine);
        }

        return $this;
    }
}
