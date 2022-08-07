<?php

namespace App\Manager;

use App\Entity\Order\ShoppingSession;
use App\Service\CartService;

class CartManager
{

    private $cartService;
    public function __construct(CartService $cartService)
    {

        $this->cartService = $cartService;
    }

    public function getCurrentCart(): ShoppingSession
    {
        $cart = $this->cartService->getCart();
        return $cart;
    }

    public function resetCurrentCart()
    {
        $cart = $this->cartService->getCart();
    }
}
