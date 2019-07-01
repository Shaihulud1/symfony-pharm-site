<?php

namespace App\Controller;

use App\Entity\Bonus;
use App\Form\BonusType;
use App\Repository\BonusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BonusController extends AbstractController
{
    /**
     * @Route("/admin/bonus", name="bonus_index", methods={"GET"})
     */
    public function index(BonusRepository $bonusRepository): Response
    {
        return $this->render('bonus/index.html.twig', [
            'bonuses' => $bonusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/bonus/new", name="bonus_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bonus = new Bonus();
        $form = $this->createForm(BonusType::class, $bonus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bonus);
            $entityManager->flush();

            return $this->redirectToRoute('bonus_index');
        }

        return $this->render('bonus/new.html.twig', [
            'bonus' => $bonus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/bonus/{id}", name="bonus_show", methods={"GET"})
     */
    public function show(Bonus $bonus): Response
    {
        return $this->render('bonus/show.html.twig', [
            'bonus' => $bonus,
        ]);
    }

    /**
     * @Route("/admin/bonus/{id}/edit", name="bonus_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bonus $bonus): Response
    {
        $form = $this->createForm(BonusType::class, $bonus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bonus_index', [
                'id' => $bonus->getId(),
            ]);
        }

        return $this->render('bonus/edit.html.twig', [
            'bonus' => $bonus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/bonus/{id}", name="bonus_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bonus $bonus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bonus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bonus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bonus_index');
    }
}
