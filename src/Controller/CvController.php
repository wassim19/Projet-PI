<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Entity\CvTech;
use App\Form\CvTechType;
use App\Form\CvType;
use App\Repository\CvRepository;
use Easybook\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;


class CvController extends AbstractController
{

    /**
     * @Route("/searchcv ", name="searchcv")
     */
    public function searchCategory(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Cv::class);
        $requestString=$request->get('searchValue');

        $cv = $repository->findCategory($requestString);

        dump($cv);

        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($cv, 'json');

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        dump($jsonContent);

        return $response;
    }
    /**
     * @Route("/Cv", name="cv_index", methods={"GET"})
     * @param CvRepository $cvRepository
     * @return Response
     */
    public function index(CvRepository $cvRepository): Response
    {
        return $this->render('cv/archive.html.twig', [
            'cvs' => $cvRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Cvdelete/{id}",name="cv_delete")
     * @param $id
     * @param CvRepository $repository
     * @return RedirectResponse
     */
    public function delete( $id , CvRepository $repository): RedirectResponse
    {
        $cv = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($cv);
        $em->flush();
        return $this->redirectToRoute('cv_index');
    }

    /**
     * @Route("/new", name="cv_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $cv = new Cv();

        $rep = $this->getDoctrine()->getRepository(CvTech::class);
        $category = $rep->findAll();

        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('photo')->getData();


            $upload_directory = $this->getParameter('upload_photo');
            $newphoto = md5(uniqid()) . '.' . $photoFile->guessExtension();
            $photoFile->move(
                $upload_directory,
                $newphoto
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cv);
            $entityManager->flush();


            return $this->redirectToRoute('cv_index');
        }
            return $this->render('cv/new.html.twig', [
                'cv' => $cv,

                'form' => $form->createView(),
                'category' => $category,

            ]);

    }

    /**
     * @Route("/Cvshow{id}", name="cv_show", methods={"GET"})
     */
    public function show(Cv $cv): Response
    {
        return $this->render('cv/show.html.twig', [
            'cv' => $cv,
        ]);
    }

    /**
     * @Route("/{id}edit", name="cv_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Cv $cv
     * @return Response
     */
    public function edit(Request $request, Cv $cv): Response
    {
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['photo']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/images/cv/';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename =$originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $cv->setPhoto($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_index',['cv'=>$cv]);
        }

        return $this->render('cv/edit.html.twig', [
            'cv' => $cv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/searchT", name="cvtech_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function search(Request $request): Response
    {
        $cv = new Cv();

        $rep = $this->getDoctrine()->getRepository(CvTech::class);
        $category = $rep->findAll();

        $form = $this->createForm(CvTechType::class, $category);
        $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid()) {





            return $this->redirectToRoute('cv_index');
        }
        return $this->render('cv_tech/new.html.twig', [


            'form' => $form->createView(),
            'category' => $category,

        ]);

    }


    /**
     * @Route("/{id}", name="cv_delete", methods={"DELETE"})
     */

/**
    public function delete(Request $request, Cv $cv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cv->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_index');
    }*/
}
