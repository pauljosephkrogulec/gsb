<?php

namespace App\Entity;

use App\Repository\ExpenseReportStatuesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpenseReportStatuesRepository::class)
 */
class ExpenseReportStatues
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
    private $wording;

    /**
     * @ORM\OneToMany(targetEntity=ExpenseReports::class, mappedBy="expences_report_status")
     */
    private $expenseReports;

    public function __construct()
    {
        $this->expenseReports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

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
            $expenseReport->setExpencesReportStatus($this);
        }

        return $this;
    }

    public function removeExpenseReport(ExpenseReports $expenseReport): self
    {
        if ($this->expenseReports->contains($expenseReport)) {
            $this->expenseReports->removeElement($expenseReport);
            // set the owning side to null (unless already changed)
            if ($expenseReport->getExpencesReportStatus() === $this) {
                $expenseReport->setExpencesReportStatus(null);
            }
        }

        return $this;
    }
}
