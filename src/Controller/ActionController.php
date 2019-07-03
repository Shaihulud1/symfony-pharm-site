<?php

namespace App\Controller;

use App\Entity\Action;
use App\Form\ActionType;
use App\Repository\ActionRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUpload;

class ActionController extends AbstractController
{
    /**
     * @Route("/admin/action", name="action_index", methods={"GET"})
     */
    public function index(ActionRepository $actionRepository): Response
    {
        return $this->render('action/index.html.twig', [
            'actions' => $actionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/action/new", name="action_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUpload $fileUpload): Response
    {
        $action = new Action();
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form['logo_pic_file']->getData();
            if($logoFile){
                $newFileName = $fileUpload->upload($logoFile);
                $action->setLogoPic($this->getParameter('upload_image_directory').'/'.$newFileName);  
            }
            $actionImageFile = $form['action_pic_file']->getData();
            if($actionImageFile){
                $newFileName = $fileUpload->upload($actionImageFile);
                $action->setActionPic($this->getParameter('upload_image_directory').'/'.$newFileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($action);
            $entityManager->flush();

            return $this->redirectToRoute('action_index');
        }

        return $this->render('action/new.html.twig', [
            'action' => $action,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/action/{id}", name="action_show", methods={"GET"})
     */
    public function show(Action $action): Response
    {
        return $this->render('action/show.html.twig', [
            'action' => $action,
        ]);
    }

    /**
     * @Route("/admin/action/{id}/edit", name="action_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Action $action, FileUpload $fileUpload): Response
    {
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form['logo_file']->getData();
            if($logoFile){
                $newFileName = $fileUpload->upload($logoFile, $action->getLogoPic());
                $action->setLogoPic($this->getParameter('upload_image_directory').'/'.$newFileName);  
            }
            $actionImageFile = $form['action_pic_file']->getData();
            if($actionImageFile){
                $newFileName = $fileUpload->upload($actionImageFile);
                $action->setActionPic($this->getParameter('upload_image_directory').'/'.$newFileName);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('action_index', [
                'id' => $action->getId(),
            ]);
        }
        return $this->render('action/edit.html.twig', [
            'action' => $action,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/action/{id}", name="action_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Action $action, FileUpload $fileUpload): Response
    {
        if ($this->isCsrfTokenValid('delete'.$action->getId(), $request->request->get('_token'))) {
            if($action->getActionPic()){
                $fileUpload->deleteExistFile($action->getActionPic());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($action);
            $entityManager->flush();
        }

        return $this->redirectToRoute('action_index');
    }
}
