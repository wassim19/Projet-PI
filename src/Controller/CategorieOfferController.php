<?php

namespace App\Controller;


use App\Entity\CategorieOffre;
use App\Entity\Offre;
use App\Form\CategorieOffreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieOfferController extends AbstractController
{
    /**
     * @Route("/afficheCategorieOffer{type}", name="afficheCategorieOffer")
     */
    public function index(Request $request)
    {
        $rep=$this->getDoctrine()->getRepository(Offre::class);
        $offre=$rep->findAll();
        return $this->render('offre/affichetypeoffre.html.twig' ,[
            'offre' => $offre,
        ]);
    }


    /**
     * @Route("/lescategories", name="lescategories")
     */
    public function categories(Request $request)
    {

        $rep=$this->getDoctrine()->getRepository(CategorieOffre::class);
        $categories=$rep->findAll();


        return $this->render('categorie_offer/addcategorie_offre.html.twig' ,[
        'categories' => $categories,
        ]);


    }
}
