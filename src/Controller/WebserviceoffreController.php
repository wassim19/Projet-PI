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
        $data = $serializer->deserialize($content,offre::class,'json');
        $entityManager->persist($data);
        $entityManager->flush();
        $sql ="INSERT INTO `booking`(`id_event`, `A1`, `A2`, `A3`, `A4`, `A5`, `A6`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `prix`) VALUES((SELECT max(id) FROM `evenement`),0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,15)";
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
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
        //$event->setDateAt($data['dateAt']);
        $offre->setspecialite($data['specialite']);
        $offre->setType($data['typecategorie']);
        $offre->setDescription($data['description']);
        $offre->setLocalitation($data['localitation']);
        $offre->setLocalitation($data['nb-dem']);
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
        $offre = $entityManager->getRepository(offre::class)->find($id);
        $entityManager->remove($offre);

        $entityManager->flush();
        return new Response("Succes");
    }
    /**
     * @Route("/webserviceseventoffressearch/{title}", name="webserviceseventoffressearch")
     */
    public function Search(offreRepository $offreRepository,SerializerInterface $serializer,$title)
    {
        $rep = $this->getDoctrine()->getRepository(offre::class);
        $offre = $rep->findBy(array('title' => $title));
        $response = new \Symfony\Component\HttpFoundation\Response();
        $jsonContent = $serializer->serialize($offre,'json',['groups' =>'event']);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        return $response;
    }








}
