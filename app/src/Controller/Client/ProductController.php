<?php

namespace App\Controller\Client;

use App\Entity\Product\Category;
use App\Entity\Product\Product;
use App\Form\AddToCartType;
use App\Repository\Order\CartItemRepository;
use App\Service\CartService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;
    private $cartService;
    public function __construct(ManagerRegistry $entityManager, CartService $cartService)
    {
        $this->entityManager = $entityManager;
        $this->cartService = $cartService;
    }

    #[Route('/', name: 'product_list')]
    public function index(): Response
    {
        $categories = $this->entityManager->getRepository(Category::class)->findAll();
        $prodcuts = $this->entityManager->getRepository(Product::class)->findAll();
        return $this->render('client/product/index.html.twig', [
            'categories' => $categories,
            'products' => $prodcuts,
        ]);
    }

    #[Route('/products/{slug}', name: 'product_show', methods: ['GET', 'POST'])]
    public function show($slug, Request $request, CartItemRepository $cartItemRepository): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy([
            'slug' => $slug
        ]);

        $cart = $this->cartService->getCart();
        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quantity = $form->get('quantity')->getData();
            $cartItemRepository->add($cart, $product, $quantity);

            return $this->redirectToRoute('product_show', ['slug' => $product->getSlug()]);
        }


        return $this->render('client/product/show.html.twig', [
            'product' => $product,
            'form' => $form->createView()

        ]);
    }
}
