<?php

namespace App\Service;


use App\Repository\Order\ShoppingSessionRepository;
use Symfony\Component\Security\Core\Security;

class CartService
{
    private $shoppingSessionRepository;
    private $security;
    public function __construct(ShoppingSessionRepository $shoppingSessionRepository, Security $security)
    {
        $this->shoppingSessionRepository = $shoppingSessionRepository;
        $this->security = $security;
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
}
