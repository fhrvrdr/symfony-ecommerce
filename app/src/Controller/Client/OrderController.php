<?php

namespace App\Controller\Client;


use App\Manager\CartManager;
use App\Manager\DiscountManager;
use App\Manager\OrderManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $cartManager;
    private $orderManager;
    private $discountManager;

    public function __construct(CartManager $cartManager, DiscountManager $discountManager, OrderManager $orderManager)
    {
        $this->cartManager = $cartManager;
        $this->discountManager = $discountManager;
        $this->orderManager = $orderManager;
    }

    #[Route('/order', name: 'show_order', methods: 'GET')]
    public function index(): Response
    {
        $cart = $this->cartManager->getCart();
        $totalPrice = $cart->getTotal();
        $cartItems = $cart->getCartItems();
        $discount = $this->discountManager->discount($cart);
        return $this->render('client/order/checkout.html.twig', ['total' => $totalPrice, 'cartItems' => $cartItems, 'discount' => $discount]);
    }

    #[Route('/order', name: 'create_order', methods: 'POST')]
    public function create(Request $request)
    {
        $this->orderManager->createOrder($request);
        return $this->redirectToRoute('product_list');
    }
}
