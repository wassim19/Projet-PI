<?php

namespace App\Controller;

use App\Entity\RendezVo;
use App\Form\RendezVousType;
use App\Repository\RendezVousRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RendezVousController extends AbstractController
{
    /**
     * @Route("/rendez/vous", name="rendez_vous")
     */
    public function index(): Response
    {
        return $this->render('rendez_vous/index.html.twig', [
            'controller_name' => 'RendezVousController',
        ]);
    }

    /**
     * @param RendezVousRepository $repository
     * @return Response
     * @Route("/affiche",name="rendezvous")
     */
    public function listclassrrom(RendezVousRepository $repository){
        $rendezvous=$repository->findAll();
        return $this->render('rendez_vous/affiche.html.twig',array("rendezvous"=>$rendezvous));
    }
    /**
     *  @Route ("/add",name="addrendez-vous")
    */
    function add(Request $request){
        $rendezvous=new RendezVous();
        $form=$this->createForm(RendezVousType::class,$rendezvous);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($rendezvous);
            $em->flush();
            return $this->redirectToRoute('rendezvous');
        }
        return $this->render("rendez_vous/index.html.twig",array('form'=>$form->createView()));

    }
    /**
     * @Route ("/supp/{id}",name="d")
     */
    public function Delete( $id , RendezVousRepository $repository)
    {
        $rendezvous = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($rendezvous);
        $em->flush();
        return $this->redirectToRoute('rendezvous');
    }
    /**
     * @Route("rendezvous/Update/{id}",name="update")
     */
    function Update(RendezVousRepository $repository,$id,Request $request){
        $rendezvous=$repository->find($id);
        $form=$this->createForm(RendezVousType::class,$rendezvous);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('rendezvous');
        }
        return $this->render("rendez_vous/update.html.twig",array('f'=>$form->createView()));

    }
}
