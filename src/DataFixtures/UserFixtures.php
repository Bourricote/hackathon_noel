<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use  Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    const LEVEL = [
        'Beginner',
        'Advanced',
        'Expert',
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_EN');

        $admin = new User();
        $admin->setEmail('anne.quiedeville@orange.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('Anne');
        $admin->setLastname('Quiedeville');
        $admin->setLevel(self::LEVEL[2]);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'
        ));

        $manager->persist($admin);
        $this->addReference('admin_0', $admin);

        //Creates 2 admin
        for ($i = 1; $i < 3; $i++){
            $admin = new User();
            $admin->setLastname($faker->lastName);
            $admin->setFirstname($faker->firstName);
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setEmail(strtolower($admin->getFirstname() . '.' . $admin->getLastname() . '@gmail.com'));
            $admin->setLevel(self::LEVEL[2]);
            $admin->setPassword($this->passwordEncoder->encodePassword(
                $admin,
                '1234'
            ));
            $manager->persist($admin);
            $this->addReference('admin_' . $i, $admin);
        }

        $subscriber = new User();
        $subscriber->setEmail('max.papin33@gmail.com');
        $subscriber->setRoles(['ROLE_SUBSCRIBER']);
        $subscriber->setFirstname('Maxime');
        $subscriber->setLastname('Papin');
        $subscriber->setLevel(self::LEVEL[0]);
        $subscriber->setPassword($this->passwordEncoder->encodePassword(
            $subscriber,
            '1234'
        ));
        $manager->persist($subscriber);
        $this->addReference('user_0', $subscriber);

        $subscriber = new User();
        $subscriber->setEmail('celine.godichon@gmail.com');
        $subscriber->setRoles(['ROLE_SUBSCRIBER']);
        $subscriber->setFirstname('Céline');
        $subscriber->setLastname('Godichon');
        $subscriber->setLevel(self::LEVEL[1]);
        $subscriber->setPassword($this->passwordEncoder->encodePassword(
            $subscriber,
            '1234'
        ));
        $manager->persist($subscriber);
        $this->addReference('user_1', $subscriber);

        //Creates 9 subscribers
        for ($i = 2; $i < 11; $i++){
            $subscriber = new User();
            $subscriber->setLastname($faker->lastName);
            $subscriber->setFirstname($faker->firstName);
            $subscriber->setRoles(['ROLE_SUBSCRIBER']);
            $subscriber->setEmail(strtolower($subscriber->getFirstname() . '.' . $subscriber->getLastname() . '@gmail.com'));
            $number = rand(0,2);
            $subscriber->setLevel(self::LEVEL[$number]);
            $subscriber->setPassword($this->passwordEncoder->encodePassword(
                $subscriber,
                '1234'
            ));
            $manager->persist($subscriber);
            $this->addReference('user_' . $i, $subscriber);
        }


        $manager->flush();
    }
}
