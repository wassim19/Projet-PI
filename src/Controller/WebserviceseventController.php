<?php

namespace App\Controller;

use App\Entity\Evenement;
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

class WebserviceseventController extends AbstractController
{
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
        $entityManager->persist($data);
        $entityManager->flush();
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
        $event->setTitle($data['title']);
        $event->setType($data['type']);
        $event->setDescription($data['description']);
        $event->setLocalitation($data['localitation']);
        $entityManager->persist($event);
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

        $entityManager->flush();
        return new Response("Succes");
    }
}
