<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\WorkreseacherType;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Validator\Constraints\DateTime;

class WorkReseacherController extends AbstractController
{/**
 * @Route("/findsurferByfirstname ", name="findsurferByfirst")
 */
    public function Searchbyfirstname(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $requestString=$request->get('searchValue');

        $surfer = $repository->findsurferByname($requestString);



        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($surfer, 'json');

        $response->headers->set('Content-Type', 'application/json');
        dump($jsonContent);


        return $response;
    }
    /**
     * @Route("/surferindex", name="surferindex")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('surfer/index.html.twig', [
            'surfers' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(request $request)
    {
        $user = new User();
        $form = $this->createForm(WorkreseacherType::class, $user);
        $form->add('save',SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('images')->getData();

            $upload_directory = $this->getParameter('upload_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $upload_directory,
                $filename
            );
            $user->setImages($filename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('surferindex');


            return $this->redirectToRoute('surferindex');
        }

        return $this->render('surfer/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/surferedit{id}", name="surferedit")
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(WorkreseacherType::class, $user);
        $form->add('save',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('surferindex');
        }

        return $this->render('surfer/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/deletes{id}", name="deletes")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('surferindex');
    }

    /**
     * @Route("/new1", name="new1")
     */
    public function new1(Request $request): Response
    {
        $user=new User();
        $form = $this->createForm(WorkreseacherType::class, $user);
        $form->add('save',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            //mailing
            $mail = new PHPMailer(true);

            try {

                $name= $form->get('name')->getData();

                $description = $form->get('description')->getData();
                $localisation = $form->get('localisation')->getData();
                $numero = $form->get('numero')->getData();
                $email = $form->get('emailadresse')->getData();


                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'eya.souissi@esprit.tn';             // SMTP username
                $mail->Password   = 'eyaeyaeya';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('eya.souissi@esprit.tn', 'Hand Clasper');
                $mail->addAddress($email, 'Hand Clasper user');     // Add a recipient

                // Content
                $corps="Bonjour Monsieur/Madame  ".$name. "voici votre copie de vos informations , votre localisation est".$localisation."votre numero est ".$numero."votre description est comme suite" .$description ;
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Sois le Bienvenue!';
                $mail->Body    = $corps;

                $mail->send();

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            //end mailing

            return $this->redirectToRoute('new1');
        }

        return $this->render('surfer/new1.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/listu", name="listu", methods={"GET"})
     */
    public function listu(UserRepository $userRepository): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('surfer/pdf.html.twig', [
            'surfers' => $userRepository->findAll(),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A2', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
    /**
     * @Route("/sortBynameeASC", name="sortBynameeASC")
     */
    public function sortBynameeASC(): Response
    {

        $rep=$this->getDoctrine()->getRepository(User::class);
        $surfers=$rep->sortBynameeASC();


        return $this->render('surfer/index.html.twig', [
            'surfers' => $surfers,
        ]);
    }

}
