<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/client/cart', name: 'app_client_cart')]
    public function index(): Response
    {
        return $this->render('client/cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
