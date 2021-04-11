<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\NotifEvent;
use App\Entity\ParticipantE;
use App\Entity\ParticipationE;
use App\Form\ParticipantEType;
use App\Repository\CategorieOffreRepository;
use App\Repository\EvenementRepository;
use App\Repository\OffreRepository;
use App\Repository\ParticipantERepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class AdminController extends AbstractController
{
    /**
     * @Route("/stat" ,name="stat")
     */
    public function stat(EvenementRepository $evenementRepository,ParticipantERepository $participantERepository){
        $events = $evenementRepository->nbr();
        $age = $participantERepository->age();
        dump($age);
        

        return $this->render('admin/index.html.twig',[
            "events" => $events,"age"=>$age
        ]);

    }


    /**
     * @Route("/gestiondesparticipantsoc{id}", name="gestiondesparticipantsoc")
     */
    public function gestionparticipant($id): Response
    {

        $rep = $this->getDoctrine()->getRepository(ParticipationE::class);
        $participation = $rep->findBy(array('id_evenement' => $id));


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
        $participation = $entityManager->getRepository(ParticipationE::class)->findOneBy(['id_participant' => $id]);

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
        $participation = $entityManager->getRepository(ParticipationE::class)->findOneBy(['id_participant' => $id]);
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

        $title = $event->getTitle();

        $notif = new NotifEvent();
        $notif->setNotif('Event '.$title.' Deleted');
        $entityManager->persist($notif);


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

    /**
     * @Route("/sortbytitleascadmin", name="sortbytitleascadmin")
     */
    public function sortByTitleASC(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->sortByTitleASC();


        return $this->render('evenement_societe/adminevent.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/sortbytitledescadmin", name="sortbytitledescadmin")
     */
    public function sortByTitleDESC(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->sortByTitleDESC();
        return $this->render('evenement_societe/adminevent.html.twig', [
            'evenement' => $evenement,
        ]);
    }



    /**
     * @Route("/notification", name="notification")
     */
    public function notification(): Response
    {

        $rep=$this->getDoctrine()->getRepository(NotifEvent::class);
        $notif=$rep->findAll();


        return $this->render('admin/notifadmin.html.twig', [
                'notif' => $notif,
            ]
        );

    }



    /**
     * @Route("/deletenotification{id}", name="deletenotification")
     */
    public function deletenotification(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $notif = $entityManager->getRepository(NotifEvent::class)->find($id);


        $entityManager->remove($notif);
        $entityManager->flush();

        return $this->redirectToRoute("notification");

    }

}
