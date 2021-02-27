<?php


namespace App\Controller;


use App\Entity\Evenement;
use App\Form\EventType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

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

    /**
     * @Route("/addevent", name="addevent")
     */
    public function AddEvent(Request $request)
    {
        $event= new Evenement();
        $form= $this->createFormBuilder($event)
            ->add('dateAt',DateTimeType::class)
            ->add('title',TextType::class)
            ->add('type',TextType::class)
            ->add('description',TextType::class)
            ->add('localitation',TextType::class)
            ->add('id_societe',TextType::class)
            ->add('Add',SubmitType::class)
        ->getForm();


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

        }

        return $this->render('evenement_societe/addevent.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}