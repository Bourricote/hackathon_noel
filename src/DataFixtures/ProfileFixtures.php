<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProfileFixtures extends Fixture implements DependentFixtureInterface
{

    const PICTURES = [
        'picture_1.jpg',
        'picture_2.jpg',
        'picture_3.jpg',
        'picture_4.jpg',
        'picture_5.png',
        'picture_6.jpg',
        'picture_7.jpg',
        'picture_8.jpg',
        'picture_9.jpg',
        'picture_10.jpeg',
        'picture_11.jpg',
    ];

    public function load(ObjectManager $manager)
    {
        // Anne
        $profile = new Profile();
        $profile->setImageName('groot.jpg');
        $profile->setUserId($this->getReference('admin_0')->getId());
        $manager->persist($profile);

        // Max
        $profile = new Profile();
        $profile->setImageName('baby-yoda.jpg');
        $profile->setUserId($this->getReference('user_0')->getId());
        $manager->persist($profile);

        // Céline
        $profile = new Profile();
        $profile->setImageName('baby-squid.jpg');
        $profile->setUserId($this->getReference('user_1')->getId());
        $manager->persist($profile);

        // Other admins
        for ($i = 0; $i < 2; $i++) {
            $profile = new Profile();
            $profile->setImageName(self::PICTURES[$i]);
            $profile->setUserId($this->getReference('admin_'. ($i+1))->getId());
            $manager->persist($profile);
        }

        // Other users
        for ($i = 2; $i < 11; $i++) {
            $profile = new Profile();
            $profile->setImageName(self::PICTURES[$i]);
            $profile->setUserId($this->getReference('user_'. $i)->getId());
            $manager->persist($profile);
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
        return [PlanetFixtures::class];
    }
}
