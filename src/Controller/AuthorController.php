<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{ 
    #[Route('/authors', name: 'app_author',methods:['GET'])]
    public function getAllAuthor(SerializerInterface $serializer,AuthorRepository $authorRepository): JsonResponse
    {
        $authorList = $authorRepository->findAll();
        $jsonAuthorList = $serializer->serialize($authorList,'json',['groups'=>'getAuthors']);
        return new JsonResponse($jsonAuthorList, Response::HTTP_OK,['accept'=>'json'],true);
            
    }

     #[Route('/api/author/{id}',name:"detailAuthor",methods:['GET'])]
    public function getDetailBook(Author $author,SerializerInterface $serializer):JsonResponse{

        $jsonAuthor = $serializer->serialize($author,'json',['groups'=>'getAuthors']);
        return new JsonResponse($jsonAuthor, Response::HTTP_OK,['accept'=>'json'],true);
    }

















    // #[Route('/', name: 'get_authors', methods: ['GET'])]
    // public function getAuthors(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $query = $entityManager->createQuery('
    //         SELECT author, books
    //         FROM App\Entity\Author author
    //         LEFT JOIN author.books books
    //     ');

    //     $authors = $query->getResult();

    //     // Formattez les résultats en tableau pour l'affichage
    //     $formattedAuthors = [];
    //     foreach ($authors as $author) {
    //         $formattedBooks = [];
    //         foreach ($author->getBooks() as $book) {
    //             $formattedBooks[] = [
    //                 'id' => $book->getId(),
    //                 'title' => $book->getTitle(),
    //                 'cover_text' => $book->getCoverText(),
    //             ];
    //         }

    //         $formattedAuthors[] = [
    //             'id' => $author->getId(),
    //             'firstName' => $author->getFirstName(),
    //             'lastName' => $author->getLastName(),
    //             'books' => $formattedBooks,
    //         ];
    //     }

    //     return new JsonResponse($formattedAuthors);
    // }
}