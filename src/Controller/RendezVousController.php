<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\RendezVousRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RendezVousController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('rendez_vous/index.html.twig', [
            'controller_name' => 'RendezVousController',
        ]);
    }

    /**
     * @param RendezVousRepository $repository
     * @return Response
     * @Route("/rdvafficher",name="rendezvous")
     */
    public function listrendezvous(RendezVousRepository $repository){
        $rendezvous=$repository->findAll();
        return $this->render('rendez_vous/affiche.html.twig',array("rendezvous"=>$rendezvous));
    }

    /**
     * @Route ("/addrdv",name="addrendez-vous")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    function add(Request $request){
        $rendezvous=new RendezVous();
        $form=$this->createForm(RendezVousType::class,$rendezvous);
        $form->add('Add',SubmitType::class);
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
     * @Route ("/supprdv {id}",name="d")
     * @param $id
     * @param RendezVousRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
     * @Route("Updaterdv {id}",name="update")
     * @param RendezVousRepository $repository
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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

    /**
     * @Route ("/recherche",name="recherche")
     */
    public function recherche(RendezVousRepository $repository,Request $request){
    $data=$request->get('search');
    $rendezvous=$repository->findBy(['mail'=>$data]);
        return $this->render('rendez_vous/affiche.html.twig',array("rendezvous"=>$rendezvous));

    }

    /**
     * @param RendezVousRepository $repository
     * @return Response
     * @Route ("/order",name="order")
     */
    public function orderbymail(RendezVousRepository $repository){
        $rendezvous=$repository->orderbymail();
        return $this->render('rendez_vous/affiche.html.twig',array("rendezvous"=>$rendezvous));
    }
}
