<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AdFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $types = [$this->getReference('exchange'), $this->getReference('sell'), $this->getReference('both'),];
        $creators = [];
        for ($i = 0; $i < 5; $i++) {
            $creators[] = $this->getReference('user'.$i);
        }
        $data = $this->getData();
        foreach ($data as $pokemon) {
            $ad = new Ad();
            $ad->setTitle($pokemon['title']);
            $ad->setName($pokemon['name']);
            $ad->setImage($pokemon['image']);
            $ad->setCreatedAt(new \DateTime());
            $ad->setUpdatedAt(new \DateTime());
            $ad->setDescription($pokemon['description']);
            $ad->setType($types[rand(0,2)]);
            $ad->setCreator($creators[rand(0,4)]);
            $ad->setPrice($pokemon['price']);
            $ad->setExchange($pokemon['exchange']);

            $manager->persist($ad);
        }

        $manager->flush();
    }

    public function getData()
    {
        return [
            [
                'title' => 'Noctali, 5mois, neon bleu',
                'description' => 'Je vend ma noctali femelle de 5 mois car j\'arrive pu à dormir 
                la nuit elle squatte la chambre et avec ses néons bleu c\'est chaud !',
                'image' => '3ffbf6e9a12f0b0e263d21c8a3c7bf21.jpeg',
                'price' => 35,
                'exchange' => 'N\'importe quoi qui fait pas de lumière et qui prend pas trop de place',
                'name' => 'Noctali',
            ],
            [
                'title' => 'Couple de pikachu',
                'description' => 'Je vend mon couple de pikachu car ils arrêtent pas la nuit ça m\'empêche de dormir 
                et comme avec mon compagnon on fait plus rien ça me frustre à mort !',
                'image' => '9660be3d6cb28d6d209a6ab8fb9b8879.jpeg',
                'price' => 69.69,
                'exchange' => NULL,
                'name' => 'Pikachu',
            ],
            [
                'title' => 'Tiplouf mâle',
                'description' => 'Je voulais une femelle et j\'ai eu un mâle,
                 alors je le vend ou je l\'échange contre une femelle !',
                'image' => 'ffe22600b42dbd4753faacc6d44c90ab.png',
                'price' => 37.99,
                'exchange' => 'Tiplouf femelle',
                'name' => 'Tiplouf',
            ],
            [
                'title' => 'Pétasse d\'évolie',
                'description' => 'C\'est une chaudasse qui aime aller chez les voisins, comme j\'arrive pas à la calmer
                 je la vend car j\'ai pas envie de me retrouver avec une portée sur les bras !',
                'image' => '61ab5688e525dad43e9f1a43892e00b5.jpeg',
                'price' => 26.99,
                'exchange' => NULL,
                'name' => 'Evolie',
            ],
        ];
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            TypeFixtures::class,
        );
    }
}
