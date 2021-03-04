<?php

namespace App\Controller;
use App\Entity\Evenement;
use App\Form\AddsocieteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\EventType;

use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
class AddController extends AbstractController

{/**
     * @Route ("/user",name="user")
  */
    public function adduser(Request $request)
    {
        $user= new User();
        $form=$this->createForm(AddsocieteType::class,$user);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {



            $entityManager = $this->getDoctrine()->getManager();
            $user->
            $entityManager->persist($user);

            $entityManager->flush();
            return $this->redirectToRoute("manager");
        }

        return $this->render('user/add1.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/add", name="add")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

}
