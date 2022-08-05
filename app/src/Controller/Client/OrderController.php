<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/client/order', name: 'app_client_order')]
    public function index(): Response
    {
        return $this->render('client/order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}
