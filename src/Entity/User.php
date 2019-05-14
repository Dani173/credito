<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $accountnumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateofbirth;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", inversedBy="id_rolesusuarios")
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Level", mappedBy="user")
     */
    private $subscriptionid;

    public function __construct()
    {
        $this->role = new ArrayCollection();
        $this->subscriptionid = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAccountnumber(): ?string
    {
        return $this->accountnumber;
    }

    public function setAccountnumber(string $accountnumber): self
    {
        $this->accountnumber = $accountnumber;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDateofbirth(): ?\DateTimeInterface
    {
        return $this->dateofbirth;
    }

    public function setDateofbirth(\DateTimeInterface $dateofbirth): self
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Role $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
        }

        return $this;
    }

    /**
     * @return Collection|Level[]
     */
    public function getSubscriptionid(): Collection
    {
        return $this->subscriptionid;
    }

    public function addSubscriptionid(Level $subscriptionid): self
    {
        if (!$this->subscriptionid->contains($subscriptionid)) {
            $this->subscriptionid[] = $subscriptionid;
            $subscriptionid->addUser($this);
        }

        return $this;
    }

    public function removeSubscriptionid(Level $subscriptionid): self
    {
        if ($this->subscriptionid->contains($subscriptionid)) {
            $this->subscriptionid->removeElement($subscriptionid);
            $subscriptionid->removeUser($this);
        }

        return $this;
    }
}
