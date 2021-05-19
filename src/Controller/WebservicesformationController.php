<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\ParticipantF;
use App\Entity\ParticipationF;
use App\Repository\FormationRepository;
use App\Repository\ParticipantfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class WebservicesformationController extends AbstractController
{
    /**
     * @Route("/webservicesafficheformation", name="webservicesafficheformation")
     */
    public function afficheformation(FormationRepository $formationRepository ,SerializerInterface $serializer)
    {
        $formations=$formationRepository->findAll();
        $response = new Response();
        $jsonContent = $serializer->serialize($formations,'json',['groups' =>'formation']);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }


    /**
     * @Route("/webserviceseventaddformation", name="webserviceseventaddformation")
     */
    public function addFormation(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $content = $request->getContent();
        $data = $serializer->deserialize($content,Formation::class,'json');
        $entityManager->persist($data);
        $entityManager->flush();

        return new Response("Succes");
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
        $formation->setLocalisation($data['localisation']);
        $entityManager->persist($formation);
        $entityManager->flush();

        return new Response("Succes");
    }

    /**
     * @Route("/webserviceseventdeleteformation/{id}", name="webserviceseventdeleteformation")
     */
    public function deleteformation(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $formation = $entityManager->getRepository(Formation::class)->find($id);
        $entityManager->remove($formation);

        $entityManager->flush();
        return new Response("Succes");
    }
    // **************************participant*****************

    /**
     * @Route("/webserviceseventaddparticipantf/{id}", name="webserviceseventaddparticipantf")
     */
    public function addParticipantf($id ,Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $content = $request->getContent();
        $data = $serializer->deserialize($content,ParticipantF::class,'json');
        $entityManager->persist($data);
        $entityManager->flush();
        $participf = new ParticipationF();
        $participf ->setIdFormation($id)
            ->setIdParticipant($data->getId());
        $entityManager->persist($participf);
        $entityManager->flush();

        return new Response("Succes");
    }

    /**
     * @Route("/webserviceseventdeleteparticipantf/{id}", name="webserviceseventdeleteparticipantf")
     */
    public function deletparticipant(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $formation = $entityManager->getRepository(ParticipantF::class)->find($id);
        $entityManager->remove($formation);

        $entityManager->flush();
        return new Response("Succes");
    }


    /**
     * @Route("/webservicesafficheparticipantf/{id}", name="webservicesafficheparticipantf")
     */
    public function afficheparticipant($id ,ParticipantfRepository $participantfRepository,SerializerInterface $serializer)
    {
        $sql = "SELECT * FROM participant_f WHERE id IN (SELECT id_participant FROM participation_f WHERE id_formation =" . $id . ")";
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $jsonContent = $serializer->serialize($stmt,'json');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }





}
