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
    /**
     * @Route("/participants{id}", name="participants")
     */
    public function gestionparticipant($id): Response
    {



        $rep = $this->getDoctrine()->getRepository(ParticipationF::class);
        $participation = $rep->findBy(array('id_formation' => $id));
        dump($participation);





        return $this->render('participantf/paticipantformation.html.twig', [
            'participation'=>$participation
        ]);
    }
    /**
     * @Route("/deleteparticipantf{id}", name="deleteparticipantf")
     */
    public function deleteparticipant(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $participation = $entityManager->getRepository(ParticipationF::class)->findOneBy(['id_participant' => $id]);

        $entityManager->remove($participation);
        $entityManager->flush();

        return $this->redirectToRoute("participants");
    }
}
