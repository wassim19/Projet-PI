<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class CompanyController extends AbstractController
{ /**
 * @Route("/lol", name="lol")
 */
    public function manager(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Company::class);
        $company=$rep->findAll();


        return $this->render('company/companymanager.html.twig', [
            'company' => $company,
        ]);
    }

    /**
     * @Route("/company_index", name="company_index")

     */
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('company/index.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/company", name="company")
     */
    public function new(Request $request,UserPasswordEncoderInterface $encoder )
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->add('save',SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           /* $hash=$encoder->encodePassword($company,$company->getPass());
            $company->setPass($hash);*/
            $file = $request->files->get('company')['images'];
            $upload_directory = $this->getParameter('upload_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $upload_directory,
                $filename
            );
            $company->setImages($filename);
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('company_index');

        }
        return $this->render('company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/company_show{id}", name="company_show")
     */
    public function show(CompanyRepository $companyRepository,$id): Response
    {
        return $this->render('company/show.html.twig', [
            'company' =>  $companyRepository->find($id),
        ]);
    }

    /**
     * @Route("/company_edit{id}", name="company_edit")
     */
    public function edit(Request $request, Company $company)
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->add('save',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lol');
        }

        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/company_detele{id}", name="company_delete")
     */
    public function delete(Request $request, Company $company): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($company);
            $entityManager->flush();
        }

        return $this->redirectToRoute('company_index');
    }
    /**
     * @Route("/company_detelee{id}", name="company_deletee",requirements={"id":"id"})
     */
    public function delete1(Request $request,$id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $company = $entityManager->getRepository(Company::class)->findOneBy($id);
        $entityManager->remove($company);
        $entityManager->flush();


        return $this->redirectToRoute('company_index');
    }/**
 *
 * @Route("/yahala", name="yahala")
 */
    public function index1(): Response
    {
        return $this->render('company/yahala.html.twig', [
            'controller_name' => 'CompanyController ',
        ]);
    }
    /**
     * @Route("/companym", name="companym")
     */
    public function new1(Request $request)
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->add('save',SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('company')['images'];
            $upload_directory = $this->getParameter('upload_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $upload_directory,
                $filename
            );
            $company->setImages($filename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('lol');

        }
        return $this->render('company/ajoutmanager.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/companyeditm{id}", name="companyeditm")
     */
    public function editm(Request $request, Company $company)
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->add('save',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lol');
        }

        return $this->render('company/editm.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

}

