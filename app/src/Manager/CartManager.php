<?php

namespace App\Manager;


use App\Repository\Order\CartItemRepository;
use App\Repository\Order\ShoppingSessionRepository;
use Symfony\Component\Security\Core\Security;

class CartManager
{
    private $shoppingSessionRepository;
    private $security;
    private $cartItemRepository;

    public function __construct(ShoppingSessionRepository $shoppingSessionRepository, Security $security, CartItemRepository $cartItemRepository)
    {
        $this->shoppingSessionRepository = $shoppingSessionRepository;
        $this->security = $security;
        $this->cartItemRepository = $cartItemRepository;
    }

    public function setCart()
    {
        $this->shoppingSessionRepository->add($this->security->getUser());
    }

    public function getCart()
    {
        $cart = $this->shoppingSessionRepository->findOneBy(['user' => $this->security->getUser()]);
        return $cart;
    }

    public function resetCart()
    {
        $cart = $this->getCart();

        foreach ($cart->getCartItems() as $item) {
            $product = $item->getProduct();
            $product->setStock($product->getStock() - $item->getQuantity());
            $this->cartItemRepository->remove($item);
        }
    }
}
