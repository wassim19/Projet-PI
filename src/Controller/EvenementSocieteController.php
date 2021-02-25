<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementSocieteController extends AbstractController
{
    /**
     * @Route("/evenementsociete", name="evenementsociete")
     */
    public function evenement(): Response
    {
        return $this->render('evenement_societe/evenement.html.twig', [
            'controller_name' => 'EvenementSocieteController',
        ]);
    }

}