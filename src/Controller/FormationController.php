<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function formation(): Response
    {
        return $this->render('formation/formation.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }
}
