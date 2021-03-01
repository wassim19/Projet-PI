<?php

namespace App\Controller;

use App\Form\AddsocieteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\EventType;
use App\Repository\EvenementRepository;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Validator\Constraints\DateTime;
class AddController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */

    public function adduser(Request $request)
    {
        $user= new User();
        $form=$this->createForm(AddsocieteType::class,$user);
        $form->add('Add',SubmitType::class);


        return $this->render('user/add1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
