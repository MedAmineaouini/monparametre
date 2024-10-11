<?php
// src/Controller/DashboardController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{
    #[Route(path: '/dashboard', name: 'dashboard')]
    public function index(): Response
    {
//        if ($this->getUser()) {
            return $this->render('dashboard/index.html.twig', [
                'controller_name' => 'DashboardController',
            ]);
//        }
//        return $this->redirectToRoute('app_login');
    }
}
