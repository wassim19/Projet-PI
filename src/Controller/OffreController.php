<?php

namespace App\Controller;

use App\Entity\CategorieOffre;

use PHPMailer\PHPMailer\SMTP;
use App\Entity\Evenement;
use App\Entity\Formation;
use App\Entity\NotifEvent;
use App\Entity\NotifOffre;
use App\Entity\Offre;
use App\Entity\OffreEmploye;
use App\Form\EventType;
use App\Form\OffreEmployeType;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Dompdf\Dompdf;
use Dompdf\Options;

class OffreController extends AbstractController
{

    /**
     * @route("/socoffrebackaffiche/statistique",name="sta")
     */
    public function statisti(OffreRepository $repository)
    {

        $opp=$repository->findAll();

        return $this->render("offre/statistique.html.twig",['off'=>$opp]);

    }
    /**
     * @Route("/notificationoffre", name="notificationoffre")
     */
    public function notificationoffre(): Response
    {

        $rep=$this->getDoctrine()->getRepository(NotifOffre::class);
        $notif=$rep->findAll();


        return $this->render('offre/notifoffre.html.twig', [
                'notif' => $notif,
            ]
        );

    }


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
            $entityManager = $this->getDoctrine()->getManager();
            $notif = new NotifOffre();
            $notif->setNotifoffre('New offre Is Here');
            $entityManager->persist($notif);

            $offre->setImagesoffre($filename);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->flush();
            return $this->redirectToRoute("afficheCategorieOffer");

        }

        return $this->render('offre/addoffre.html.twig', [
            'form' => $form->createView(),'typecategories' => $typecategories
        ]);
    }

    /**
     * @Route("/addemployer", name="addemployer")
     */
    public function Addoffremploye(Request $request,\Swift_Mailer $mailer)
    {
        $offremployer= new OffreEmploye();


        $form=$this->createForm(OffreEmployeType::class,$offremployer);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $mail = new PHPMailer(true);

            try {

                $nom = $form->get('mail')->getData();

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
                $mail->addAddress($nom, 'Hand Clasper user');     // Add a recipient
                // Content
                $corps="Bonjour Monsieur/Madame ".$nom. " votre particpation est bien rcu " ;
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'participation';
                $mail->Body    = $corps;

                $mail->send();
                $this->addFlash('message','the email has been sent');

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offremployer);
            $entityManager->flush();

            return $this->redirectToRoute("addemployer");

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

        $entityManager = $this->getDoctrine()->getManager();
        $notif = new NotiftOffre();
        $notif->setNotif('New offre Is Here');
        $entityManager->persist($notif);

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
            $entityManager = $this->getDoctrine()->getManager();
            $notif = new NotifOffre();
            $notif->setNotif('New offre Is Here');
            $entityManager->persist($notif);

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
        dump($offre);



        return $this->render('backoffre/backadmin.html.twig', [
            'offre' => $offre,
        ]);

    }
    /**
     * @Route("/rechercheoffre", name="rechercheoffre")
     */
    public function recherchoffre(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(offre::class);
        $requestString=$request->get('searchValue');

        $offre = $repository->findoffreBySpecialite($requestString);
         dump($offre);


        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());
        $Serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $Serializer->serialize($offre, 'json');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        dump($jsonContent);

        return $response;
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
    /**
     * @Route("/list", name="offre_pdf", methods={"GET"})
     */
    public function pdf(OffreRepository $offreRepository): Response
    {


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $Offre = $offreRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('offre/Listepdfoffre.html.twig', [
            'offre' => $Offre ,
        ]);
// Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Listepdfpub.pdf", [
            "Attachment" => true
        ]);

    }







}
