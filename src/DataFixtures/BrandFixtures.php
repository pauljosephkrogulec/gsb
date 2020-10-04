<?php

namespace App\DataFixtures;


use App\Entity\Brands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use \MattWells\Faker\Vehicle\Provider as VehicleProvider;

class BrandFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
        $this->faker->addProvider(new VehicleProvider($this->faker));
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $brand = new Brands();
            $brand->setName($this->faker->vehicleMake);
            $manager->persist($brand);

            $this->addReference('Brand_' . $i, $brand);
        }

        $manager->flush();
    }
}