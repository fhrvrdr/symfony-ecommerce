<?php

namespace App\EventListener;


use App\Manager\CartManager;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{

    private $cartManager;

    public function __construct(CartManager $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if ($this->cartManager->getCart() == null) {
            $this->cartManager->setCart();
        }
    }
}
