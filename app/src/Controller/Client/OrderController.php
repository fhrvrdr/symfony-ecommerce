<?php

namespace App\Controller\Client;

use App\Entity\Order\ShoppingSession;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $em;
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em;
    }

    #[Route('/order', name: 'order_show')]
    public function index(): Response
    {

        return $this->render('client/order/checkout.html.twig');
    }
}
