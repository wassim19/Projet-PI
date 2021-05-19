<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Evenement;
use App\Entity\NotifEvent;
use App\Entity\ParticipantE;
use App\Entity\ParticipationE;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Form\FormTypeInterface;
use DateTime;

class WebserviceseventController extends AbstractController
{
    /**
     * @Route("/webserviceseventeventdetails/{id}", name="webserviceseventeventdetails")
     */
    public function getEventDetails(EvenementRepository $evenementRepository,SerializerInterface $serializer,$id,EntityManagerInterface $entityManager)
    {
        $event = $entityManager->getRepository(Evenement::class)->find($id);
        $response = new Response();
        $jsonContent = $serializer->serialize($event,'json',['groups' =>'event']);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }

    /**
     * @Route("/webserviceseventevents", name="webserviceseventevents")
     */
    public function getEvents(EvenementRepository $evenementRepository,SerializerInterface $serializer)
    {
        $event=$evenementRepository->findAll();
        $response = new Response();
        $jsonContent = $serializer->serialize($event,'json',['groups' =>'event']);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }

    /**
     * @Route("/webserviceseventaddevent", name="webserviceseventaddevent")
     */
    public function addEvent(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $content = $request->getContent();
        $data = $serializer->deserialize($content,Evenement::class,'json');
        $notif = new NotifEvent();
        $notif->setNotif('New Event Is Here');
        $entityManager->persist($notif);
        $entityManager->persist($data);
        $entityManager->flush();
        $sql ="INSERT INTO `booking`(`id_event`, `A1`, `A2`, `A3`, `A4`, `A5`, `A6`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `prix`) VALUES((SELECT max(id) FROM `evenement`),0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,15)";
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        return new Response("Succes");
    }

    /**
     * @Route("/webserviceseventupdateevent/{id}", name="webserviceseventupdateevent")
     */
    public function updateEvent(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $content = $request->getContent();
        $event = $entityManager->getRepository(Evenement::class)->find($id);
        $data = json_decode($content, true);
        //$event->setDateAt($data['dateAt']);
        $event->setDateAt(new DateTime($data['dateAt']));
        $event->setTitle($data['title']);
        $event->setType($data['type']);
        $event->setDescription($data['description']);
        $event->setLocalitation($data['localitation']);
        $entityManager->persist($event);
        $notif = new NotifEvent();
        $title = $event->getTitle();
        $notif->setNotif('Event '.$title.' Updated');
        $entityManager->persist($notif);
        $entityManager->flush();
        //$nom = $data->get('title');
        return new Response("Succes");
    }

    /**
     * @Route("/webserviceseventdeleteevent/{id}", name="webserviceseventdeleteevent")
     */
    public function deleteEvent(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $event = $entityManager->getRepository(Evenement::class)->find($id);
        $entityManager->remove($event);
        $title = $event->getTitle();

        $notif = new NotifEvent();
        $notif->setNotif('Event '.$title.' Deleted');
        $entityManager->persist($notif);

        $entityManager->flush();
        return new Response("Succes");
    }

    /**
     * @Route("/webserviceseventviewed/{id}", name="webserviceseventviewed")
     */
    public function viewedEvent(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $content = $request->getContent();
        $event = $entityManager->getRepository(Evenement::class)->find($id);
        $data = json_decode($content, true);
        $event->setViewed($event->getViewed()+1);
        $entityManager->persist($event);
        $entityManager->flush();
        //$nom = $data->get('title');
        return new Response("Succes");
    }

    /**
     * @Route("/getparticipant/{id}", name="getparticipant")
     */
    public function getparticipant(SerializerInterface $serializer,$id)
    {
        $sql = "SELECT * FROM `participant_e` WHERE `id` IN (SELECT `id_participant` FROM `participation_e` WHERE `id_evenement` =" . $id . ")";
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $jsonContent = $serializer->serialize($stmt,'json');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;

    }

    /**
     * @Route("/webserviceseventdeleteparticipant/{id}/{id1}/{seat}", name="webserviceseventdeleteparticipant")
     */
    public function deleteParticipant(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id,$id1,$seat)
    {
        $par = $entityManager->getRepository(ParticipantE::class)->find($id);
        $sql1 = "UPDATE booking SET " .$seat. "=". 0 ." WHERE id_event=" . $id1. " ";
        $sql = "DELETE FROM `participation_e` WHERE `id_evenement` = " . $id1 . " AND `id_participant` = " . $id . " " ;

        $stmt1 = $this->getDoctrine()->getManager()->getConnection()->prepare($sql1);
        $stmt1->execute();
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        
        $entityManager->remove($par);

        $entityManager->flush();
        return new Response($id1);
    }


    /**
     * @Route("/booking/{id}", name="booking")
     */
    public function booking(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $sql = "SELECT * FROM Booking where id_event = " . $id . " ";
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $jsonContent = $serializer->serialize($stmt,'json');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }

    /**
     * @Route("/addpar/{id}", name="addpar")
     */
    public function addpar(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {



        $content = $request->getContent();
        $data1 = json_decode($content, true);
        $seat = $data1['seat'];
        $sql = "UPDATE booking SET " .$seat. "=". 1 ." WHERE id_event=" . $id. " ";


        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $serializer->deserialize($content,ParticipantE::class,'json');
        $entityManager->persist($data);
        $entityManager->flush();

        $participation= new ParticipationE();
        $participation->setIdEvenement($id)
            ->setIdParticipant($data->getId());
        $entityManager->persist($participation);
        $entityManager->flush();



        return new Response($seat);

    }

    /**
     * @Route("/webserviceseventeventssearch/{title}", name="webserviceseventeventssearch")
     */
    public function Search(EvenementRepository $evenementRepository,SerializerInterface $serializer,$title)
    {
        $rep = $this->getDoctrine()->getRepository(Evenement::class);
        $event = $rep->findBy(array('title' => $title));
        $response = new Response();
        $jsonContent = $serializer->serialize($event,'json',['groups' =>'event']);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }


    /**
     * @Route("/statage", name="statage")
     */
    public function statage(SerializerInterface $serializer)
    {
        $sql = "SELECT age , COUNT(participant_e.age) AS nbage FROM `participant_e` GROUP BY(age)";
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $jsonContent = $serializer->serialize($stmt,'json');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;

    }

    /**
     * @Route("/stat", name="stat")
     */
    public function stat(SerializerInterface $serializer)
    {
        $sql = "SELECT MONTH(date_at) AS Mois,COUNT(id) AS NB from evenement group by MONTH(date_at)";
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $jsonContent = $serializer->serialize($stmt,'json');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;

    }

    /**
     * @Route("/notificationuser1", name="notificationuser1")
     */
    public function notificationuser(SerializerInterface $serializer)
    {

        $rep=$this->getDoctrine()->getRepository(NotifEvent::class);
        $notif=$rep->findAll();

        $jsonContent = $serializer->serialize($notif,'json');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;




    }





}
