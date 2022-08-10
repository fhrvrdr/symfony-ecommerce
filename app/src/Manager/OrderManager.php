<?php

namespace App\Manager;

use App\Repository\Order\OrderDetailsRepository;
use App\Repository\Order\OrderItemsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class OrderManager
{
    private $cartManager, $security, $orderDetailsRepository, $orderItemsRepository;

    public function __construct(CartManager $cartManager, Security $security, OrderDetailsRepository $orderDetailsRepository, OrderItemsRepository $orderItemsRepository)
    {
        $this->security = $security;
        $this->cartManager = $cartManager;
        $this->orderDetailsRepository = $orderDetailsRepository;
        $this->orderItemsRepository = $orderItemsRepository;
    }

    public function createOrder(Request $request, $discount): void
    {
        $cart = $this->cartManager->getCart();
        $user = $this->security->getUser();
        $order = $this->orderDetailsRepository->add($cart, $user, $request, $discount);
        foreach ($cart->getCartItems() as $item) {
            $this->orderItemsRepository->add($item, $order);
        }
        $this->cartManager->resetCart();
    }
}