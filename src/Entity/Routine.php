<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoutineRepository")
 */
class Routine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Level", inversedBy="idlevel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idlevel;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Exercise", mappedBy="rutina")
     */
    private $routine;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Challenges", mappedBy="routine")
     */
    private $challenges;

    public function __construct()
    {
        $this->routine = new ArrayCollection();
        $this->challenges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getIdlevel(): ?Level
    {
        return $this->idlevel;
    }

    public function setIdlevel(?Level $idlevel): self
    {
        $this->idlevel = $idlevel;

        return $this;
    }

    /**
     * @return Collection|Exercise[]
     */
    public function getRoutine(): Collection
    {
        return $this->routine;
    }

    public function addRoutine(Exercise $routine): self
    {
        if (!$this->routine->contains($routine)) {
            $this->routine[] = $routine;
            $routine->addRutina($this);
        }

        return $this;
    }

    public function removeRoutine(Exercise $routine): self
    {
        if ($this->routine->contains($routine)) {
            $this->routine->removeElement($routine);
            $routine->removeRutina($this);
        }

        return $this;
    }

    /**
     * @return Collection|Challenges[]
     */
    public function getChallenges(): Collection
    {
        return $this->challenges;
    }

    public function addChallenge(Challenges $challenge): self
    {
        if (!$this->challenges->contains($challenge)) {
            $this->challenges[] = $challenge;
            $challenge->addRoutine($this);
        }

        return $this;
    }

    public function removeChallenge(Challenges $challenge): self
    {
        if ($this->challenges->contains($challenge)) {
            $this->challenges->removeElement($challenge);
            $challenge->removeRoutine($this);
        }

        return $this;
    }
}
