<?php

namespace App\Controller\Client;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    private $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    #[Route('/user/cart', name: 'show_cart', methods: 'GET')]
    public function index(): Response
    {
        $cart = $this->cartService->getCart();
        $totalPrice = $cart->getTotal();
        $cartItems = $cart->getCartItems();
        $discount = 100;
        return $this->render('client/cart/index.html.twig',  ['total' => $totalPrice, 'cartItems' => $cartItems, 'discount' => $discount]);
    }
}
