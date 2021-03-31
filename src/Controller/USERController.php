<?php

namespace App\Controller;

use App\Entity\NotifEvent;

use App\Entity\User;
use App\Form\WorkreseacherType;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Form\UserType;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Loader\XmlFileLoader;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Dompdf\Dompdf;
use Dompdf\Options;
class USERController extends AbstractController
{

    /**
     * @Route("/searchecompany ", name="searchecompany")
     */
    public function searchecompany(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $requestString=$request->get('searchValue');

        $company = $repository->findEvenementByname($requestString);



        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($company, 'json');

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        dump($jsonContent);


        return $response;
    }
    /**
     * @Route("/u/s/e/r", name="u_s_e_r")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'USERController',
        ]);
    }
    /**
     * @Route("/lol1", name="lol1")
     */
    public function manager(): Response
    {

        $rep=$this->getDoctrine()->getRepository(User::class);
        $user=$rep->findAll();



        return $this->render('user/companymanager.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * @Route("/usera", name="usera")
     */
    public function new1(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('save',SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('user')['images'];

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

            return $this->redirectToRoute('lol1');

        }
        return $this->render('user/ajoutmanager.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /** //
     *
     * @Route("/yahala", name="yahala")
     */
    public function index2(): Response
    {
        return $this->render('user/yahala.html.twig', [
            'controller_name' => 'USERController',
        ]);
    }
    /**
     * @Route("/userfront", name="userfront")
     */
    public function newfront(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('save',SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$form->get('images')->getData();
            $upload_directory = $this->getParameter('upload_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $upload_directory,
                $filename
            );
            $user->setImages($filename);
            $entityManager = $this->getDoctrine()->getManager();
            $hash =$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            //mailing
            $mail = new PHPMailer(true);

            try {

                $Username = $form->get('Username')->getData();

                $description = $form->get('description')->getData();
                $localisation = $form->get('localisation')->getData();
                $numero = $form->get('numero')->getData();
                $email = $form->get('emailadresse')->getData();


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
                $corps="Bonjour Monsieur/Madame  ".$Username. "voici votre copie de vos informations , votre localisation est".$localisation."votre numero est ".$numero."votre description est comme suite" .$description ;
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Sois le Bienvenue!';
                $mail->Body    = $corps;

                $mail->send();

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            //end mailing


            return $this->redirectToRoute('security_login');

        }
        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/company_index", name="company_index")

     */
    public function index3(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'user' => $userRepository->findAll(),
        ]);
    }
    /**
     * @Route("/companyeditm{id}", name="companyeditm")
     */
    public function edit(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->add('save',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lol1');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/company_show{id}", name="company_show")
     */
    public function show(int $id): Response
    {
        $rep=$this->getDoctrine()->getRepository(User::class);
        $entityManager = $this->getDoctrine()->getManager();

        $user=$rep->find($id);


        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);}
    /**
     * @Route("/company_detele{id}", name="company_delete")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lol1');
    }
    /**
     * @Route("/pdf/{id}/{Username}/{description}/{localisation}",name="pdfEvaluation")
     */
    public function pdf($id,$Username,$description,$localisation)
    {
        $mdpdf = new \Mpdf\Mpdf();

        //Contenu du PDF
        $data= "";
        //

        $data.="<h1>Votre Evaluation</h1>";

        $data.="<strong>ID Company : </strong> " . $id . "<br>";
        $data.="<strong>name of the company: </strong> " . $Username . "<br>";
        $data.="<strong>Description  : </strong> " . $description . "<br>";

        $mdpdf->WriteHTML($data);

        //Téléchargement du PDF
        $mdpdf->Output("company N".$id.".pdf","D");

        return $this->redirectToRoute('lol1');
    }
    /**
     * @Route("/sortbytitleasc", name="sortbytitleasc")
     */
    public function sortByTitleASC(): Response
    {

        $rep=$this->getDoctrine()->getRepository(User::class);
        $user=$rep->sortByTitleASC();


        return $this->render('user/companymanager.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * @Route("/sortByTitleDESC", name="sortByTitleDESC")
     */
    public function sortByTitleDESC(): Response
    {

        $rep=$this->getDoctrine()->getRepository(User::class);
        $user=$rep->sortByTitleDESC();


        return $this->render('user/companymanager.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * @Route("/sortBystatusDESC", name="sortBystatusDESC")
     */
    public function sortBystatusDESC(): Response
    {

        $rep=$this->getDoctrine()->getRepository(User::class);
        $user=$rep->sortBystatusDESC();


        return $this->render('user/companymanager.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * @Route("/listu1", name="listu1", methods={"GET"})
     */
    public function listu1(UserRepository $userRepository): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('user\pdf.html.twig', [
            'users' => $userRepository->findAll(),
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
     * @Route("/connexion", name="security_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }



    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){}
    /**
     * @Route("myprofile{id}", name="myprofile")
     */
    public function myprofile($id): Response    {
        {
            $rep=$this->getDoctrine()->getRepository(User::class);
            $entityManager = $this->getDoctrine()->getManager();

            $user=$rep->find($id);


            return $this->render('user/myprofile.html.twig', [
                'user' => $user,
            ]);}

    }



}
