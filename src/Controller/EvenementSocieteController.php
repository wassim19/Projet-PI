<?php


namespace App\Controller;


use App\Entity\Evenement;
use App\Form\EventType;
use App\Repository\EvenementRepository;
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
     * @Route("/adminevent", name="adminevent")
     */
    public function AdminEvent(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->findAll();


        return $this->render('evenement_societe/adminevent.html.twig', [
            'evenement' => $evenement,
        ]);

    }

    /**
     * @Route("/eventinfo{id}", name="eventinfo")
     */
    public function show(int $id)
    {
        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->findAll();
        return $this->render('evenement_societe/eventinfo.html.twig', [
            'evenement' => $evenement,
        ]);


    }

    /**
     * @Route("/manager", name="manager")
     */
    public function manager(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->findAll();


        return $this->render('evenement_societe/evenementmanager.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/socdeleteevenement{id}", name="socdeleteevenement")
     */
    public function deleteevent(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $event = $entityManager->getRepository(Evenement::class)->find($id);
        $entityManager->remove($event);
        $entityManager->flush();

        return $this->redirectToRoute("evenementsociete");
    }

    /**
     * @Route("/evenementsociete", name="evenementsociete")
     */
    public function evenement(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->findAll();
        return $this->render('evenement_societe/evenement.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/addevent", name="addevent")
     */
    public function AddEvent(Request $request)
    {
        $event= new Evenement();
        $form=$this->createForm(EventType::class,$event);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute("evenementsociete");
        }

        return $this->render('evenement_societe/addevent.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/updateevent{id}", name="updateevent")
     */
    public function UpdateEvent(Request $request,$id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event = $entityManager->getRepository(Evenement::class)->find($id);

        $form=$this->createForm(EventType::class,$event);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $entityManager->flush();
            return $this->redirectToRoute("evenementsociete");
        }

        return $this->render('evenement_societe/updateevent.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}