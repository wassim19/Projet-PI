<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Repository\RendezVousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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