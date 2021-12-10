<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Panier;
use App\Entity\Produits;
use App\Entity\Categorie;
use App\Repository\UsersRepository;
use App\Repository\ProduitsRepository;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{


    /**
     * @Route("/Categorie" , name="Categorie")
     */
    public function Categorie(Request $request)
    {

        $categorie = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findAll();
        foreach ($categorie as $key => $categorie) {
            $data[$key]['nom'] = $categorie->getNom();
        }
        return new JsonResponse($data);
    }


    /**
     * @Route("/Produits" , name="Produits")
     */
    public function Produits(Request $request)
    {
        $produits = $this->getDoctrine()
            ->getRepository(Produits::class)
            ->findAll();
        foreach ($produits  as $key => $produits) {
            $data[$key]['id'] = $produits->getId();
            $data[$key]['nom'] = $produits->getNom();
            $data[$key]['prix'] = $produits->getPrix();
            $data[$key]['categorie'] = $produits->getCategorie()->getNom();
        }
        return new JsonResponse($data);
    }


    /**
     * @Route("/AddProduitsPanier/{prod}/{us}" , name="AddProduitsPanier")
     */
    
    public function AddProduitsPanier(ProduitsRepository $produit,UsersRepository $user ,ManagerRegistry $doctrine ,int $prod,int $us)
    {
      
       
        $panier = new Panier();
        $entityManager = $doctrine->getManager();
        $panier->setUsers($user->find($us));
        $panier->setProduits($produit->find($prod));
        $panier->setStatus('Acheté');
        $entityManager->persist($panier);
        $entityManager->flush();
        return new Response('Good');
       
    }


    /**
     * @Route("/Panier" , name="Panier")
     */
    public function Panier()
    {
        $panier = $this->getDoctrine()
            ->getRepository(Panier::class)
            ->findAll();
        foreach ($panier  as $key => $panier) {
           $data[$key]['status'] = $panier->getStatus();
           $data[$key]['Nomproduits'] = $panier->getProduits()->getNom();
           $data[$key]['Prixproduits'] = $panier->getProduits()->getPrix();
           $data[$key]['Nomuser'] = $panier->getUsers()->getNom();
           $data[$key]['Date'] = $panier->getCreatedAt();
           
        }
        return new JsonResponse($data);
    }
    

    /**
     * @Route("/PanierUser/{id}" , name="PanierUser")
     */
    public function PanierUser($id)
    {
        $panier = $this->getDoctrine()
            ->getRepository(Panier::class)
            ->findAll();
        foreach ($panier  as $key => $panier) {
          // $data[$key]['status'] = $panier->getStatus();
          // $data[$key]['Nomproduits'] = $panier->getProduits()->getNom();
          // $data[$key]['Prixproduits'] = $panier->getProduits()->getPrix();
           $data[$key]['Nomuser'] = $panier->getUsers()->getNom();
          // $data[$key]['Date'] = $panier->getCreatedAt();
           
        }
        return new JsonResponse($data);
    }
}
