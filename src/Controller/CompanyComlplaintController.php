<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

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
     * @Route("/companysearchreclamation ", name="companysearchreclamation")
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
     * @Route("/companyComlplaintValidatee{id}", name="company_comlplaint_Validatee", methods={"GET","POST"})
     * @param Request $request
     * @param Reclamation $reclamation
     *  @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @return Response
     */
    public function validatee(Request $request, Reclamation $reclamation): Response
    {

        $reclamation->setStatus(true);
        $mail = new PHPMailer(true);

        try {

            $nom ="wael bannani";
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
            $corps="hello there".$nom. " your complaint has been validate  " ;
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'cv';
            $mail->Body    = $corps;

            $mail->send();
            $this->addFlash('message','the email has been sent');

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


            $this->getDoctrine()->getManager()->flush();




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
