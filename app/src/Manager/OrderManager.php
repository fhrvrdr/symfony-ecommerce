<?php

namespace App\Manager;

use App\Repository\Order\OrderDetailsRepository;
use App\Repository\Order\OrderItemsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class OrderManager
{
    private $cartService, $security, $orderDetailsRepository, $orderItemsRepository;

    public function __construct(CartManager $cartService, Security $security, OrderDetailsRepository $orderDetailsRepository, OrderItemsRepository $orderItemsRepository)
    {
        $this->security = $security;
        $this->cartService = $cartService;
        $this->orderDetailsRepository = $orderDetailsRepository;
        $this->orderItemsRepository = $orderItemsRepository;
    }

    public function createOrder(Request $request): void
    {
        $cart = $this->cartService->getCart();
        $user = $this->security->getUser();
        $order = $this->orderDetailsRepository->add($cart, $user, $request);
        foreach ($cart->getCartItems() as $item) {
            $this->orderItemsRepository->add($item, $order);
        }
        $this->cartService->resetCart();
    }
}