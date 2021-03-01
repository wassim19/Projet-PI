<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\ParticipantE;
use App\Form\ParticipantEType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{






    /**
     * @Route("/adminevenement{id}", name="adminevenement")
     */
    public function deleteevenementt(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $event = $entityManager->getRepository(Evenement::class)->find($id);
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
}
