<?php

namespace App\DataFixtures;

use App\Entity\Produits;
use App\Entity\Categorie;
use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 20; $i++) {
            $categorie = new Categorie();
            $categorie->setNom("catégorie n°" . $i);
            $manager->persist($categorie);
            $produits = new Produits();
            $produits->setNom("produit n°" . $i);
            $produits->setPrix(rand(100, 1000));
            $produits->setCategorie($categorie);
            $manager->persist($produits);

        $manager->flush();
    }
}
}
