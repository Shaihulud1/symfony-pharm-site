<?php

namespace App\Controller;

use App\Entity\About;
use App\Form\AboutType;
use App\Repository\AboutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/admin/about", name="about_index", methods={"GET"})
     */
    public function index(AboutRepository $aboutRepository): Response
    {
        return $this->render('about/index.html.twig', [
            'abouts' => $aboutRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/about/new", name="about_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $about = new About();
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($about->getIsSlide2Text()){
                $about->clearAboutLogo();
            }else{
                $about->setSlideText(false);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($about);
            $entityManager->flush();
            return $this->redirectToRoute('about_index');
        }

        return $this->render('about/new.html.twig', [
            'about' => $about,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/about/{id}", name="about_show", methods={"GET"})
     */
    public function show(About $about): Response
    {
        return $this->render('about/show.html.twig', [
            'about' => $about,
        ]);
    }

    /**
     * @Route("/admin/about/{id}/edit", name="about_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, About $about): Response
    {
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*dd($form['about_images_files']);
            $aboutImages = $form['about_images_files']->getData();
            if($aboutImages){
                foreach($aboutImages as $image)
                {
                    dump($image);
                }
            }
            die($aboutImages);
            */
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('about_index', [
                'id' => $about->getId(),
            ]);
        }

        return $this->render('about/edit.html.twig', [
            'about' => $about,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/about/{id}", name="about_delete", methods={"DELETE"})
     */
    public function delete(Request $request, About $about): Response
    {
        if ($this->isCsrfTokenValid('delete'.$about->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($about);
            $entityManager->flush();
        }

        return $this->redirectToRoute('about_index');
    }
}
