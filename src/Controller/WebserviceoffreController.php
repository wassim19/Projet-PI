<?php

namespace App\Controller;


use App\Entity\Offre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\NotifOffre;
use App\Entity\OffreEmploye;
use App\Form\OffreEmployeType;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Dompdf\Dompdf;
use Dompdf\Options;

class WebserviceoffreController extends AbstractController
{

    /**
     * @Route("/webserviceseventaddoffre", name="webserviceseventaddoffre")
     */
    public function addoffre(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager)
    {
        $content = $request->getContent();
        $data = $serializer->deserialize($content,Offre::class,'json');
        $entityManager->persist($data);
        $entityManager->flush();

        return new Response("Succes");
    }
    /**
     * @Route("/webservicesafficheoffre", name="webservicesafficheoffre")
     */
    public function afficheoffre (offreRepository $offreRepository,SerializerInterface $serializer,Request $request)
    {
        $offre=$offreRepository->findAll();
        $response = new Response();
        $jsonContent = $serializer->serialize($offre,'json',['groups' =>'offre']);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }

    /**
     * @Route("/webserviceseventupdateoffre/{id}", name="webserviceseventupdateoffre")
     */
    public function updateoffre(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $content = $request->getContent();
        $offre = $entityManager->getRepository(Offre::class)->find($id);
        $data = json_decode($content, true);
        $offre->setSpecialite($data['specialite']);
        $offre->setLocalisation($data['localisation']);
        $offre->setNbDem($data['nb_dem']);
        $offre->setDescription($data['description']);
        $entityManager->persist($offre);
        $entityManager->flush();
        //$nom = $data->get('title');
        return new Response("Succes");
    }

    /**
     * @Route("/webserviceseventdeletoffre/{id}", name="webserviceseventdeleteoffre")
     */
    public function deleteoffre(Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id)
    {
        $offre = $entityManager->getRepository(Offre::class)->find($id);
        $entityManager->remove($offre);

        $entityManager->flush();
        return new Response("Succes");
    }








}
