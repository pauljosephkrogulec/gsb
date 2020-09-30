<?php

namespace App\Entity;

use App\Repository\ExpenseReportLinesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpenseReportLinesRepository::class)
 */
class ExpenseReportLines
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ExpenseReports::class, inversedBy="expenseReportLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expense_report;

    /**
     * @ORM\ManyToOne(targetEntity=ExpenseCategories::class, inversedBy="expenseReportLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expense_category;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $wording;

    /**
     * @ORM\Column(type="smallint")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="date")
     */
    private $expense_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpenseReport(): ?expenseReports
    {
        return $this->expense_report;
    }

    public function setExpenseReport(?expenseReports $expense_report): self
    {
        $this->expense_report = $expense_report;

        return $this;
    }

    public function getExpenseCategory(): ?ExpenseCategories
    {
        return $this->expense_category;
    }

    public function setExpenseCategory(?ExpenseCategories $expense_category): self
    {
        $this->expense_category = $expense_category;

        return $this;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getExpenseDate(): ?\DateTimeInterface
    {
        return $this->expense_date;
    }

    public function setExpenseDate(\DateTimeInterface $expense_date): self
    {
        $this->expense_date = $expense_date;

        return $this;
    }
}
