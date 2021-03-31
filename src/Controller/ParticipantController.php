<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Evenement;
use App\Entity\ParticipantE;
use App\Entity\ParticipationE;
use App\Form\ParticipantEType;
use App\Form\SearchType;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ParticipantController extends AbstractController
{

    /**
     * @Route("/evenementsociete", name="evenementsociete")
     */
    public function evenement(Request $request): Response
    {
        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $data = new SearchData();
        $form = $this->createForm(SearchType::class,$data);
        $form->handleRequest($request);
        $var = $form->get('type')->getData();

        $evenement=$rep->findSearch($var);
        dump($evenement);
        return $this->render('evenement_societe/evenement.html.twig', [
            'evenement' => $evenement,'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/participant_e{id}", name="participant_e")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function index(Request $request,$id,\Swift_Mailer $mailer): Response
    {
        $event= new ParticipantE();
        $form=$this->createForm(ParticipantEType::class,$event);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $mail = new PHPMailer(true);

            try {

                $nom = $form->get('nom')->getData();
                $email = $form->get('mail')->getData();

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
                $corps="Bonjour Monsieur/Madame ".$nom. " votre particpation est bien rcu " ;
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'participation';
                $mail->Body    = $corps;

                $mail->send();
                $this->addFlash('message','the email has been sent');

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            //end mailing




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            $participation= new ParticipationE();
            $participation->setIdEvenement($id)
                ->setIdParticipant($event->getId());
            $entityManager->persist($participation);
            $entityManager->flush();

            return $this->redirectToRoute("evenementsociete");
        }

        return $this->render('participant_e/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }


}
