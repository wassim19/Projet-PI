<?php

namespace App\Controller;

use App\Entity\Correctiontest;
use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Entity\Test;
use App\Form\TestType;
use App\Repository\TestRepository;
use App\Repository\CorrectiontestRepository;
use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminrendezvousController extends AbstractController
{
    /**
     * @Route("/adminrendezvous", name="adminrendezvous")
     */
    public function index(): Response
    {
        return $this->render('adminrendezvous/index.html.twig', [
            'controller_name' => 'AdminrendezvousController',
        ]);
    }
    /**
     * @param RendezVousRepository $repository
     * @return Response
     * @Route("/rdvafficheradmin",name="rr")
     */
    public function listrendezvous(RendezVousRepository $repository){
        $rendezvous=$repository->findAll();
        return $this->render('adminrendezvous/afficherdvadmin.html.twig',array("rendezvous"=>$rendezvous));
    }

    /**
     * @param testRepository $repository
     * @return Response
     * @Route ("/testadmin",name="testadmin")
     */
    public function listtest(TestRepository $repository){
        $test=$repository->findAll();
        return $this->render('test/affichetest.html.twig',array("test"=>$test));
    }

    /**
     * @param CorrectiontestRepository $repository
     * @return Response
     * @Route ("/testpadmin",name="testpadmin")
     */
    public function listtestp(CorrectiontestRepository $repository){
        $test=$repository->findAll();
        return $this->render('correctiontest/index.html.twig',array("correction"=>$test));
    }

    /**
     * @param $id
     * @param TestRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/deletet {id}",name="deletet")
     */
    public function Deletetest( $id , TestRepository $repository)
    {
        $test = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($test);
        $em->flush();
        return $this->redirectToRoute('testadmin');
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/addtadmin",name="addtadmin")
     */
    function addt(Request $request){
        $test=new Test();
        $form=$this->createForm(TestType::class,$test);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();
            return $this->redirectToRoute('testadmin');
        }
        return $this->render("test/add.html.twig",array('form'=>$form->createView()));

    }

    /**
     * @param TestRepository $repository
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("Updatet {id}",name="updatet")
     */
    function Updatet(TestRepository $repository,$id,Request $request){
        $test=$repository->find($id);
        $form=$this->createForm(TestType::class,$test);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('testadmin');
        }
        return $this->render("test/add.html.twig",array('form'=>$form->createView()));

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
            return $this->redirectToRoute('rr');
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
        return $this->redirectToRoute('r');
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
            return $this->redirectToRoute('rr');
        }
        return $this->render("rendez_vous/update.html.twig",array('f'=>$form->createView()));

    }
    /**
     * @param RendezVousRepository $repository
     * @return Response
     * @Route ("/ordera",name="ordera")
     */
    public function orderbymail(RendezVousRepository $repository){
        $rendezvous=$repository->orderbymail();
        return $this->render('adminrendezvous/afficherdvadmin.html.twig',array("rendezvous"=>$rendezvous));
    }
    /**
     * @param Request $request
     * @return Response
     * @Route ("/searchrdva",name="searchrdva")
     */
    public function searchrdv(Request $request,RendezVousRepository $rep)
    {
        $repository = $this->getDoctrine()->getRepository(RendezVous::class);
        $requestString=$request->get('searchValue');
        $rdv = $repository->findrdvBydate($requestString);
        return $this->render('rendez_vous/rendezvousajax.html.twig' ,[
            "rendezvous"=>$rdv
        ]);
    }


}
