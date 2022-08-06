<?php

namespace App\Manager;

use App\Entity\Order\ShoppingSession;
use App\Factory\CartFactory;
use App\Service\CartService;

class CartManager
{

    private $cartService;
    public function __construct(CartFactory $cartFactory, CartService $cartService)
    {
        $this->cartFactory = $cartFactory;
        $this->cartService = $cartService;
    }

    public function getCurrentCart(): ShoppingSession
    {
        $cart = $this->cartService->getCart();
        return $cart;
    }

    public function resetCurrentCart()
    {
    }
}
