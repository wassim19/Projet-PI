<?php

namespace App\Controller;


use App\Entity\CategorieOffre;
use App\Entity\Offre;
use App\Form\CategorieOffreType;
use App\Form\OffreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieOfferController extends AbstractController
{
    /**
     * @Route("/afficheCategorieOffer", name="afficheCategorieOffer")
     */
    public function index(Request $request)
    {
        $rep=$this->getDoctrine()->getRepository(Offre::class);
        $offre=$rep->findAll();

        $rep=$this->getDoctrine()->getRepository(CategorieOffre::class);
        $categories=$rep->findAll();

        return $this->render('offre/affichetypeoffre.html.twig' ,[
            'offre' => $offre,'categories' => $categories,
        ]);
    }




    /**
     * @Route("/typeoffre", name="typeoffre")
     */
    public function addtypeoffre(Request $request)
    {
        $Categorieoffre= new CategorieOffre();

        $form=$this->createForm(CategorieOffreType::class,$Categorieoffre);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Categorieoffre);
            $entityManager->flush();
            return $this->redirectToRoute("socoffrebackafficheadmin");

        }

        return $this->render('categorie_offer/typeoffre.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
