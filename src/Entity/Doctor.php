<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctorRepository::class)
 */
class Doctor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\OneToOne(targetEntity=DoctorOffice::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $DoctorOffice;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getDoctorOffice(): ?DoctorOffice
    {
        return $this->DoctorOffice;
    }

    public function setDoctorOffice(DoctorOffice $DoctorOffice): self
    {
        $this->DoctorOffice = $DoctorOffice;

        return $this;
    }

}
