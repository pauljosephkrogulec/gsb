<?php

namespace App\Entity;

use App\Repository\ExpenseReportsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpenseReportsRepository::class)
 */
class ExpenseReports
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ExpenseReportStatues::class, inversedBy="expenseReports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expences_report_status;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="expenseReports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $report_date;

    /**
     * @ORM\OneToMany(targetEntity=ExpenseReportLines::class, mappedBy="expense_report")
     */
    private $expenseReportLines;

    public function __construct()
    {
        $this->expenseReportLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpencesReportStatus(): ?ExpenseReportStatues
    {
        return $this->expences_report_status;
    }

    public function setExpencesReportStatus(?ExpenseReportStatues $expences_report_status): self
    {
        $this->expences_report_status = $expences_report_status;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getReportDate(): ?\DateTimeInterface
    {
        return $this->report_date;
    }

    public function setReportDate(\DateTimeInterface $report_date): self
    {
        $this->report_date = $report_date;

        return $this;
    }

    /**
     * @return Collection|ExpenseReportLines[]
     */
    public function getExpenseReportLines(): Collection
    {
        return $this->expenseReportLines;
    }

    public function addExpenseReportLine(ExpenseReportLines $expenseReportLine): self
    {
        if (!$this->expenseReportLines->contains($expenseReportLine)) {
            $this->expenseReportLines[] = $expenseReportLine;
            $expenseReportLine->setExpenseReport($this);
        }

        return $this;
    }

    public function removeExpenseReportLine(ExpenseReportLines $expenseReportLine): self
    {
        if ($this->expenseReportLines->contains($expenseReportLine)) {
            $this->expenseReportLines->removeElement($expenseReportLine);
            // set the owning side to null (unless already changed)
            if ($expenseReportLine->getExpenseReport() === $this) {
                $expenseReportLine->setExpenseReport(null);
            }
        }

        return $this;
    }
}
