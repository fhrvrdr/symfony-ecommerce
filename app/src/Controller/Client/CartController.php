<?php

namespace App\Controller\Client;

use App\Entity\Order\CartItem;
use App\Repository\Order\CartItemRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    private $cartService;
    private $cartItemRepository;
    public function __construct(CartService $cartService, CartItemRepository $cartItemRepository)
    {
        $this->cartService = $cartService;
        $this->cartItemRepository = $cartItemRepository;
    }

    #[Route('/shop/cart', name: 'show_cart', methods: 'GET')]
    public function index(): Response
    {
        $cart = $this->cartService->getCart();
        $totalPrice = $cart->getTotal();
        $cartItems = $cart->getCartItems();
        $discount = 100;
        return $this->render('client/cart/index.html.twig',  ['total' => $totalPrice, 'cartItems' => $cartItems, 'discount' => $discount]);
    }

    #[Route('/shop/cart/{id}/di', name: 'drop_cart_item')]
    public function dropItem($id)
    {
        $cartItem = $this->cartItemRepository->find($id);
        $this->cartItemRepository->dropItem($cartItem);
        return $this->redirectToRoute('show_cart');
    }

    #[Route('/shop/cart/{id}/ii', name: 'increase_cart_item')]
    public function increaseItem($id)
    {
        $cartItem = $this->cartItemRepository->find($id);
        $this->cartItemRepository->increaseItem($cartItem);
        return $this->redirectToRoute('show_cart');
    }

    #[Route('/shop/cart/{id}/rmi', name: 'delete_cart_item')]
    public function removeItem($id)
    {
        $cartItem = $this->cartItemRepository->find($id);
        $this->cartItemRepository->remove($cartItem);
        return $this->redirectToRoute('show_cart');
    }
}
