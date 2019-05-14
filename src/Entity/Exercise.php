<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciseRepository")
 */
class Exercise
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
    private $nameexercise;

    /**
     * @ORM\Column(type="integer")
     */
    private $series;

    /**
     * @ORM\Column(type="integer")
     */
    private $repetitions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Routine", inversedBy="routine")
     */
    private $rutina;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Musclegroups", mappedBy="exercise")
     */
    private $exercise;

    public function __construct()
    {
        $this->rutina = new ArrayCollection();
        $this->exercise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameexercise(): ?string
    {
        return $this->nameexercise;
    }

    public function setNameexercise(string $nameexercise): self
    {
        $this->nameexercise = $nameexercise;

        return $this;
    }

    public function getSeries(): ?int
    {
        return $this->series;
    }

    public function setSeries(int $series): self
    {
        $this->series = $series;

        return $this;
    }

    public function getRepetitions(): ?int
    {
        return $this->repetitions;
    }

    public function setRepetitions(int $repetitions): self
    {
        $this->repetitions = $repetitions;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection|Routine[]
     */
    public function getRutina(): Collection
    {
        return $this->rutina;
    }

    public function addRutina(Routine $rutina): self
    {
        if (!$this->rutina->contains($rutina)) {
            $this->rutina[] = $rutina;
        }

        return $this;
    }

    public function removeRutina(Routine $rutina): self
    {
        if ($this->rutina->contains($rutina)) {
            $this->rutina->removeElement($rutina);
        }

        return $this;
    }

    /**
     * @return Collection|Musclegroups[]
     */
    public function getExercise(): Collection
    {
        return $this->exercise;
    }

    public function addExercise(Musclegroups $exercise): self
    {
        if (!$this->exercise->contains($exercise)) {
            $this->exercise[] = $exercise;
            $exercise->addExercise($this);
        }

        return $this;
    }

    public function removeExercise(Musclegroups $exercise): self
    {
        if ($this->exercise->contains($exercise)) {
            $this->exercise->removeElement($exercise);
            $exercise->removeExercise($this);
        }

        return $this;
    }
}
