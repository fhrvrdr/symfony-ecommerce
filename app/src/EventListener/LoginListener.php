<?php

namespace App\EventListener;


use App\Service\CartService;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{

    private $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if ($this->cartService->getCart() == null) {
            $this->cartService->setCart();
        }
    }
}
