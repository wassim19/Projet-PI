<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Evenement;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;


class ReclamationController extends AbstractController
{

    /**
     * @Route("/searchreclamation ", name="searchreclamation")
     */
    public function searchevenement(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Reclamation::class);
        $requestString=$request->get('searchValue');

        $reclamation = $repository->findReclamationbymotif($requestString);

        dump($reclamation);

        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($reclamation, 'json');

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        dump($jsonContent);

        return $response;
    }

    /**
     * @Route("/reclamation", name="reclamation_index", methods={"GET"})
     * @param ReclamationRepository $reclamationRepository
     * @return Response
     */
    public function index(ReclamationRepository $reclamationRepository): Response
    {

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reclamationnew", name="reclamation_new", methods={"GET","POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @return Response
     */
    public function new(Request $request,\Swift_Mailer $mailer): Response
    {
        $reclamation = new Reclamation();
        $date=$reclamation->setCreatedAt(new \DateTime('now'));
        $reclamation->setStatus(false);




        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mail = new PHPMailer(true);

            try {

                $nom = "wael bannani";
                $email = "wael.bannani@esprit.tn";




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
                $mail->setFrom('eya.souissi@esprit.tn', 'Hand Clasper');
                $mail->addAddress($email, 'Hand Clasper user');     // Add a recipient
                // Content
                $corps="hello ".$nom. " your complaint has been saved -we will process soon" ;
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'cv';
                $mail->Body    = $corps;

                $mail->send();
                $this->addFlash('message','the email has been sent');

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();


            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/reclamationshow{id}", name="reclamation_show", methods={"GET"})
     * @param Reclamation $reclamation
     * @return Response
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/reclamationedit{id}", name="reclamation_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Reclamation $reclamation
     * @return Response
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_index');
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reclamationdelete{id}", name="reclamation_delete", methods={"DELETE"})
     * @param Request $request
     * @param Reclamation $reclamation
     * @return Response
     */

    /*
    public function delete(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }
**/

    /**
     * @Route ("/reclamationdelete/{id}",name="reclamation_delete")
     * @param $id
     * @param ReclamationRepository $repository
     * @return RedirectResponse
     */
    public function delete( $id , ReclamationRepository $repository): RedirectResponse
    {
        $reclamation = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('reclamation_index');
    }

    /**
     * @Route ("/reclamationtrier",name="reclamation_trier")
     * @return RedirectResponse
     */
    public function trierParId(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortById();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparmotif",name="reclamation_trierparmotif")
     * @return RedirectResponse
     */
    public function sortByMotif(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByMotif();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparmessage",name="reclamation_trierparmessage")
     * @return RedirectResponse
     */
    public function sortByMessage(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByMessage();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierpargsm",name="reclamation_trierpargsm")
     * @return RedirectResponse
     */
    public function sortByGsm(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByGsm();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparDate",name="reclamation_trierparDate")
     * @return RedirectResponse
     */
    public function sortByDate(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByDate();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparCompany",name="reclamation_trierparCompany")
     * @return RedirectResponse
     */
    public function sortByCompany(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByCompany();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route ("/reclamationtrierparStatus",name="reclamation_trierparStatus")
     * @return RedirectResponse
     */
    public function sortByStatus(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reclamation::class);
        $result= $rep->sortByStatus();
        dump($result);

        return $this->render('reclamation/index.html.twig', [
            'reclamations'=>$result
        ]);


    }
    /**
     * @Route("/displayReclamations", name="display_reclamation")
     */
    public function allRecAction()
    {

        $reclamation = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamation);

        return new JsonResponse($formatted);

    }
    /******************Ajouter Reclamation*****************************************/
    /**
     * @Route("/addReclamation", name="add_reclamation")
     */

    public function ajouterReclamationAction(Request $request)
    {
        $reclamation = new Reclamation();
        $message=$request->query->get("message");
        $motif=$request->query->get("motif");
        $gsm=$request->query->get("gsm");



        $em = $this->getDoctrine()->getManager();
        $date = new \DateTime('now');
        $status="in proress";

        $reclamation->setGSM($gsm);
        $reclamation->setMessage($message);
        $reclamation->setCreatedAt($date);
        $reclamation->setStatus(0);
        $reclamation->setMotif($motif);
        $reclamation->setStatus2($status);
        $em->persist($reclamation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamation);
       // echo $formatted;
        return new JsonResponse($formatted);

    }
    /**
     * @Route("/deleteReclamation", name="delete_reclamation")

     */

    public function deleteReclamationAction(Request $request) {
        $id = $request->get("id");

        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->find($id);
        if($reclamation!=null ) {
            $em->remove($reclamation);
            $em->flush();

            $serialize = new Serializer([new ObjectNormalizer()]);
            $formatted = $serialize->normalize("Reclamation a ete supprimee avec success.");
            return new JsonResponse($formatted);

        }
        return new JsonResponse("id reclamation invalide.");


    }
    /******************Modifier Reclamation*****************************************/
    /**
     * @Route("/updateReclamation2", name="update_reclamation")
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function modifierReclamationAction(Request $request): JsonResponse
    {   $reclamation =new Reclamation();
        $em = $this->getDoctrine()->getManager();
        $reclamation = $this->getDoctrine()->getManager()
            ->getRepository(Reclamation::class)
            ->find($request->get("id"));

        $reclamation->setMessage($request->get("message"));
        $reclamation->setMotif($request->get("motif"));
        $reclamation->setGSM($request->get("gsm"));


        $em->persist($reclamation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamation);
        return new JsonResponse("Reclamation a ete modifiee avec success.");

    }
    /**
     * @Route("/apiupdate/{id}", name="api_update_reclamation")
     */
    public function updateReclamation (Request $request,SerializerInterface $serializer,EntityManagerInterface $entityManager,$id){
        $content=$request->getContent();
        $rec=$entityManager->getRepository(Reclamation::class)->find($id);
        $data=json_decode($content,true);
        $rec->setMessage();

    }

}
