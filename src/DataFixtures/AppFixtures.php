<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {// Création d'une vingtaine de livres ayant pour titre
        // for ($i = 0; $i < 20; $i++){
        //     $livre = new Book;
        //     $livre->setTitle('Livre ' .$i);
        //     $livre->setCoverText('Quartrième de couverture numéro : ' .$i);

        //     $manager->persist($livre);
        // }
        //Création des auteurs.
        $listAuthor = [];
        for ($i = 0; $i < 10; $i++){
            //Création de l'auteur lui-même
            $author = new Author();
            $author ->setFirstName("Prénom " .$i);
            $author ->setLastName("Nom " .$i);
            $manager->persist($author);
            //On sauvegarde l'auteur créé dans un tableau.
           $listAuthor[] = $author;
        }
        //Création des livres
        for ($i = 0; $i < 20; $i++){
            $book = new Book();
            $book->setTitle("Titre " .$i);
            $book->setCoverText("Quartrième de couverture numero :" .$i);

            //on lie le livre à un auteur pris au hasard dans le tableau des auteurs
            $book->setAuthor($listAuthor[array_rand($listAuthor)]);
            $manager->persist($book);
        }
        $manager->flush();
    }
}
