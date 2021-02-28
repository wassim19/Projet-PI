<?php

namespace App\Controller;

use App\Entity\offre;
use App\Repository\offreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    /**
     * @Route("/offre", name="offre")
     */
    public function index(): Response
    {
        return $this->render('offre/index.html.twig', [
            'controller_name' => 'OffreController',
        ]);
    }
    /**
     * @param offreRepository $repository
     * @return Response
     * @Route("/affiche",name="offre")
     */
    public function listclassrrom(offreRepository $repository){
        $offre=$repository->findAll();
        return $this->render('offre/affiche.html.twig',array("offre"=>$offre));
    }
    /**
     *  @Route ("/add",name="addoffre")
     */
    function add(Request $request){
        $offre=new offre();
        $form=$this->createForm(offreType::class,$offre);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
            return $this->redirectToRoute('offre');
        }
        return $this->render("offre/index.html.twig",array('form'=>$form->createView()));

    }
}
