<?php


namespace App\DataFixtures;


use App\Entity\DoctorOffice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DoctorOfficeFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $doctorOfficeLabourse = new DoctorOffice();
        $doctorOfficeLabourse->setName("Cabinet de LABOURSE");
        $doctorOfficeLabourse->setAdress("8 Rue Des Châtaigniers ");
        $doctorOfficeLabourse->setPostalCode('62113');
        $doctorOfficeLabourse->setCity('Labourse, France');
        $doctorOfficeLabourse->setLatitude("2.68484");
        $doctorOfficeLabourse->setLongitude("50.4958");
        $manager->persist($doctorOfficeLabourse);
        $this->addReference("Office_Labourse", $doctorOfficeLabourse);

        $doctorOfficeBethune  = new DoctorOffice();
        $doctorOfficeBethune->setName("Cabinet de BÉTHUNE");
        $doctorOfficeBethune->setAdress("Grand Place, Grand Place");
        $doctorOfficeBethune->setPostalCode('62400');
        $doctorOfficeBethune->setCity('Béthune, as-de-Calais, France');
        $doctorOfficeBethune->setLatitude("2.640136");
        $doctorOfficeBethune->setLongitude("50.52986");
        $manager->persist($doctorOfficeBethune);
        $this->addReference("Office_Bethune", $doctorOfficeBethune);

        $doctorOfficeVerquigneul = new DoctorOffice();
        $doctorOfficeVerquigneul->setName("Cabinet de VERQUIGNEUL");
        $doctorOfficeVerquigneul->setAdress("Rue Du Docteur Leleu ");
        $doctorOfficeVerquigneul->setPostalCode('62113');
        $doctorOfficeVerquigneul->setCity('Verquigneul, France');
        $doctorOfficeVerquigneul->setLatitude("2.667152");
        $doctorOfficeVerquigneul->setLongitude("50.50121");
        $manager->persist($doctorOfficeVerquigneul);
        $this->addReference("Office_Verquigneul", $doctorOfficeVerquigneul);
    }
}