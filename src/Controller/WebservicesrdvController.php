<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Entity\Surfer;
use App\Repository\RendezVousRepository;
use App\Repository\SurferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use DateTime;

class WebservicesrdvController extends AbstractController
{
    /**
     * @Route("/webservicesrdvs", name="webservicesrdvs")
     */
    public function getrdvs(RendezVousRepository $evenementRepository,SerializerInterface $serializer)
    {
        $event=$evenementRepository->findAll();
        $response = new Response();
        $jsonContent = $serializer->serialize($event,'json',['groups' =>'rdv']);
        $response->headers->set('Content-Type', 'application/json');
        //$mail=$request->query->get("mail");
        //$event1->setMail($this->getDoctrine()->getManager()->getRepository(Surfer::class)->find($mail));
        $response->setContent($jsonContent);
        return $response;
    }
    /**
     * @Route("/webservicescombo", name="webservicescombo")
     */
    public function getrdv(SurferRepository $evenementRepository,SerializerInterface $serializer)
    {
        $event=$evenementRepository->findAll();
        $response = new Response();
        $jsonContent = $serializer->serialize($event,'json',['groups' =>'surfer']);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }

    /**
     * @Route("/webservicesaddrdv", name="webservicesaddrdv")
     */
    public function addrdv(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $content = $request->getContent();
        $data = $serializer->deserialize($content,RendezVous::class,'json');
        $entityManager->persist($data);
        $entityManager->flush();
        return new Response("Succes");
    }

    /**
     * @Route("/webservicesupdaterdv/{id}", name="webservicesupdaterdv")
    */
    public function updaterdv(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $content = $request->getContent();
        $event = $entityManager->getRepository(RendezVous::class)->find($id);
        $data = json_decode($content, true);
        $event->setDate(new DateTime($data['date']));
        $event->setMeet($data['meet']);

        $event->setDescription($data['description']);
        $entityManager->persist($event);
        $entityManager->flush();
        return new Response("Succes");
    }

    /**
     * @Route("/webservicesdeleterdv/{id}", name="webservicesdeleterdv")
     */
    public function deleterdv(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $event = $entityManager->getRepository(RendezVous::class)->find($id);
        $entityManager->remove($event);

        $entityManager->flush();
        return new Response("Succes");
    }
    /**
     * @Route("/statrdv", name="statrdv")
     */
    public function stat(SerializerInterface $serializer)
    {
        $sql = "SELECT WEEK(date) AS Mois,COUNT(id) AS NB from rendez_vous group by WEEK(date)";
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $jsonContent = $serializer->serialize($stmt,'json');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;

    }
}
