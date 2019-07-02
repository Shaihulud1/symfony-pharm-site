<?php

namespace App\Controller;

use App\Entity\Pharm;
use App\Form\PharmType;
use App\Repository\PharmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUpload;

class PharmController extends AbstractController
{
    /**
     * @Route("/admin/pharm", name="pharm_index", methods={"GET"})
     */
    public function index(PharmRepository $pharmRepository): Response
    {
        return $this->render('pharm/index.html.twig', [
            'pharms' => $pharmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/pharm/new", name="pharm_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUpload $fileUpload): Response
    {
        $pharm = new Pharm();
        $form = $this->createForm(PharmType::class, $pharm);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pharmPicFile = $form['pharm_pic_file']->getData();
            if($pharmPicFile){
                $newFileName = $fileUpload->upload($pharmPicFile);
                $pharm->setPharmPic($this->getParameter('upload_image_directory').'/'.$newFileName);  
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pharm);
            $entityManager->flush();

            return $this->redirectToRoute('pharm_index');
        }

        return $this->render('pharm/new.html.twig', [
            'pharm' => $pharm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/pharm/{id}", name="pharm_show", methods={"GET"})
     */
    public function show(Pharm $pharm): Response
    {
        return $this->render('pharm/show.html.twig', [
            'pharm' => $pharm,
        ]);
    }

    /**
     * @Route("/admin/pharm/{id}/edit", name="pharm_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pharm $pharm, FileUpload $fileUpload): Response
    {
        $form = $this->createForm(PharmType::class, $pharm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pharmPicFile = $form['pharm_pic_file']->getData();
            if($pharmPicFile){
                $newFileName = $fileUpload->upload($pharmPicFile, $pharm->getPharmPic());
                $pharm->setPharmPic($this->getParameter('upload_image_directory').'/'.$newFileName);  
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pharm_index', [
                'id' => $pharm->getId(),
            ]);
        }

        return $this->render('pharm/edit.html.twig', [
            'pharm' => $pharm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/pharm/{id}", name="pharm_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pharm $pharm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pharm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pharm_index');
    }
}
