<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'welcome' => 'youpi',
        ]);
    }
     /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        $produit = new Produit();
        return $this->render('main/index.html.twig', [
            'welcome' => 'test',
        ]);
    }

    /**
     * @Route("/product", name="create_product")
     */
    public function createProduct(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $produit = new Produit();
        $produit->setLibelle('Keyboard');
        $produit->setPrix(1999);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($produit);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$produit->getId());
    }
    
}
