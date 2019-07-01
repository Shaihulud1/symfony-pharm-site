<?php

namespace App\Controller;

use App\Entity\Landing;
use App\Form\LandingType;
use App\Repository\LandingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LandingController extends AbstractController
{
    /**
     * @Route("/admin/landing", name="landing_index", methods={"GET"})
     */
    public function index(LandingRepository $landingRepository): Response
    {
        return $this->render('landing/index.html.twig', [
            'landings' => $landingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/landing/new", name="landing_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $landing = new Landing();
        $form = $this->createForm(LandingType::class, $landing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $landing->setCreatedAt(new \DateTime());
            $entityManager->persist($landing);
            $entityManager->flush();

            return $this->redirectToRoute('landing_index');
        }

        return $this->render('landing/new.html.twig', [
            'landing' => $landing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/landing/{id}", name="landing_show", methods={"GET"})
     */
    public function show(Landing $landing): Response
    {
        return $this->render('landing/show.html.twig', [
            'landing' => $landing,
        ]);
    }

    /**
     * @Route("/admin/landing/{id}/edit", name="landing_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Landing $landing): Response
    {
        $form = $this->createForm(LandingType::class, $landing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('landing_index', [
                'id' => $landing->getId(),
            ]);
        }

        return $this->render('landing/edit.html.twig', [
            'landing' => $landing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/landing/{id}", name="landing_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Landing $landing): Response
    {
        if ($this->isCsrfTokenValid('delete'.$landing->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($landing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('landing_index');
    }
}
