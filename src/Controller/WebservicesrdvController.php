<?php

namespace App\Controller;

use App\Entity\RendezVous;
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
    public function updateEvent(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $content = $request->getContent();
        $event = $entityManager->getRepository(RendezVous::class)->find($id);
        $data = json_decode($content, true);
        $event->setDate(new DateTime($data['date']));
        $event->setMeet($data['meet']);
        $event->setMail($data['mail']);
        $event->setDescription($data['description']);
        $entityManager->persist($event);
        $entityManager->flush();
        //$nom = $data->get('title');
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
}
