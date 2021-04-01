<?php

namespace App\Controller;

use App\Data\SearchCV;
use App\Entity\Cv;
use App\Form\SearchCVType;
use App\Repository\CvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class AdminCvController extends AbstractController
{
    /**
     * @Route("/adminCv", name="adminCv", methods={"GET"})
     * @param CvRepository $cvRepository
     * @param Request $request
     * @return Response
     */
    public function index(CvRepository $cvRepository,Request $request): Response
    {
        return $this->render('admin_cv/index.html.twig',[

            'cvs'=>$cv=$cvRepository->findAll(),
        ]);
    }
    /**
     * @Route("/adminsearchcv ", name="adminsearchcv")
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
     * @Route ("/adminCvByName",name="adminCvByName")
     * @return RedirectResponse
     */
    public function AdminCvByName(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Cv::class);
        $result= $rep->sortByName();
        dump($result);

        return $this->render('admin_cv/archive.html.twig', [
            'cvs'=>$result
        ]);


    }
    /**
     * @Route("/adminCvTechList", name="adminCvTechList", methods={"GET"})
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
            return $this->render('admin_cv/archive.html.twig',[
                'form' => $form->createView(),
                'cvs'=>$cv=$cvRepository->findAll(),
            ]);

        }else{
            $var1=$var->getId();
            $cv=$cvRepository->findSearchCv($var1);
            return $this->render('admin_cv/archive.html.twig', [
                'form' => $form->createView(),'cvs' => $cv
            ]);
        }

    }
    /**
     * @Route ("/adminCvdelete/{id}",name="admincv_delete")
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
        return $this->redirectToRoute('adminCv');
    }
    /**
     * @Route("/adminCvshow{id}", name="admincv_show", methods={"GET"})
     */
    public function show(Cv $cv): Response
    {
        return $this->render('admin_cv/show.html.twig', [
            'cv' => $cv,
        ]);
    }
}
