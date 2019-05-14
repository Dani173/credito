<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MusclegroupsRepository")
 */
class Musclegroups
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
    private $namemusclegroups;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Exercise", inversedBy="exercise")
     */
    private $exercise;

    public function __construct()
    {
        $this->exercise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamemusclegroups(): ?string
    {
        return $this->namemusclegroups;
    }

    public function setNamemusclegroups(string $namemusclegroups): self
    {
        $this->namemusclegroups = $namemusclegroups;

        return $this;
    }

    /**
     * @return Collection|Exercise[]
     */
    public function getExercise(): Collection
    {
        return $this->exercise;
    }

    public function addExercise(Exercise $exercise): self
    {
        if (!$this->exercise->contains($exercise)) {
            $this->exercise[] = $exercise;
        }

        return $this;
    }

    public function removeExercise(Exercise $exercise): self
    {
        if ($this->exercise->contains($exercise)) {
            $this->exercise->removeElement($exercise);
        }

        return $this;
    }
}
