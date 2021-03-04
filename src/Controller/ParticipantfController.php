<?php

namespace App\Controller;

use App\Entity\ParticipantF;
use App\Entity\ParticipationF;
use App\Form\ParticipantfType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantfController extends AbstractController
{
    /**
     * @Route("/afficheformation", name="formation")
     */
    public function participant(): Response
    {
        return $this->render('participantf/index.html.twig', [
            'controller_name' => 'ParticipantfController',
        ]);
    }

    /**
     * @Route("/participantf{id}", name="participantf")
     */
    public function index(Request $request,$id): Response
    {
        $formation= new ParticipantF();
        $form=$this->createForm(ParticipantfType::class, $formation);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
            $participf = new ParticipationF();
            $participf ->setIdFormation($id)
                ->setIdParticipant($formation->getId());
            $em->persist($participf);
            $em->flush();
            return $this->redirectToRoute("afficheformationcandidat");
        }

        return $this->render('participantf/index.html.twig', ['form' => $form->createView(),]);

    }
}
