<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\ParticipantE;
use App\Form\ParticipantEType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participantt", name="participant")
     */
    public function index(): Response
    {
        return $this->render('participant/index.html.twig', [
            'controller_name' => 'ParticipantController',
        ]);
    }

    /**
     * @Route("/participant", name="participant")
     */
    public function Addparticipant(Request $request)
    {
        $event= new ParticipantE();
        $form=$this->createForm(ParticipantEType::class,$event);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute("evenementsociete");
        }

        return $this->render('evenement_societe/participant.html.twig', [
            'form' => $form->createView(),
        ]);
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
