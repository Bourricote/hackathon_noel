<?php

namespace App\DataFixtures;

use App\Entity\Planet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlanetFixtures extends Fixture
{

    const PLANETS = [
        [
            'name' => 'Gliese 180 b',
            'type' => 'mesoplanet',
            'distance' => 39.5,
            'image_tech' => 'Gliese180b_imageTech.svg',
            'temperature' => '0 to 50°C',
            'population' => 'Gliesians',
        ],
        [
            'name' => 'Kepler 62 f',
            'type' => 'psychroplanet',
            'distance' => 1199.7,
            'image_tech' => 'Kepler62f_imageTech.svg',
            'temperature' => '-50 to 0°C',
            'population' => 'Keplians',
        ],
        [
            'name' => 'Kapteyn b',
            'type' => 'psychroplanet',
            'distance' => 12.7,
            'image_tech' => 'Kapteyn b_imageTech.svg',
            'temperature' => '-50 to 0°C',
            'population' => 'Zarglians',
        ],
        [
            'name' => 'KOI-3010.01',
            'type' => 'mesoplanet',
            'distance' => 1213.4,
            'image_tech' => 'KOI-3010.01_imageTech.svg',
            'temperature' => '0 to 50°C',
            'population' => 'Zarglians',
        ],

    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::PLANETS as $data) {
            $planet = new Planet();
            $planet->setName($data['name']);
            $planet->setType($data['type']);
            $planet->setDistance($data['distance']);
            $planet->setImageTech($data['image_tech']);
            $planet->setTemperature(($data['temperature']));
            $planet->setPopulation($data['population']);
            $manager->persist($planet);
            $this->addReference('planet_' . $i, $planet);
            $i++;
        }
        $manager->flush();
    }
}
