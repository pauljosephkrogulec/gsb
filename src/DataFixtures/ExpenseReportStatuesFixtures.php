<?php


namespace App\DataFixtures;


use App\Entity\ExpenseReportStatues;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpenseReportStatuesFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $expenseReportStatusEnc = new ExpenseReportStatues();
        $expenseReportStatusEnc->setWording("En cours");
        $manager->persist($expenseReportStatusEnc);
        $this->addReference("Enc", $expenseReportStatusEnc);

        $expenseReportStatusTer = new ExpenseReportStatues();
        $expenseReportStatusTer->setWording("Terminé");
        $manager->persist($expenseReportStatusTer);

        $this->addReference("Ter", $expenseReportStatusTer);
        $manager->flush();
    }
}