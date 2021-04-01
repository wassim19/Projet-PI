<?php

namespace App\Controller;

use App\Entity\ParticipantF;
use App\Entity\ParticipationF;
use App\Form\FormationType;
use App\Form\ParticipantfType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ParticipantfController extends AbstractController
{
    /**
     * @Route("/participantf{id}", name="participantf")
     */
    public function index(Request $request,$id): Response
    {
        $formation= new ParticipantF();
        $form=$this->createForm(ParticipantfType::class, $formation);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em=$this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            //mailing
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

            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
            $participf = new ParticipationF();
            $participf ->setIdFormation($id)
                ->setIdParticipant($formation->getId());
            $em->persist($participf);
            $em->flush();
            return $this->redirectToRoute("afficheformationcandidat");
        }
        return $this->render("participantf/index.html.twig",array('form'=>$form->createView()));


    }

    /**
     * @Route("/afficheformation", name="formation")
     */
    public function participant(): Response
    {
        return $this->render('participantf/index.html.twig', [
            'controller_name' => 'ParticipantfController',
        ]);

    }
    /**
     * @Route("/participants{id}", name="participants")
     */
    public function gestionparticipant($id): Response
    {



        $rep = $this->getDoctrine()->getRepository(ParticipationF::class);
        $participation = $rep->findBy(array('id_formation' => $id));
        dump($participation);





        return $this->render('participantf/paticipantformation.html.twig', [
            'participation'=>$participation
        ]);
    }
    /**
     * @Route("/delpf{id}", name="delpf")
     */
    public function deleteparticipantformation(int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $participation = $entityManager->getRepository(ParticipationF::class)->findOneBy(['id_participant' => $id]);
        $entityManager->remove($participation);
        $entityManager->flush();

        return $this->redirectToRoute("afficheformationadmin");
    }


}
