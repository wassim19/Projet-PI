<?php

namespace App\Controller;

use App\Entity\Correctiontest;
use App\Form\CorrectiontestType;
use App\Repository\CorrectiontestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class CorrectiontestController extends AbstractController
{
    /**
     * @Route("/correctiontest", name="correctiontest")
     */
    public function index(): Response
    {
        return $this->render('correctiontest/index.html.twig', [
            'controller_name' => 'CorrectiontestController',
        ]);
    }

    /**
     * @param CorrectiontestRepository $repository
     * @param $id
     * @return Response
     * @Route ("/nn",name="nn")
     */
    public function listnote(CorrectiontestRepository $repository){
        $correction=$repository->findAll();

        return $this->render('correctiontest/index.html.twig',array("correction"=>$correction));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/ajout",name="aa")
     */
    function add(Request $request){
        $correction=new Correctiontest();
        $form=$this->createForm(CorrectiontestType::class,$correction);
        $form->add('Envoyer',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($correction);
            $em->flush();
            return $this->redirectToRoute('note',array("id"=>$correction->getId()));
        }
        return $this->render("correctiontest/reponse.html.twig",array('form'=>$form->createView(),"correction"=>$correction));

    }
    /**
     * @Route("/note{id}",name="note")
     */
    public function note($id){
        $repo=$this->getDoctrine()->getRepository(Correctiontest::class);
        $correction=$repo->find($id);
        return $this->render('correctiontest/note.html.twig',['correction' =>$correction]);
    }
}
