<?php

namespace App\Controller;

use App\Entity\ParticipantE;
use App\Form\ParticipantEType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participant_e", name="participant_e")
     */
    public function index(Request $request): Response
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

        return $this->render('participant_e/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
