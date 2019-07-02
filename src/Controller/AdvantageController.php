<?php

namespace App\Controller;

use App\Entity\Advantage;
use App\Form\AdvantageType;
use App\Repository\AdvantageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUpload;

class AdvantageController extends AbstractController
{
    /**
     * @Route("/admin/advantage", name="advantage_index", methods={"GET"})
     */
    public function index(AdvantageRepository $advantageRepository): Response
    {
        return $this->render('advantage/index.html.twig', [
            'advantages' => $advantageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/advantage/new", name="advantage_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUpload $fileUpload): Response
    {
        $advantage = new Advantage();
        $form = $this->createForm(AdvantageType::class, $advantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advantagePicFile = $form['advantage_pic_file']->getData();
            if($advantagePicFile){
                $newFileName = $fileUpload->upload($advantagePicFile);
                $advantage->setAdvPic($this->getParameter('upload_image_directory').'/'.$newFileName);  
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($advantage);
            $entityManager->flush();

            return $this->redirectToRoute('advantage_index');
        }

        return $this->render('advantage/new.html.twig', [
            'advantage' => $advantage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/advantage/{id}", name="advantage_show", methods={"GET"})
     */
    public function show(Advantage $advantage): Response
    {
        return $this->render('advantage/show.html.twig', [
            'advantage' => $advantage,
        ]);
    }

    /**
     * @Route("/admin/advantage/{id}/edit", name="advantage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Advantage $advantage, FileUpload $fileUpload): Response
    {
        $form = $this->createForm(AdvantageType::class, $advantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advantagePicFile = $form['advantage_pic_file']->getData();
            if($advantagePicFile){
                $newFileName = $fileUpload->upload($advantagePicFile, $advantage->getAdvPic());
                $advantage->setAdvPic($this->getParameter('upload_image_directory').'/'.$newFileName);  
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('advantage_index', [
                'id' => $advantage->getId(),
            ]);
        }

        return $this->render('advantage/edit.html.twig', [
            'advantage' => $advantage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/advantage/{id}", name="advantage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Advantage $advantage, FileUpload $fileUpload): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advantage->getId(), $request->request->get('_token'))) {
            if($advantage->getAdvPic()){
                $fileUpload->deleteExistFile($advantage->getAdvPic());
            }           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($advantage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('advantage_index');
    }
}
