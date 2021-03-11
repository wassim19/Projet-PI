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

class CompanyComlplaintController extends AbstractController
{
    /**
     * @Route("/companyComlplaint", name="company_comlplaint")
     * @param ReclamationRepository $reclamationRepository
     * @return Response
     */
    public function index(ReclamationRepository $reclamationRepository): Response
    {

        return $this->render('company_comlplaint/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }


    /**
     * @Route("/companyComlplaintValidatee{id}", name="company_comlplaint_Validatee", methods={"GET","POST"})
     * @param Request $request
     * @param Reclamation $reclamation
     *  @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @return Response
     */
    public function validatee(Request $request, Reclamation $reclamation,\Swift_Mailer $mailer): Response
    {

        $reclamation->setStatus(true);


            $this->getDoctrine()->getManager()->flush();

        $message=(new \Swift_Message('nouveau msg'))
            ->setFrom(['wael.bannani@esprit.tn'])
            ->setTo(['wael.bannani@esprit.tn'])
            ->setBody($this->renderView('company_comlplaint/notification.html.twig',compact('reclamation')),'text/html');
        $mailer->send($message);
        $this->addFlash('message','the email has been sent');


            return $this->redirectToRoute('company_comlplaint');



    }
    /**
     * @Route ("/companyreclamationtrier",name="companyreclamation_trier")
     * @return RedirectResponse
     */
    public function trierParId(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortById();
        dump($result);

        return $this->render('company_comlplaint/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/companyreclamationtrierparmotif",name="companyreclamation_trierparmotif")
     * @return RedirectResponse
     */
    public function sortByMotif(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByMotif();
        dump($result);

        return $this->render('company_comlplaint/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/companyreclamationtrierparmessage",name="companyreclamation_trierparmessage")
     * @return RedirectResponse
     */
    public function sortByMessage(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByMessage();
        dump($result);

        return $this->render('company_comlplaint/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/companyreclamationtrierpargsm",name="companyreclamation_trierpargsm")
     * @return RedirectResponse
     */
    public function sortByGsm(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByGsm();
        dump($result);

        return $this->render('company_comlplaint/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/companyreclamationtrierparDate",name="companyreclamation_trierparDate")
     * @return RedirectResponse
     */
    public function sortByDate(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByDate();
        dump($result);

        return $this->render('company_comlplaint/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/companyreclamationtrierparCompany",name="companyreclamation_trierparCompany")
     * @return RedirectResponse
     */
    public function sortByCompany(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByCompany();
        dump($result);

        return $this->render('company_comlplaint/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/companyreclamationtrierparStatus",name="companyreclamation_trierparStatus")
     * @return RedirectResponse
     */
    public function sortByStatus(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByStatus();
        dump($result);

        return $this->render('company_comlplaint/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
}
