<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Offre;
use App\Form\EventType;
use App\Form\OffreType;
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
     * @Route("/addoffre", name="addoffre")
     */
    public function Addoffre(Request $request)
    {
        $offre= new Offre();

        $form=$this->createForm(OffreType::class,$offre);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();

        }

        return $this->render('offre/addoffre.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deleteoffre{id}", name="deleteoffre")
     */
    public function deleteoffre(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $offre = $entityManager->getRepository(Offre::class)->find($id);
        $entityManager->remove($offre);
        $entityManager->flush();

        return $this->redirectToRoute("adminoffrebackaffiche");
    }


    /**
     * @Route("/adminoffrebackaffiche", name="adminoffrebackaffiche")
     */
    public function AdmiNoffre(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Offre::class);
        $offre=$rep->findAll();


        return $this->render('offre/offreadmine.html.twig', [
            'offre' => $offre,
        ]);

    }




    /**
     * @Route("/socdeletoffre{id}", name="socdeoffre")
     */
    public function deleteoffreback (int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $offre= $entityManager->getRepository(Offre::class)->find($id);
        $entityManager->remove($offre);
        $entityManager->flush();

        return $this->redirectToRoute("manager");
    }



    /**
     * @Route("/addoffreeback", name="addoffree")
     */
    public function Addoffree(Request $request)
    {
        $offre= new offre();
        $form=$this->createForm(OffreType::class,$offre);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file = $request->files->get('offre')['my_picture'];
            $upload_directory = $this->getParameter('upload_directory');
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $upload_directory,
                $filename
            );
            $offre->setPicture($filename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();
            return $this->redirectToRoute("manager");
        }

        return $this->render('evenement_societe/addevent.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/updateevent{id}", name="updateevent")
     */
    public function UpdateEvent(Request $request,$id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event = $entityManager->getRepository(Evenement::class)->find($id);

        $form=$this->createForm(EventType::class,$event);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $entityManager->flush();
            return $this->redirectToRoute("offre");
        }

        return $this->render('offre/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
