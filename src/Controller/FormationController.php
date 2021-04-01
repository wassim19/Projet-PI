<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Notificationf;
use App\Form\FormationType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FormationRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use DateTime;


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
     * @Route("/afficheformationcandidat", name="afficheformationcandidat")
     */
    public function indexcandidat(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Formation::class);
        $formations=$rep->findAll();

        return $this->render('formation/afficheformationcandidat.html.twig', ['formations' => $formations ]);
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
            $notif = new Notificationf();
            $notif->setNotif('New Formation');
            $em->persist($notif);
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute("calendar");

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
        $title = $formation->getTitle();
        $notif= new Notificationf();
        $notif->setNotif('formation '.$title.'Deleted');
        $em->persist($notif);
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
        $title = $formation->getTitle();
        $notif= new Notificationf();
        $notif->setNotif('formation '.$title.'Deleted');
        $em->persist($notif);
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
     * @Route("/printformation", name="printformation")
     */
    public function printformation(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $forma=$repo->findAll();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('formation/listformation.html.twig', ['formation' => $forma,]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("formations.pdf", [
            "Attachment" => true
        ]);

    }
    /**
     * @Route("/listformation", name="listf")
     */
    public function listf(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Formation::class);
        $forma = $repo->findAll();

        return $this->render('formation/listformation.html.twig', ['formation' => $forma,]);
    }



    /**
     * @Route ("/triformation",name="triformationtitle")
     * @return RedirectResponse
     */
    public function triformation(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $formations= $repo->findBy([],['title'=>'ASC']);
        dump($formations);
        return $this->render('formation/afficheformation.html.twig', ['formations'=>$formations]);


    }

    /**
     * @Route ("/triformationadmin",name="triformationtitleadmin")
     * @return RedirectResponse
     */
    public function triformationadmin(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $formations= $repo->findBy([],['title'=>'ASC']);
        dump($formations);
        return $this->render('formation/afficheformationadmin.html.twig', ['formations'=>$formations]);


    }

    /**
     * @Route ("/triformationtitlecandidat",name="triformationtitlecandidat")
     * @return RedirectResponse
     */
    public function triformationcandidat(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $formations= $repo->findBy([],['title'=>'ASC']);
        dump($formations);
        return $this->render('formation/afficheformationcandidat.html.twig', ['formations'=>$formations]);


    }


    /**
     * @Route ("/triformationdate",name="triformationdate")
     * @return RedirectResponse
     */
    public function triforma(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $formations= $repo->findBy([],['dateAt'=>'DESC']);
        dump($formations);
        return $this->render('formation/afficheformation.html.twig', ['formations'=>$formations]);


    }

    /**
     * @Route ("/triformationdateadmin",name="triformationdateadmin")
     * @return RedirectResponse
     */
    public function triformaadmin(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $formations= $repo->findBy([],['dateAt'=>'DESC']);
        dump($formations);
        return $this->render('formation/afficheformationadmin.html.twig', ['formations'=>$formations]);


    }

    /**
     * @Route ("/triformationdatecandidat",name="triformationdatecandidat")
     * @return RedirectResponse
     */
    public function triformacandidat(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $formations= $repo->findBy([],['dateAt'=>'ASC']);
        dump($formations);
        return $this->render('formation/afficheformationcandidat.html.twig', ['formations'=>$formations]);


    }

    /**
     * @Route("/rechercheformation", name="rechercheformation")
     */
    public function recherchformation(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Formation::class);
        $requestString=$request->get('searchValue');

        $formations = $repository->findFormationByTitle($requestString);

        dump($formations);

        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());
        $Serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $Serializer->serialize($formations, 'json');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        dump($jsonContent);

        return $response;
    }

    /**
     * @Route("/notificationformation", name="notificationformation")
     */
    public function notificationformation(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Notificationf::class);
        $notif=$rep->findAll();


        return $this->render('formation/notificationf.html.twig', [
                'notif' => $notif,
            ]
        );

    }

    /**
     * @param Formation|null $calender
     * @param Request $request
     * @return Response
     * @throws \Exception
     * @Route ("/api/{id}/edit",name="api",methods={"PUT"})
     */
    public function api(?Formation $calender,Request $request){
        $donnes=json_decode($request->getContent());
        if(
            isset($donnes->title) && isset($donnes->localisation) && isset($donnes->dateAt)
        ){
            $code=200;
            if(!$calender){
                $calender= new Formation();
                $code=201;
            }
            $calender->setTitle($donnes->title);
            $calender->setDateAt(new DateTime($donnes->dateAt));
            $calender->setLocalisation($donnes->localisation);
            $em=$this->getDoctrine()->getManager();
            $em->persist($calender);
            $em->flush();
            return new Response('ok',$code);
        }else{
            return new Response('Data missed',404);
        }
        return $this->render('formation/calendarformation.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }




    /**
     * @return Response
     * @Route ("/calendar",name="calendar")
     */
    public function calendar(FormationRepository $repository){
        $events=$repository->findAll();
        $formation=[];
        foreach ($events as $event){
            $formation[]=[
                'id'=>$event->getId(),
                'title'=>$event->getTitle(),
                'date'=>$event->getDateAt()->format('Y-m-d H:i:s'),
                'localisation'=>$event->getLocalisation()

            ];
        }
        $data= json_encode($formation);

        return $this->render('formation/calendarformation.html.twig',compact('data'));
    }

}
