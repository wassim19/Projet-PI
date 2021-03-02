<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\ParticipantE;
use App\Entity\ParticipationE;
use App\Form\ParticipantEType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/gestiondesparticipantsoc{id}", name="gestiondesparticipantsoc")
     */
    public function gestionparticipant($id): Response
    {

        $rep = $this->getDoctrine()->getRepository(ParticipationE::class);
        $participation = $rep->findBy(array('id_evenement' => $id));
        dump($participation);



        return $this->render('evenement_societe/gestionparticipantsoc.html.twig', [
            'participation'=>$participation
        ]);
    }

    /**
     * @Route("/deleteparticipantsoc{id}", name="deleteparticipantsoc")
     */
    public function deleteparticipansoct(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $participation = $entityManager->getRepository(ParticipationE::class)->find($id);
        $entityManager->remove($participation);
        $entityManager->flush();

        return $this->redirectToRoute("manager");
    }

    /**
     * @Route("/gestiondesparticipant{id}", name="gestiondesparticipant")
     */
    public function gestionpar($id): Response
    {


        $rep = $this->getDoctrine()->getRepository(ParticipationE::class);
        $participation = $rep->findBy(array('id_evenement' => $id));




        return $this->render('admin/gestiondesparticipant.html.twig', [
            'participation'=>$participation
        ]);
    }

    /**
     * @Route("/deleteparticipant{id}", name="deleteparticipant")
     */
    public function deleteparticipant(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $participation = $entityManager->getRepository(ParticipationE::class)->find($id);
        $entityManager->remove($participation);
        $entityManager->flush();

        return $this->redirectToRoute("adminmanege");
    }

    /**
     * @Route("/adminevenement{id}", name="adminevenement")
     */
    public function deleteevenementt(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $event = $entityManager->getRepository(Evenement::class)->find($id);
        $entityManager->remove($event);
        $entityManager->flush();

        return $this->redirectToRoute("adminmanege");
    }



    /**
     * @Route("/adminmanege", name="adminmanege")
     */
    public function AdminEvent(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->findAll();


        return $this->render('evenement_societe/adminevent.html.twig', [
            'evenement' => $evenement,
        ]);

    }
}
