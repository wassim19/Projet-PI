<?php

namespace App\Controller;

use App\Entity\CvTech;
use App\Form\CvTechType;
use App\Repository\CvTechRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CvTechController extends AbstractController
{
    /**
     * @Route("/tech", name="cv_tech_index", methods={"GET"})
     */
    public function index(CvTechRepository $cvTechRepository ): Response

    {

        return $this->render('cv_tech/index.html.twig', [
            'cv_teches' => $cvTechRepository->findAll(),
        ]);
    }

    /**
     * @Route("/CvTechnew", name="cv_tech_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cvTech = new CvTech();
        $form = $this->createForm(CvTechType::class, $cvTech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cvTech);
            $entityManager->flush();

            return $this->redirectToRoute('cv_tech_index');
        }

        return $this->render('cv_tech/new.html.twig', [
            'cv_tech' => $cvTech,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Cvtech{id}", name="cv_tech_show", methods={"GET"})
     */
    public function show(CvTech $cvTech): Response
    {
        return $this->render('cv_tech/show.html.twig', [
            'cv_tech' => $cvTech,
        ]);
    }

    /**
     * @Route("/{id}edit", name="cv_tech_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CvTech $cvTech): Response
    {
        $form = $this->createForm(CvTechType::class, $cvTech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_tech_index');
        }

        return $this->render('cv_tech/edit.html.twig', [
            'cv_tech' => $cvTech,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cv_tech_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CvTech $cvTech): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cvTech->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cvTech);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_tech_index');
    }
}
