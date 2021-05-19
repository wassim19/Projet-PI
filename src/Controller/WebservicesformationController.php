<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class WebservicesformationController extends AbstractController
{


    /**
     * @Route("/webserviceseventaddformation", name="webserviceseventaddformation")
     */
    public function addformation(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $content = $request->getContent();
        $data = $serializer->deserialize($content,Formation::class,'json');
        $entityManager->persist($data);
        $entityManager->flush();
        return new Response("Succes");
    }


    /**
     * @Route("/webservicesafficheformation", name="webservicesafficheformation")
     */
    public function afficheformation(FormationRepository $formationRepository,SerializerInterface $serializer)
    {
        $formation=$formationRepository->findAll();
        $response = new Response();
        $jsonContent = $serializer->serialize($formation,'json',['groups' =>'formation']);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }

    /**
     * @Route("/webserviceseventupdateformation/{id}", name="webserviceseventupdateformation")
     */
    public function updateformation(Request $request,SerializerInterface $serializer ,EntityManagerInterface $entityManager,$id)
    {
        $content = $request->getContent();
        $formation = $entityManager->getRepository(Formation::class)->find($id);
        $data = json_decode($content, true);
        $formation->setDescription($data['description']);
        $formation->setTitle($data['title']);
        $formation->setLocalitation($data['localitation']);
        $formation->setIdSoc($data['id_soc']);
        $entityManager->persist($formation);
        $entityManager->flush();

        return new Response("Succes");
    }

    /**
     * @Route("/webserviceseventdeleteformation/{id}", name="webserviceseventdeleteformation")
     */
    public function deleteEvent(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $formation = $entityManager->getRepository(Formation::class)->find($id);
        $entityManager->remove($formation);

        $entityManager->flush();
        return new Response("Succes");
    }


}
