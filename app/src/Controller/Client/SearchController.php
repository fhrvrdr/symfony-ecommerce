<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/client/search', name: 'app_client_search')]
    public function index(): Response
    {
        return $this->render('client/search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
}
