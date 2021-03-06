<?php

namespace App\Controller;


use App\Entity\RendezVous;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Validator\Constraints\DateTime;
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
            isset($donnes->meet) && isset($donnes->description) && isset($donnes->mail)
        ){
            $code=200;
            if(!$calender){
                $calender= new RendezVous();
                $code=201;
            }
            $calender->setDate(new DateTime($donnes->date));
            $calender->setMeet($donnes->meet);
            $calender->setDescription(($donnes->description));
            //$calender->setMail($donnes->mail);


            $em=$this->getDoctrine()->getManager();
            $em->persist($calender);
            $em->flush();
            dump($donnes);

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
                'mail'=>$event->getMail(),
                'meet'=>$event->getMeet(),
                'date'=>$event->getDate()->format('Y-m-d H:i:s'),
                'description'=>$event->getDate()

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
     * @Route ("/addrdv",name="addrendez-vous")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    function add(Request $request,\Swift_Mailer $mailer){
        $rendezvous=new RendezVous();
        $form=$this->createForm(RendezVousType::class,$rendezvous);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($rendezvous);
            $em->flush();

            $contact=$form->getData();
            $message=(new \Swift_Message('nouveau msg'))
                ->setFrom(['expediteur@email.com'])
                ->setTo(['destinataire@email.com'])
            ->setBody($this->renderView('rendez_vous/contact.html.twig',compact('contact')),'text/html');
            $mailer->send($message);
            $this->addFlash('message','the email has been sent');
            return $this->redirectToRoute('calender');
        }
        return $this->render("rendez_vous/index.html.twig",array('form'=>$form->createView()));

    }

    /**
     * @Route ("/supprdv {id}",name="d")
     * @param $id
     * @param RendezVousRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function Delete( $id , RendezVousRepository $repository)
    {
        $rendezvous = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($rendezvous);
        $em->flush();
        return $this->redirectToRoute('rendezvous');
    }

    /**
     * @Route("Updaterdv {id}",name="update")
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

        $evenement = $repository->findrdvBydate($requestString);

        dump($evenement);

        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($evenement, 'json');

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        dump($jsonContent);

        return $response;
    }

}
