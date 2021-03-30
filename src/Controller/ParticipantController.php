<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Evenement;
use App\Entity\ParticipantE;
use App\Entity\ParticipationE;
use App\Form\ParticipantEType;
use App\Form\SearchType;
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
            $data = $form->getData();
            $message=(new \Swift_Message('nouveau msg'))
                ->setFrom(['faroukgasaraa@gmail.com'])
                ->setTo(['faroukgasaraa@gmail.com'])
                ->setBody($this->renderView('evenement_societe/participationmail.html.twig',compact('data')),'text/html');
            $mailer->send($message);
            $this->addFlash('message','the email has been sent');



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            $participation= new ParticipationE();
            $participation->setIdEvenement($id)
                ->setIdParticipant($event->getId());
            $entityManager->persist($participation);
            $entityManager->flush();

            //return $this->redirectToRoute("evenementsociete");
        }

        return $this->render('participant_e/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }


}
