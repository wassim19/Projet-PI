<?php

namespace App\Controller;
use App\Entity\RendezVo;
use App\Entity\RendezVous;
use App\Entity\Test;
use App\Form\RendezVousType;
use App\Form\TestType;
use App\Repository\RendezVousRepository;
use App\Repository\TestRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @return Response
     * @Route ("/pdf",name="p")
     */
    public function pdf()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('test/pdf.html.twig', [
            'title' => "Welcome to our PDF Test"
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
    /**
     * @param testRepository $repository
     * @return Response
     * @Route ("/testlist",name="testlist")
     */
    public function listtest(TestRepository $repository){
        $test=$repository->findAll();
        return $this->render('test/affichetests.html.twig',array("test"=>$test));
    }
    /**
     * @param $id
     * @param TestRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/deletetest {id}",name="deletetest")
     */
    public function Deletet( $id , TestRepository $repository)
    {
        $test = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($test);
        $em->flush();
        return $this->redirectToRoute('testlist');
    }
    /**
     * @param TestRepository $repository
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("Updatetest {id}",name="updatetest")
     */
    function Updatetest(TestRepository $repository,$id,Request $request){
        $test=$repository->find($id);
        $form=$this->createForm(TestType::class,$test);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('testlist');
        }
        return $this->render("test/add.html.twig",array('form'=>$form->createView()));

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/addr",name="a")
     */
    function add(Request $request){
        $test=new Test();
        $form=$this->createForm(TestType::class,$test);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();
            return $this->redirectToRoute('testlist');
        }
        return $this->render("test/add.html.twig",array('form'=>$form->createView()));

    }



}
