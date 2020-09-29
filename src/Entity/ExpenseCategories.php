<?php

namespace App\Entity;

use App\Repository\ExpenseCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpenseCategoriesRepository::class)
 */
class ExpenseCategories
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
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\OneToMany(targetEntity=ExpenseReportLines::class, mappedBy="expense_category")
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

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

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
            $expenseReportLine->setExpenseCategory($this);
        }

        return $this;
    }

    public function removeExpenseReportLine(ExpenseReportLines $expenseReportLine): self
    {
        if ($this->expenseReportLines->contains($expenseReportLine)) {
            $this->expenseReportLines->removeElement($expenseReportLine);
            // set the owning side to null (unless already changed)
            if ($expenseReportLine->getExpenseCategory() === $this) {
                $expenseReportLine->setExpenseCategory(null);
            }
        }

        return $this;
    }
}
