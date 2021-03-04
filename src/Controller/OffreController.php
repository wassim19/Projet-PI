<?php

namespace App\Controller;

use App\Entity\CategorieOffre;
use App\Entity\Evenement;
use App\Entity\Offre;
use App\Entity\OffreEmploye;
use App\Form\EventType;
use App\Form\OffreEmployeType;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class OffreController extends AbstractController
{

    /**
     * @Route("/addoffre", name="addoffre")
     */
    public function Addoffre(Request $request)
    {
        $offre= new Offre();

        $rep=$this->getDoctrine()->getRepository(CategorieOffre::class);
        $typecategories=$rep->findAll();



        $form=$this->createForm(OffreType::class,$offre);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file = $request->files->get('offre')['imagesoffre'];
            $upload_directory = $this->getParameter('upload_directory');
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $upload_directory,
                $filename
            );
            $offre->setImagesoffre($filename);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();

        }

        return $this->render('offre/addoffre.html.twig', [
            'form' => $form->createView(),'typecategories' => $typecategories
        ]);
    }

    /**
     * @Route("/addemployer", name="addemployer")
     */
    public function Addoffremploye(Request $request)
    {
        $offremployer= new OffreEmploye();


        $form=$this->createForm(OffreEmployeType::class,$offremployer);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offremployer);
            $entityManager->flush();

            return $this->redirectToRoute("afficheCategorieOffer");

        }

        return $this->render('offre/offre_employe.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/deleteoffresoc{id}", name="deleteoffresoc")
     */
    public function deleteoffresoc(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $offre = $entityManager->getRepository(Offre::class)->findOneBy(['id' => $id]);

        $entityManager->remove($offre);
        $entityManager->flush();

        return $this->redirectToRoute("socoffrebackaffiche");
    }




    /**
     * @Route("/socoffrebackaffiche", name="socoffrebackaffiche")
     */
    public function Socoffre(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Offre::class);
        $offre=$rep->findAll();



        return $this->render('backoffre/backsoc.html.twig', [
            'offre' => $offre,
        ]);

    }

    /**
     * @Route("/updateoffresoc{id}", name="updateoffresoc")
     */
    public function Updateoffresoc(Request $request,$id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $offre = $entityManager->getRepository(Offre::class)->find($id);

        $form=$this->createForm(OffreType::class,$offre);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("socoffrebackaffiche");
        }

        return $this->render('backoffre/updatebacksoc.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deleteoffreadmin{id}", name="deleteoffreadmin")
     */
    public function deleteoffreadmin(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $offre = $entityManager->getRepository(Offre::class)->findOneBy(['id' => $id]);

        $entityManager->remove($offre);
        $entityManager->flush();

        return $this->redirectToRoute("socoffrebackafficheadmin");
    }




    /**
     * @Route("/socoffrebackafficheadmin", name="socoffrebackafficheadmin")
     */
    public function Adminoffre(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Offre::class);
        $offre=$rep->findAll();



        return $this->render('backoffre/backadmin.html.twig', [
            'offre' => $offre,
        ]);

    }

    /**
     * @Route("/updateoffreadmin{id}", name="updateoffreadmin")
     */
    public function Updateoffreadmin(Request $request,$id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $offre = $entityManager->getRepository(Offre::class)->find($id);

        $form=$this->createForm(OffreType::class,$offre);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute("socoffrebackafficheadmin");
        }

        return $this->render('backoffre/updatebackadmin.html.twig', [
            'form' => $form->createView(),
        ]);
    }







}
