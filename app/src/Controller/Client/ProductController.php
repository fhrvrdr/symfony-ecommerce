<?php

namespace App\Controller\Client;


use App\Entity\Product\Category;
use App\Entity\Product\Product;
use App\Repository\Order\ShoppingSessionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ProductController extends AbstractController
{
    private $entityManager;


    public function __construct(ManagerRegistry $entityManager)
    {
        $this->entityManager = $entityManager;
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

    #[Route('/products/{slug}', name: 'product_show', methods: 'GET')]
    public function show($slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy([
            'slug' => $slug
        ]);
        return $this->render('client/product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
