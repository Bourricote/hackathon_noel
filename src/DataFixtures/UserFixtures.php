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
        $subscriber->setImage('https://www.thewrap.com/wp-content/uploads/2019/12/baby-yoda-soup.jpg');
        $subscriber->setPassword($this->passwordEncoder->encodePassword(
            $subscriber,
            '1234'
        ));
        $subscriber->addMission($this->getReference('mission_' . rand(0,2)));
        $manager->persist($subscriber);
        $this->addReference('user_0');

        $admin = new User();
        $admin->setEmail('anne.quiedeville@orange.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('Anne');
        $admin->setLastname('Quiedeville');
        $admin->setLevel(self::LEVEL[2]);
        $admin->setImage('https://www.hjackets.com/wp-content/uploads/2017/04/baby-groot-5k-2018-artwork-9d-1280x2120.jpg');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'
        ));

        $manager->persist($admin);
        $manager->flush();
    }
}
