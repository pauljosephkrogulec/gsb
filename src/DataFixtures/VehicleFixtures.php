<?php


namespace App\DataFixtures;


use App\Entity\Brands;
use App\Entity\Vehicles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use MattWells\Faker\Vehicle\Provider as VehicleProvider;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{

    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
        $this->faker->addProvider(new VehicleProvider($this->faker));
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 30; $i++) {
            /** @var Brands $brand */
            $brand = $this->getReference('Brand_' . rand(0, 4));
            $vehicle = new Vehicles();
            $vehicle->setBrand($brand);
            $vehicle->setModel($this->faker->vehicleModel($brand->getName()));
            $vehicle->setMatriculation($this->faker->vehicleRegistration);
            $manager->persist($vehicle);
            $this->addReference("vehicle_".$i, $vehicle);
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
            BrandFixtures::class
        ];
    }
}