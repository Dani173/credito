<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
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
    private $namerole;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="role")
     */
    private $id_rolesusuarios;

    public function __construct()
    {
        $this->id_rolesusuarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamerole(): ?string
    {
        return $this->namerole;
    }

    public function setNamerole(string $namerole): self
    {
        $this->namerole = $namerole;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdRolesusuarios(): Collection
    {
        return $this->id_rolesusuarios;
    }

    public function addIdRolesusuario(User $idRolesusuario): self
    {
        if (!$this->id_rolesusuarios->contains($idRolesusuario)) {
            $this->id_rolesusuarios[] = $idRolesusuario;
            $idRolesusuario->addRole($this);
        }

        return $this;
    }

    public function removeIdRolesusuario(User $idRolesusuario): self
    {
        if ($this->id_rolesusuarios->contains($idRolesusuario)) {
            $this->id_rolesusuarios->removeElement($idRolesusuario);
            $idRolesusuario->removeRole($this);
        }

        return $this;
    }
}
