<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Vehicles::class, cascade={"persist", "remove"})
     */
    private $vehicle;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $token;

    /**
     * @ORM\OneToMany(targetEntity=ExpenseReports::class, mappedBy="user", orphanRemoval=true)
     */
    private $expenseReports;

    /**
     * @ORM\ManyToOne(targetEntity=Roles::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Role;



    public function __construct()
    {
        $this->expenseReports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicle(): ?vehicles
    {
        return $this->vehicle;
    }

    public function setVehicle(?vehicles $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Collection|ExpenseReports[]
     */
    public function getExpenseReports(): Collection
    {
        return $this->expenseReports;
    }

    public function addExpenseReport(ExpenseReports $expenseReport): self
    {
        if (!$this->expenseReports->contains($expenseReport)) {
            $this->expenseReports[] = $expenseReport;
            $expenseReport->setUser($this);
        }

        return $this;
    }

    public function removeExpenseReport(ExpenseReports $expenseReport): self
    {
        if ($this->expenseReports->contains($expenseReport)) {
            $this->expenseReports->removeElement($expenseReport);
            // set the owning side to null (unless already changed)
            if ($expenseReport->getUser() === $this) {
                $expenseReport->setUser(null);
            }
        }

        return $this;
    }

    public function getRole(): ?Roles
    {
        return $this->Role;
    }

    public function setRole(Roles $role): self
    {
        $this->Role = $role;

        return $this;
    }

}
