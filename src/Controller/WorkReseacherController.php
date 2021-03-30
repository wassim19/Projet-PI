<?php

namespace App\Controller;

use App\Entity\Surfer;
use App\Form\SurferType;
use App\Repository\RendezVousRepository;
use App\Repository\SurferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Evenement;
use App\Entity\ParticipantE;
use App\Entity\ParticipationE;
use App\Form\EventType;
use App\Repository\EvenementRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\DateTime;

class WorkReseacherController extends AbstractController
{
    /**
     * @Route("/surferindex", name="surferindex")
     */
    public function index(SurferRepository $surferRepository): Response
    {
        return $this->render('surfer/index.html.twig', [
            'surfers' => $surferRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $surfer = new Surfer();
        $form = $this->createForm(SurferType::class, $surfer);
        $form->add('save',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($surfer);
            $entityManager->flush();

            return $this->redirectToRoute('surferindex');
        }

        return $this->render('surfer/new.html.twig', [
            'surfer' => $surfer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show{id}", name="show", methods={"GET"})
     */
    public function show(SurferRepository $rep,$id,RendezVousRepository $repo): Response
    {$surfer=$rep->find($id);
        $rendezvous=$repo->listrendezvousparsurfer($surfer->getId());
        return $this->render('surfer/show.html.twig', [
            'surfer' => $surfer,'r'=>$rendezvous
        ]);
    }


    /**
     * @Route("/surferedit{id}", name="surferedit")
     */
    public function edit(Request $request, Surfer $surfer): Response
    {
        $form = $this->createForm(SurferType::class, $surfer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('surferindex');
        }

        return $this->render('surfer/edit.html.twig', [
            'surfer' => $surfer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deletes{id}", name="deletes")
     */
    public function delete(Request $request, Surfer $surfer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$surfer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($surfer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('surferindex');
    }

    /**
     * @Route("/new1", name="new1")
     */
    public function new1(Request $request): Response
    {
        $surfer = new Surfer();
        $form = $this->createForm(SurferType::class, $surfer);
        $form->add('save',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($surfer);
            $entityManager->flush();

            return $this->redirectToRoute('new1');
        }

        return $this->render('surfer/new1.html.twig', [
            'surfer' => $surfer,
            'form' => $form->createView(),
        ]);
    }
}
