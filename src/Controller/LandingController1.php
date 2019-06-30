<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LandingController1 extends AbstractController
{
    /**
     * @Route("/landing/{code}", name="app_landing")
     */
    public function index($code)
    {
        return $this->render('landing1/index.html.twig', [
        ]);
    }

    /**
     * @Route("/admin/landing", name="admin_landing_list")
     */
    public function landingList()
    {
        return $this->render('landing1/admin.landingList.html.twig', [
        ]);
    }
}
