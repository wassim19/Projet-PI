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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function index(Request $request,$id,\Swift_Mailer $mailer): Response
    {
        $formations= new ParticipantF();
        $form=$this->createForm(ParticipantfType::class,$formations);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $message=(new \Swift_Message('nouveau msg'))
                ->setFrom(['fedi.benammar@esprit.tn'])
                ->setTo(['fedi.benammar@esprit.tn'])
                ->setBody($this->renderView('formation/afficheformationcandidat.html.twig',compact('formations')),'text/html');
            $mailer->send($message);
            $this->addFlash('message','the email has been sent');



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formations);
            $entityManager->flush();
            $participformation= new ParticipationF();
            $participformation->setIdFormation($id)
                ->setIdParticipant($formations->getId());
            $entityManager->persist($participformation);
            $entityManager->flush();

            //return $this->redirectToRoute("evenementsociete");
        }

        return $this->render('participantf/index.html.twig', [
            'form' => $form->createView(),
            'formations'=>$formations
        ]);

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
     * @Route("/delpf{id}", name="delpf")
     */
    public function deleteparticipantformation(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $participation = $entityManager->getRepository(ParticipationF::class)->findOneBy(['id_participant' => $id]);
        $entityManager->remove($participation);
        $entityManager->flush();

        return $this->redirectToRoute("afficheformationadmin");
    }

}
