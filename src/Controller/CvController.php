<?php

namespace App\Controller;

use App\Data\SearchCV;
use App\Entity\Cv;
use App\Entity\CvTech;
use App\Entity\Evenement;
use App\Form\CvTechType;
use App\Form\CvType;
use App\Form\SearchCVType;
use App\Repository\CvRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Easybook\SluggerInterface;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Controller\Knp\Snappy\Image;
use Knp\Bundle\SnappyBundle\Snappy\Response\JpegResponse;
use Knp\Snappy\Pdf;


class CvController extends AbstractController
{

    /**
     * @Route("/cvpdf{id}", name="cvpdf")
     */
    public function cvpdf(int $id): Response
    {

        $rep=$this->getDoctrine()->getRepository(Cv::class);
        $cv=$rep->find($id);

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('cv/cvpdf.html.twig', [
            'title' => "Welcome to our PDF Test",'cv' => $cv
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
     * @Route("/searchcv ", name="searchcv")
     */
    public function searchCategory(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Cv::class);
        $requestString=$request->get('searchValue');

        $cv = $repository->findCategory($requestString);

        dump($cv);

        $response = new Response();

        $encoders = array(new XmlEncoder(), new JsonEncode());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($cv, 'json');

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($jsonContent);
        dump($jsonContent);

        return $response;
    }

    /**
     * @Route("/Cv", name="cv_index", methods={"GET"})
     * @param CvRepository $cvRepository
     * @param Request $request
     * @return Response
     */
    public function index(CvRepository $cvRepository,Request $request): Response
    {
           return $this->render('cv/index.html.twig',[

                'cvs'=>$cv=$cvRepository->findAll(),
            ]);
    }
    /**
     * @Route("/CvTechList", name="CvTechList", methods={"GET"})
     * @param CvRepository $cvRepository
     * @param Request $request
     * @return Response
     */
    public function CvTechList(CvRepository $cvRepository,Request $request): Response
    {

        $data = new SearchCV();
        $form = $this->createForm(SearchCVType::class,$data);
        $form->handleRequest($request);
        $var = $form->get('type')->getData();
        dump($var);
        if ($var ==null){
            return $this->render('cv/archive.html.twig',[
                'form' => $form->createView(),
                'cvs'=>$cv=$cvRepository->findAll(),
            ]);

        }else{
            $var1=$var->getId();
            $cv=$cvRepository->findSearchCv($var1);
            return $this->render('cv/archive.html.twig', [
                'form' => $form->createView(),'cvs' => $cv
            ]);
        }

    }

    /**
     * @Route ("/Cvdelete/{id}",name="cv_delete")
     * @param $id
     * @param CvRepository $repository
     * @return RedirectResponse
     */
    public function delete( $id , CvRepository $repository): RedirectResponse
    {
        $cv = $repository-> find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($cv);
        $em->flush();
        return $this->redirectToRoute('cv_index');
    }

    /**
     * @Route("/new", name="cv_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $cv = new Cv();

        $rep = $this->getDoctrine()->getRepository(CvTech::class);
        $category = $rep->findAll();

        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid())

        {

            $mail = new PHPMailer(true);

            try {

                $nom = $form->get('name')->getData();
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
                $corps="Bonjour/bonsoir Monsieur/Madame ".$nom. " your cv is created  " ;
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'cv';
                $mail->Body    = $corps;

                $mail->send();
                $this->addFlash('message','the email has been sent');

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            $photoFile = $form->get('photo')->getData();


            $upload_directory = $this->getParameter('upload_photo');
            $newphoto = md5(uniqid()) . '.' . $photoFile->guessExtension();
            $photoFile->move(
                $upload_directory,
                $newphoto
            );
            $cv->setPhoto($newphoto);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cv);
            $entityManager->flush();


            return $this->redirectToRoute('cv_index');
        }
            return $this->render('cv/new.html.twig', [
                'cv' => $cv,

                'form' => $form->createView(),
                'category' => $category,

            ]);

    }

    /**
     * @Route("/Cvshow{id}", name="cv_show", methods={"GET"})
     */
    public function show(Cv $cv): Response
    {
        return $this->render('cv/show.html.twig', [
            'cv' => $cv,
        ]);
    }

    /**
     * @Route ("/CvByName",name="CvByName")
     * @return RedirectResponse
     */
    public function CvByName(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Cv::class);
        $result= $rep->sortByName();
        dump($result);

        return $this->render('cv/index.html.twig', [
            'cvs'=>$result
        ]);


    }
    /**
     * @Route ("/CvByNamee",name="CvByNamee")
     * @return RedirectResponse
     */
    public function CvByNamee(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Cv::class);
        $result= $rep->sortByName();
        dump($result);

        return $this->render('cv/archive.html.twig', [
            'cvs'=>$result
        ]);


    }
    /**
     * @Route("/{id}edit", name="cv_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Cv $cv
     * @return Response
     */
    public function edit(Request $request, Cv $cv): Response
    {
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['photo']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/images/cv/';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename =$originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $cv->setPhoto($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_index',['cv'=>$cv]);
        }

        return $this->render('cv/edit.html.twig', [
            'cv' => $cv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/searchT", name="cvtech_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function search(Request $request): Response
    {
        $cv = new Cv();

        $rep = $this->getDoctrine()->getRepository(CvTech::class);
        $category = $rep->findAll();

        $form = $this->createForm(CvTechType::class, $category);
        $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid()) {





            return $this->redirectToRoute('cv_index');
        }
        return $this->render('cv_tech/new.html.twig', [


            'form' => $form->createView(),
            'category' => $category,

        ]);

    }


    /**
     * @Route("/{id}", name="cv_delete", methods={"DELETE"})
     */

/**
    public function delete(Request $request, Cv $cv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cv->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cv_index');
    }*/
}
