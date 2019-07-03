<?php

namespace App\Controller;

use App\Entity\AboutLogo;
use App\Form\AboutLogoType;
use App\Repository\AboutLogoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUpload;

class AboutLogoController extends AbstractController
{
    /**
     * @Route("/admin/logo/about", name="about_logo_index", methods={"GET"})
     */
    public function index(AboutLogoRepository $aboutLogoRepository): Response
    {
        return $this->render('about_logo/index.html.twig', [
            'about_logos' => $aboutLogoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/logo/about/new", name="about_logo_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUpload $fileUpload): Response
    {
        $aboutLogo = new AboutLogo();
        $form = $this->createForm(AboutLogoType::class, $aboutLogo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form['logo_pic_file']->getData();
            if($logoFile){
                $newFileName = $fileUpload->upload($logoFile);
                $aboutLogo->setLogoPic($this->getParameter('upload_image_directory').'/'.$newFileName);  
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aboutLogo);
            $entityManager->flush();

            return $this->redirectToRoute('about_logo_index');
        }

        return $this->render('about_logo/new.html.twig', [
            'about_logo' => $aboutLogo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/logo/about/{id}", name="about_logo_show", methods={"GET"})
     */
    public function show(AboutLogo $aboutLogo): Response
    {
        return $this->render('about_logo/show.html.twig', [
            'about_logo' => $aboutLogo,
        ]);
    }

    /**
     * @Route("/admin/logo/about/{id}/edit", name="about_logo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AboutLogo $aboutLogo, FileUpload $fileUpload): Response
    {
        $form = $this->createForm(AboutLogoType::class, $aboutLogo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form['logo_pic_file']->getData();
            if($logoFile){
                $newFileName = $fileUpload->upload($logoFile, $aboutLogo->getLogoPic());
                $aboutLogo->setLogoPic($this->getParameter('upload_image_directory').'/'.$newFileName);  
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('about_logo_index', [
                'id' => $aboutLogo->getId(),
            ]);
        }

        return $this->render('about_logo/edit.html.twig', [
            'about_logo' => $aboutLogo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/logo/about/{id}", name="about_logo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AboutLogo $aboutLogo, FileUpload $fileUpload): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aboutLogo->getId(), $request->request->get('_token'))) {
            if($aboutLogo->getLogoPic()){
                $fileUpload->deleteExistFile($aboutLogo->getLogoPic());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($aboutLogo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('about_logo_index');
    }
}
