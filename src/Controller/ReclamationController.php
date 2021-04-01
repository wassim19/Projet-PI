<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Evenement;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;


class ReclamationController extends AbstractController
{

    /**
     * @Route("/searchreclamation ", name="searchreclamation")
     */
    public function searchevenement(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Reclamation::class);
        $requestString=$request->get('searchValue');

        $reclamation = $repository->findReclamationbymotif($requestString);

        dump($reclamation);

        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($reclamation, 'json');

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        dump($jsonContent);

        return $response;
    }

    /**
     * @Route("/reclamation", name="reclamation_index", methods={"GET"})
     * @param ReclamationRepository $reclamationRepository
     * @return Response
     */
    public function index(ReclamationRepository $reclamationRepository): Response
    {

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reclamationnew", name="reclamation_new", methods={"GET","POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @return Response
     */
    public function new(Request $request,\Swift_Mailer $mailer): Response
    {
        $reclamation = new Reclamation();
        $date=$reclamation->setCreatedAt(new \DateTime('now'));
        $reclamation->setStatus(false);




        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();


            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/reclamationshow{id}", name="reclamation_show", methods={"GET"})
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
     * @Route("/reclamationedit{id}", name="reclamation_edit", methods={"GET","POST"})
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
     * @Route("/reclamationdelete{id}", name="reclamation_delete", methods={"DELETE"})
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
     * @Route ("/reclamationdelete/{id}",name="reclamation_delete")
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
        return $this->redirectToRoute('reclamation_index');
    }

    /**
     * @Route ("/reclamationtrier",name="reclamation_trier")
     * @return RedirectResponse
     */
    public function trierParId(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortById();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparmotif",name="reclamation_trierparmotif")
     * @return RedirectResponse
     */
    public function sortByMotif(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByMotif();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparmessage",name="reclamation_trierparmessage")
     * @return RedirectResponse
     */
    public function sortByMessage(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByMessage();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierpargsm",name="reclamation_trierpargsm")
     * @return RedirectResponse
     */
    public function sortByGsm(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByGsm();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparDate",name="reclamation_trierparDate")
     * @return RedirectResponse
     */
    public function sortByDate(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByDate();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparCompany",name="reclamation_trierparCompany")
     * @return RedirectResponse
     */
    public function sortByCompany(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByCompany();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparStatus",name="reclamation_trierparStatus")
     * @return RedirectResponse
     */
    public function sortByStatus(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByStatus();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }


}
