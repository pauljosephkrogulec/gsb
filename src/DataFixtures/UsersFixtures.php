<?php

namespace App\DataFixtures;

use App\Entity\Roles;
use App\Entity\User;
use App\Entity\Users;
use App\Entity\Vehicles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create('fr_FR');
    }

    function normalize ($string) {
        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y',
            'Ŕ'=>'R', 'ŕ'=>'r',
        );

        return strtr($string, $table);
    }


    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {

        /* @var Vehicles $vehicle*/
        $vehicle = $this->getReference('vehicle_0');
        /* @var Roles $role */
        $role = $this->getReference('ROLE_PARC_AUTO');
        $user = new Users();
        $user->setFirstName("Paul-Joseph")
            ->setLastName("Krogulec")
            ->setAdress('')
            ->setPostalCode('')
            ->setCity($this->faker->city)
            ->setEmail("pauljosephkrogulec5@gmail.com")
            ->setToken('')
            ->setVehicle($vehicle)
            ->setPassword(hash('sha512','admin'))
            ->setRole($role);
        $manager->persist($user);
        for ($i = 0; $i < 50; $i++) {
            $vehicle = NULL;
            $role = $this->getReference('ROLE_VISITEUR');
            if($i+1 < 29)$vehicle = $this->getReference('vehicle_'.($i+1));
            if($i%2==0) $role = $this->getReference('ROLE_PARC_AUTO');
            $firstName = $this->faker->firstName;
            $lastName = $this->faker->lastName;
            $address = $this->faker->streetAddress;
            $postCode = $this->faker->postcode;
            $city = $this->faker->city . ', ' . $this->faker->country;
            $email = mb_strtolower($this->normalize("{$firstName}.{$lastName}@{$this->faker->safeEmailDomain}"));
            $user = new Users();
            $user->setFirstName($firstName)
                ->setLastName($lastName)
                ->setAdress($address)
                ->setPostalCode($postCode)
                ->setToken('')
                ->setCity($city)
                ->setEmail($email)
                ->setVehicle($vehicle)
                ->setRole($role)
                ->setPassword(hash('sha512',$lastName));
            $this->addReference('user_'.$i,$user);
            $manager->persist($user);

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
            RoleFixtures::class,
            VehicleFixtures::class
        ];
    }
}
