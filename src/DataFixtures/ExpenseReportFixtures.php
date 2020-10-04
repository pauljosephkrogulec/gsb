<?php

namespace App\DataFixtures;

use App\Entity\ExpenseReports;
use App\Entity\ExpenseReportStatues;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExpenseReportFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        /* @var ExpenseReportStatues $status */
        $status = $this->getReference('Enc');
        for ($i = 0; $i < 20; $i++) {
            $y = rand(0, 19);
            /** @var Users $user */
            $user = $this->getReference("user_{$y}");
            $month = $i%12;
            $expenseReport = new ExpenseReports();
            $expenseReport->setUser($user)
                ->setExpencesReportStatus($status)
                ->setReportDate(new \DateTime("2018-{$month}-01"));
            $manager->persist($expenseReport);
            $this->addReference("ExpenseReport_{$i}", $expenseReport);
        }

        $manager->flush();
    }
    public function getDependencies() {
        return [
            UsersFixtures::class,
            ExpenseReportStatuesFixtures::class
        ];
    }
}