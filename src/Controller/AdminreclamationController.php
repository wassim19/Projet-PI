<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AdminreclamationController extends AbstractController
{
    /**
     * @Route("/adminreclamation", name="adminreclamation_index", methods={"GET"})
     * @param ReclamationRepository $reclamationRepository
     * @return Response
     */
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('adminreclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/adminreclamationnew", name="adminreclamation_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('adminreclamation_index');
        }

        return $this->render('adminreclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reclamationshow {id}", name="reclamation_show", methods={"GET"})
     * @param Reclamation $reclamation
     * @return Response
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/reclamationedit {id}", name="reclamation_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Reclamation $reclamation
     * @return Response
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reclamationdelete/{id}", name="reclamation_delete", methods={"DELETE"})
     * @param Request $request
     * @param Reclamation $reclamation
     * @return Response
     */

    /*
    public function delete(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }
**/

    /**
     * @Route ("/adminreclamationdelete/{id}",name="adminreclamation_delete")
     * @param $id
     * @param ReclamationRepository $repository
     * @return RedirectResponse
     */
    public function delete( $id , ReclamationRepository $repository): RedirectResponse
    {
        $reclamation = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('adminreclamation_index');
    }

    /**
     * @Route ("/adminreclamationtrier",name="adminreclamation_trier")
     * @return RedirectResponse
     */
    public function trierParId(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortById();
        dump($result);

        return $this->render('adminreclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/adminreclamationtrierparmotif",name="adminreclamation_trierparmotif")
     * @return RedirectResponse
     */
    public function sortByMotif(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByMotif();
        dump($result);

        return $this->render('adminreclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/adminreclamationtrierparmessage",name="adminreclamation_trierparmessage")
     * @return RedirectResponse
     */
    public function sortByMessage(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByMessage();
        dump($result);

        return $this->render('adminreclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/adminreclamationtrierpargsm",name="adminreclamation_trierpargsm")
     * @return RedirectResponse
     */
    public function sortByGsm(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByGsm();
        dump($result);

        return $this->render('adminreclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/adminreclamationtrierparDate",name="adminreclamation_trierparDate")
     * @return RedirectResponse
     */
    public function sortByDate(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByDate();
        dump($result);

        return $this->render('adminreclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/adminreclamationtrierparCompany",name="adminreclamation_trierparCompany")
     * @return RedirectResponse
     */
    public function sortByCompany(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByCompany();
        dump($result);

        return $this->render('adminreclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/adminreclamationtrierparStatus",name="adminreclamation_trierparStatus")
     * @return RedirectResponse
     */
    public function sortByStatus(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByStatus();
        dump($result);

        return $this->render('adminreclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }


}
