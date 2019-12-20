<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        $subscriber = new User();
        $subscriber->setEmail('max.papin33@gmail.com');
        $subscriber->setRoles(['ROLE_SUBSCRIBER']);
        $subscriber->setFirstname('Maxime');
        $subscriber->setLastname('Papin');
        $subscriber->setLevel(self::LEVEL[0]);
        $subscriber->setImage('baby-yoda.jpg');
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
        $subscriber->setImage('baby-squid.jpg');
        $subscriber->setPassword($this->passwordEncoder->encodePassword(
            $subscriber,
            '1234'
        ));
        $manager->persist($subscriber);
        $this->addReference('user_1', $subscriber);

        $admin = new User();
        $admin->setEmail('anne.quiedeville@orange.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('Anne');
        $admin->setLastname('Quiedeville');
        $admin->setLevel(self::LEVEL[2]);
        $admin->setImage('groot.jpg');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'
        ));

        $manager->persist($admin);
        $this->addReference('user_2', $admin);
        $manager->flush();
    }
}
