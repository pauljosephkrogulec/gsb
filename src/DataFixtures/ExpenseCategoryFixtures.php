<?php

namespace App\DataFixtures;

use App\Entity\ExpenseCategories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExpenseCategoryFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 6; $i++) {
            $expenseCategory = new ExpenseCategories();
            $expenseCategory->setWording($this->faker->numerify("Category ###"))
                ->setAmount($this->faker->randomNumber(2));
            $manager->persist($expenseCategory);
            $this->addReference("ExpenseCategory_{$i}", $expenseCategory);
        }

        $manager->flush();
    }

}
