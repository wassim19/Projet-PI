<?php


namespace App\Controller;

use App\Entity\Eventlikes;
use App\Entity\NotifEvent;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Evenement;
use App\Entity\ParticipantE;
use App\Entity\ParticipationE;
use App\Form\EventType;
use App\Repository\EvenementRepository;
use Doctrine\Persistence\ObjectManager;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\DateTime;

class EvenementSocieteController extends AbstractController
{
    /**
     * @param $uid
     * @param $eid
     * @return Response
     * @Route ("/like{uid}/{eid}" , name="like")
     */
    public function like($uid,$eid):Response{


        $rep=$this->getDoctrine()->getRepository(Eventlikes::class);
        $repu=$this->getDoctrine()->getRepository(ParticipantE::class);
        $repe=$this->getDoctrine()->getRepository(Evenement::class);
        $entityManager = $this->getDoctrine()->getManager();

        $user = $repu->find($uid);
        $event = $repe->find($eid);

        $like = $rep->findOneBy([
                'user' => $uid ,
                'event' => $eid
        ]);

        if(!empty($like)){
            $entityManager->remove($like);
            $entityManager->flush();

            return $this->json([
                'code' => 200 ,
                'message' => 'like bien supprimer',
                'likes' => $rep->count(['event' => $event])
            ],200);

        }else{
            $like = new Eventlikes();
            $like->setUser($user)
                ->setEvent($event);

            $entityManager->persist($like);
            $entityManager->flush();
            return $this->json([
                'code' => 200 ,
                'message' => 'like bien ajouter',
                'likes' => $rep->count(['event' => $event])
            ],200);
        }
    }

    /**
     * @Route("/pdf{id}", name="pdf")
     */
    public function pdf(int $id): Response
    {

        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->find($id);

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('evenement_societe/eventmail.html.twig', [
            'title' => "Welcome to our PDF Test",'evenement' => $evenement
        ]);

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $dompdf->stream("mmypdf.pdf", [
            "Attachment" => false
        ]);

        // Send some text response
        return new Response("sd");
    }

    /**
     * @Route("/eventinfo{id}", name="eventinfo")
     */
    public function show(int $id): Response
    {
        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $entityManager = $this->getDoctrine()->getManager();

        $evenement=$rep->find($id);
        dump($evenement);
        $evenement->setViewed($evenement->getViewed()+1);
        $entityManager->persist($evenement);
        $entityManager->flush();

        return $this->render('evenement_societe/eventinfo.html.twig', [
            'evenement' => $evenement,
        ]);


    }

    /**
     * @Route("/manager", name="manager")
     */
    public function manager(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->findAll();


        return $this->render('evenement_societe/evenementmanager.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/sortbytitleasc", name="sortbytitleasc")
     */
    public function sortByTitleASC(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->sortByTitleASC();


        return $this->render('evenement_societe/evenementmanager.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/sortbytitledesc", name="sortbytitledesc")
     */
    public function sortByTitleDESC(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $evenement=$rep->sortByTitleDESC();
        return $this->render('evenement_societe/evenementmanager.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/socdeleteevenement{id}", name="socdeleteevenement")
     */
    public function deleteevent(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $event = $entityManager->getRepository(Evenement::class)->find($id);
        $entityManager->remove($event);
        $title = $event->getTitle();

        $notif = new NotifEvent();
        $notif->setNotif('Event '.$title.' Deleted');
        $entityManager->persist($notif);
        $entityManager->flush();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       $entityManager->flush();

        return $this->redirectToRoute("manager");
    }



    /**
     * @Route("/addevent", name="addevent")
     */
    public function AddEvent(Request $request)
    {
        $event= new Evenement();
        $form=$this->createForm(EventType::class,$event);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file = $request->files->get('event')['my_picture'];
            $upload_directory = $this->getParameter('upload_directory');
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $upload_directory,
                $filename
            );
            $entityManager = $this->getDoctrine()->getManager();
            $notif = new NotifEvent();
            $notif->setNotif('New Event Is Here');
            $entityManager->persist($notif);

            $event->setPicture($filename);

            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute("manager");
        }

        return $this->render('evenement_societe/addevent.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/updateevent{id}", name="updateevent")
     */
    public function UpdateEvent(Request $request,$id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event = $entityManager->getRepository(Evenement::class)->find($id);

        $form=$this->createForm(EventType::class,$event);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $title = $event->getTitle();

            $notif = new NotifEvent();
            $notif->setNotif('Event '.$title.' Updated');
            $entityManager->persist($notif);
            //$entityManager->flush();

            $entityManager->flush();
            return $this->redirectToRoute("manager");
        }

        return $this->render('evenement_societe/updateevent.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/searchevenement ", name="searchevenement")
     */
    public function searchevenement(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        $requestString=$request->get('searchValue');

        $evenement = $repository->findEvenementByTitle($requestString);


        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($evenement, 'json');
        dump($jsonContent);

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);


        return $response;
    }

    /**
     * @Route("/notificationuser", name="notificationuser")
     */
    public function notificationuser(): Response
    {

        $rep=$this->getDoctrine()->getRepository(NotifEvent::class);
        $notif=$rep->findAll();


        return $this->render('evenement_societe/notifuser.html.twig', [
                'notif' => $notif,
            ]
        );

    }
}