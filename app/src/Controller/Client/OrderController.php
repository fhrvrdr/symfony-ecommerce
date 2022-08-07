<?php

namespace App\Controller\Client;


use App\Entity\Order\OrderDetails;
use App\Repository\Order\CartItemRepository;
use App\Repository\Order\OrderDetailsRepository;
use App\Repository\Order\OrderItemsRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $cartService;
    private $cartItemRepository;
    private $orderRepository;
    private $orderItemsRepository;

    public function __construct(CartService $cartService, CartItemRepository $cartItemRepository, OrderDetailsRepository $orderRepository, OrderItemsRepository $orderItemsRepository)
    {
        $this->cartService = $cartService;
        $this->cartItemRepository = $cartItemRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemsRepository = $orderItemsRepository;
    }

    #[Route('/order', name: 'show_order', methods: 'GET')]
    public function index(): Response
    {
        $cart = $this->cartService->getCart();
        $totalPrice = $cart->getTotal();
        $cartItems = $cart->getCartItems();
        $discount = 100;

        return $this->render('client/order/checkout.html.twig', ['total' => $totalPrice, 'cartItems' => $cartItems, 'discount' => $discount]);
    }

    #[Route('/order', name: 'create_order', methods: 'POST')]
    public function create()
    {
        $cart = $this->cartService->getCart();
        $user = $this->getUser();
        $this->orderRepository->add($cart, $user);
        $order = $this->orderRepository->findOneBy(['user' => $this->getUser()]);
        foreach ($cart->getCartItems() as $item) {
            $this->orderItemsRepository->add($item, $order);
            
        }

        return $this->redirectToRoute('product_list');
    }
}
