<?php

namespace App\Controller;

use App\Entity\Notificationrdv;
use App\Form\SurferType;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Entity\RendezVous;
use phpDocumentor\Reflection\Types\String_;
use DateTime;
use App\Entity\Surfer;
use App\Form\RendezVousType;
use App\Repository\RendezVousRepository;
use App\Repository\SurferRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class RendezVousController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('rendez_vous/index.html.twig', [
            'controller_name' => 'RendezVousController',
        ]);
    }

    /**
     * @param RendezVous|null $calender
     * @param Request $request
     * @return Response
     * @throws \Exception
     * @Route ("/api/{id}/edit",name="api",methods={"PUT"})
     */
    public function api(?RendezVous $calender,Request $request){
        $donnes=json_decode($request->getContent());


        if(
            isset($donnes->meet) && isset($donnes->description) && isset($donnes->date)
        ){
            $code=200;
            if(!$calender){
                $calender= new RendezVous();
                $code=201;
            }
            $calender->setDate(new DateTime($donnes->date));
            $calender->setMeet($donnes->meet);
            $calender->setDescription($donnes->description);

           // $calender->setMail($donnes->mail);


            $em=$this->getDoctrine()->getManager();
            $em->persist($calender);
            $em->flush();


            return new Response('ok',$code);
        }else{
            return new Response('Data missed',404);
        }
        return $this->render('rendez_vous/calender.html.twig', [
            'controller_name' => 'RendezVousController',
        ]);
    }

    /**
     * @return Response
     * @Route ("/calender",name="calender")
     */
    public function calender(RendezVousRepository $repository){
        $events=$repository->findAll();
        $rdvs=[];
        foreach ($events as $event){
            $rdvs[]=[
                'id'=>$event->getId(),
                //'mail'=>$event->getMail()->getEmailadress(),
                'meet'=>$event->getMeet(),
                'date'=>$event->getDate()->format('Y-m-d H:i:s'),
                'description'=>$event->getDescription()

            ];
        }

        $data= json_encode($rdvs);
        return $this->render('rendez_vous/calender.html.twig',compact('data'));
    }

    /**
     * @param RendezVousRepository $repository
     * @return Response
     * @Route("/rdvafficher",name="rendezvous")
     */
    public function listrendezvous(RendezVousRepository $repository){
        $rendezvous=$repository->findAll();
        return $this->render('rendez_vous/affiche.html.twig',array("rendezvous"=>$rendezvous));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/addrdv",name="addrendez-vous")
     */
    function add(Request $request){
        $rendezvous=new RendezVous();
        $form=$this->createForm(RendezVousType::class,$rendezvous);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $notif = new Notificationrdv();
            $notif->setNotification('New meet');
            $em->persist($notif);
            $em->persist($rendezvous);
            $em->flush();

            //mailing
            $mail = new PHPMailer(true);

            try {

                $meet= $form->get('meet')->getData();
                $description = $form->get('description')->getData();
                $date = $form->get('date')->getData();
                $email = $form->get('mail')->getData()->getEmailadress();

                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'faroukgasaraa@gmail.com';             // SMTP username
                $mail->Password   = 'farouk1998';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('faroukgasaraa@gmail.com', 'Hand Clasper');
                $mail->addAddress($email, 'Hand Clasper user');     // Add a recipient
                // Content
                $corps="Bonjour Monsieur/Madame  voici votre lien meet pour passer l'entretien en ligne: ".$meet. "  la date ".$date->format('Y-m-d H:i:s')." votre description est comme suit: " .$description ;
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Sois le Bienvenue pour votre entretien en ligne!';
                $mail->Body    = $corps;

                $mail->send();
                $this->addFlash('message','the email has been sent');

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            //end mailing
            return $this->redirectToRoute('calender');
        }
        return $this->render("rendez_vous/index.html.twig",array('form'=>$form->createView()));

    }
    /**
     * @Route("/notificationrdv", name="notificationrdv")
     */
    public function notificationrdv(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Notificationrdv::class);
        $notif=$rep->findAll();


        return $this->render('rendez_vous/notificationrdv.html.twig', [
                'notif' => $notif,
            ]
        );

    }

    /**
     * @Route ("/supprdv{id}",name="d")
     * @param $id
     * @param RendezVousRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function Delete( $id , RendezVousRepository $repository)
    {
        $rendezvous = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($rendezvous);
        $title = $rendezvous->getDate()->format('Y-m-d H:i:s');
        $notif= new Notificationrdv();
        $notif->setNotification('meet '.$title.'Deleted');
        $em->persist($notif);
        $em->flush();
        return $this->redirectToRoute('rendezvous');
    }

    /**
     * @Route("update{id}",name="update")
     * @param RendezVousRepository $repository
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    function Update(RendezVousRepository $repository,$id,Request $request){
        $rendezvous=$repository->find($id);
        $form=$this->createForm(RendezVousType::class,$rendezvous);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('rendezvous');
        }
        return $this->render("rendez_vous/update.html.twig",array('f'=>$form->createView()));

    }



    /**
     * @param RendezVousRepository $repository
     * @return Response
     * @Route ("/order",name="order")
     */
    public function orderbymail(RendezVousRepository $repository){
        $rendezvous=$repository->orderbymail();
        return $this->render('rendez_vous/affiche.html.twig',array("rendezvous"=>$rendezvous));
    }
    /**
     * @Route("/shows{id}", name="shows", methods={"GET"})
     */
    public function shows(SurferRepository $rep,$id,RendezVousRepository $repo): Response
    {$surfer=$rep->find($id);
        $rendezvous=$repo->listrendezvousparsurfer($surfer->getId());
        return $this->render('surfer/shows.html.twig', [
            'surfer' => $surfer,'r'=>$rendezvous
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/searchrdv",name="searchrdv")
     */
    public function searchrdv(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(RendezVous::class);
        $requestString=$request->get('searchValue');
        $rdv = $repository->findrdvBydate($requestString);
        return $this->render('rendez_vous/rendezvousajax.html.twig' ,[
            "rendezvous"=>$rdv
        ]);
    }

}
