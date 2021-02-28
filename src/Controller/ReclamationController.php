<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="reclamation")
     */
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }
    /**
     * @Route("/add_reclamation", name="add_reclamation")
     */
    public function addReclamation(): Response
    {
        return $this->render('reclamation/add.html.twig', [
            'controller_name' => 'ReclamationaddController',
        ]);
    }

}
