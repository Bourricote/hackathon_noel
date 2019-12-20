<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MissionFixtures extends Fixture implements DependentFixtureInterface
{

    const MISSIONS = [
        [
            'title' => 'Rescue civilians after earthquake',
            'description' => 'A massive earthquake destroyed the capital city, we need to rescue a maximum of people',
            'transport' => 'rocket',
            'departure_date' => '2239-11-13',
            'return_date' => '2239-12-15',
            'number_person' => 12,
            'mission_type' => 'rescue',
            'level' => 'beginner',
            'planet' => 'planet_0',
        ],
        [
            'title' => 'Fight a revolution',
            'description' => 'An extremist group has taken the biggest city, we need to fight them and establish order',
            'transport' => 'spaceship',
            'departure_date' => '2239-12-13',
            'return_date' => '2240-01-15',
            'number_person' => 80,
            'mission_type' => 'fight',
            'level' => 'advanced',
            'planet' => 'planet_1',
        ],
        [
            'title' => 'Infiltrate an anarchist group',
            'description' => 'We have to infiltrate an anarchist group to understand what they want exactly on this planet',
            'transport' => 'spaceship',
            'departure_date' => '2240-04-05',
            'return_date' => '2240-09-15',
            'number_person' => 10,
            'mission_type' => 'fight',
            'level' => 'expert',
            'planet' => 'planet_2',
        ],
        [
            'title' => 'Repopulate the planet',
            'description' => 'After an epidemic, this planet needs help to repopulate, any kind of genes accepted',
            'transport' => 'magic bus',
            'departure_date' => '2240-01-05',
            'return_date' => '2245-09-15',
            'number_person' => 100,
            'mission_type' => 'rescue',
            'level' => 'beginner',
            'planet' => 'planet_3',
        ],

    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::MISSIONS as $data) {
            $mission = new Mission();
            $mission->setPlanet($this->getReference($data['planet']));
            $mission->setTitle($data['title']);
            $mission->setDescription($data['description']);
            $mission->setTransport($data['transport']);
            $mission->setDepartureDate($data['departure_date']);
            $mission->setReturnDate($data['return_date']);
            $mission->setNumberPerson(($data['number_person']));
            $mission->setMissionType($data['mission_type']);
            $mission->setLevel($data['level']);
            $mission->addUser($this->getReference('user_0'));
            $mission->setCreator($this->getReference('user_2'));
            $manager->persist($mission);
            $this->addReference('mission_' . $i, $mission);
            $i++;
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
