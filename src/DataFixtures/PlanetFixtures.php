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
            'image_art'=> 'Gliese_imageArt2.jpg',
            'temperature' => '0 to 50°C',
            'population' => 'Gliesians',
        ],
        [
            'name' => 'Kepler 62 f',
            'type' => 'psychroplanet',
            'distance' => 1199.7,
            'image_tech' => 'Kepler62f_imageTech.svg',
            'image_art'=> 'Kepler_imageArt.jpg',
            'temperature' => '-50 to 0°C',
            'population' => 'Keplians',
        ],
        [
            'name' => 'Kapteyn b',
            'type' => 'psychroplanet',
            'distance' => 12.7,
            'image_tech' => 'Kapteyn b_imageTech.svg',
            'image_art'=> 'Kapteyn_imageArt.jpg',
            'temperature' => '-50 to 0°C',
            'population' => 'Zarglians',
        ],
        [
            'name' => 'KOI-3010.01',
            'type' => 'mesoplanet',
            'distance' => 1213.4,
            'image_tech' => 'KOI-3010.01_imageTech.svg',
            'image_art'=> 'KOI-3010.01_imageArt.jpg',
            'temperature' => '0 to 50°C',
            'population' => 'Zarglians',
        ],
        [
            'name' => 'Tau Ceti e',
            'type' => 'mesoplanet',
            'distance' => 11.9,
            'image_tech' => 'KOI-3010.01_imageTech.svg',
            'image_art'=> 'TauCeti_imageArt.jpg',
            'temperature' => '-50 to 50°C',
            'population' => 'Cetians',
        ],
        [
            'name' => 'HD 40307 g',
            'type' => 'psychroplanet',
            'distance' => 250.9,
            'image_tech' => 'HD40307_imageTech.svg',
            'image_art'=> 'HD40307_imageArt.jpg',
            'temperature' => '-50 to 0°C',
            'population' => '?',
        ],
        [
            'name' => 'TRAPPIST-1 g',
            'type' => 'psychroplanet',
            'distance' => 39.5,
            'image_tech' => 'HD40307_imageTech.svg',
            'image_art'=> 'Trappist_imageArt.jpg',
            'temperature' => '-50 to 0°C',
            'population' => 'Trappers',
        ],
        [
            'name' => 'Proxima Centauri b',
            'type' => 'mesoplanet',
            'distance' => 4.24,
            'image_tech' => 'Centaur_imageTech.svg',
            'image_art'=> 'Trappist_imageArt.jpg',
            'temperature' => '0 to 50°C',
            'population' => 'Centaurs',
        ],
        [
            'name' => 'Luyten b',
            'type' => 'mesoplanet',
            'distance' => 12.37,
            'image_tech' => 'Luyten_imageTech.svg',
            'image_art'=> 'Luyten_imageArt.jpg',
            'temperature' => '0 to 50°C',
            'population' => 'Centaurs',
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
            $planet->setImageArt($data['image_art']);
            $planet->setTemperature(($data['temperature']));
            $planet->setPopulation($data['population']);
            $manager->persist($planet);
            $this->addReference('planet_' . $i, $planet);
            $i++;
        }
        $manager->flush();
    }
}
