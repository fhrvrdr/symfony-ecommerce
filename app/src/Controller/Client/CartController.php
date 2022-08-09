<?php

namespace App\Controller\Client;


use App\Repository\Order\CartItemRepository;
use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    private $cartManager;
    private $cartItemRepository;

    public function __construct(CartManager $cartManager, CartItemRepository $cartItemRepository)
    {
        $this->cartManager = $cartManager;
        $this->cartItemRepository = $cartItemRepository;
    }

    #[Route('/shop/cart', name: 'show_cart', methods: 'GET')]
    public function index(): Response
    {
        $cart = $this->cartManager->getCart();
        $totalPrice = $cart->getTotal();
        $cartItems = $cart->getCartItems();
        $discount = 100;
        return $this->render('client/cart/index.html.twig', ['total' => $totalPrice, 'cartItems' => $cartItems, 'discount' => $discount]);
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
