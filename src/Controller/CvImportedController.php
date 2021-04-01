<?php

namespace App\Controller;

use App\Entity\CvImported;
use App\Form\CvImportedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;




class CvImportedController extends AbstractController
{
    /**
     * @Route("/cvimported", name="cv_imported")
     */
    public function index(): Response
    {
        return $this->render('cv_imported/index.html.twig', [
            'controller_name' => 'CvImportedController',
        ]);
    }

    /**
     * @Route("/CvImportednew", name="CvImportednew", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $cvimported = new CvImported();
        $form = $this->createForm(CvImportedType::class, $cvimported);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $photoFile = $form->get('filename')->getData();


            $upload_directory = $this->getParameter('upload_photo');
            $newphoto = md5(uniqid()) . '.' . $photoFile->guessExtension();
            $photoFile->move(
                $upload_directory,
                $newphoto
            );
            $cvimported->setFilename($newphoto);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cvimported);
            dump($cvimported);
            $entityManager->flush();


            return $this->redirectToRoute('cv_imported');
        }
        return $this->render('cv_imported/new.html.twig', [


            'form' => $form->createView(),


        ]);
    }
}
