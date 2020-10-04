<?php

namespace App\DataFixtures;

use App\Entity\ExpenseCategories;
use App\Entity\ExpenseReportStatues;
use App\Entity\ExpenseReportLines;
use App\Entity\ExpenseReports;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExportReportLinesFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $x = rand(0, 19);
            $y = rand(0, 5);
            /** @var ExpenseReports $expenseReport */
            $expenseReport = $this->getReference("ExpenseReport_{$x}");
            /** @var ExpenseCategories $expenseCategory */
            $expenseCategory = $this->getReference("ExpenseCategory_{$y}");

            if ($i % 2) {
                $expenseReportLine = new ExpenseReportLines();
                $expenseReportLine->setQuantity($this->faker->randomDigit)
                    ->setAmount($this->faker->randomFloat(2, '10', '2000'))
                    ->setExpenseReport($expenseReport)
                    ->setExpenseCategory($expenseCategory)
                    ->setExpenseDate($this->faker->dateTimeThisMonth())
                    ->setWording($this->faker->jobTitle);
                $manager->persist($expenseReportLine);
            } else {
                $expenseReportLine = new ExpenseReportLines();
                $expenseReportLine->setAmount($this->faker->randomFloat(2, '10', '2000'))
                    ->setQuantity($this->faker->randomDigit)
                    ->setExpenseReport($expenseReport)
                    ->setExpenseCategory($expenseCategory)
                    ->setExpenseDate($this->faker->dateTimeThisMonth())
                    ->setWording($this->faker->jobTitle);
                $manager->persist($expenseReportLine);
            }
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            ExpenseCategoryFixtures::class,
            ExpenseReportFixtures::class
        ];
    }
}
