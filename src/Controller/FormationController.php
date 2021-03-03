<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FormationRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function formation(): Response
    {
        return $this->render('formation/formation.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }

    /**
     * @Route("/afficheformation", name="afficheformation")
     */
    public function index(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Formation::class);
        $formations=$rep->findAll();

        return $this->render('formation/afficheformation.html.twig', ['formations' => $formations ]);
    }

    /**
     * @Route("/afficheformationadmin", name="afficheformationadmin")
     */
    public function indexadmin(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Formation::class);
        $formations=$rep->findAll();

        return $this->render('formation/afficheformationadmin.html.twig', ['formations' => $formations ]);
    }

    /**
     * @Route("/addformation", name="addformation")
     */
    public function addformation(Request $request)
    {
        $formation= new formation();
        $form=$this->createForm(FormationType::class , $formation);
        $form->add('Id_Soc' , TextType::class);
        $form->add('Add', submittype::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file = $request->files->get('formation')['my_picture'];
            $upload_directory = $this->getParameter('upload_directory');
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $upload_directory,
                $filename
            );
            $formation->setImagef($filename);
            $em= $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute("afficheformation");

        }

        return $this->render('formation/addformation.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/delformation/{id}", name="delformation")
     */
    public function deleteformation(int $id): Response
    {

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository(Formation::class)->find($id);
        $em->remove($formation);
        $em->flush();



        return $this->redirectToRoute("afficheformation");
    }

    /**
     * @Route("/delformationadmin/{id}", name="delformationadmin")
     */
    public function deleteformationadmin(int $id): Response
    {

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository(Formation::class)->find($id);
        $em->remove($formation);
        $em->flush();



        return $this->redirectToRoute("afficheformationadmin");
    }

    /**
     * @Route("/updateformation{id}",name="updateformation")
     */
    function Update(FormationRepository $repository,$id,Request $request){
        $formation=$repository->find($id);
        $form=$this->createForm(FormationType::class,$formation);
        $form->add('Id_Soc' , TextType::class);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('afficheformation');
        }
        return $this->render("formation/updateformation.html.twig",array('f'=>$form->createView()));

    }

    /**
     * @Route("/listformation", name="listformation")
     */
    public function listf(): Response
    {

        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $forma=$repo->findAll();

        return $this->render('formation/listformation.html.twig', ['formation' => $forma,]);
    }

}
