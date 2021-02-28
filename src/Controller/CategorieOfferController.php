<?php

namespace App\Controller;


use App\Entity\CategorieOffre;
use App\Form\CategorieOffreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieOfferController extends AbstractController
{
    /**
     * @Route("/afficheCategorieOffer", name="categorie_offer")
     */
    public function index(Request $request)
    {
        $categorieoffre= new CategorieOffre();

        $form=$this->createForm(CategorieOffreType::class,$categorieoffre);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorieoffre);
            $entityManager->flush();

        }
        return $this->render('categorie_offer/addcategorie_offre.html.twig', [
            'form' => $form->createView(),
        ]);


    }
}
