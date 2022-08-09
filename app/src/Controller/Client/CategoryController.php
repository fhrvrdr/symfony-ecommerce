<?php

namespace App\Controller\Client;

use App\Entity\Product\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private $entityManager;


    public function __construct(ManagerRegistry $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/category/{name}', name: 'app_category')]
    public function index($name): Response
    {

        $category = $this->entityManager->getRepository(Category::class)->findOneBy([
            'name' => $name
        ]);

        return $this->render('client/category/index.html.twig', [
            'category' => $category,
        ]);
    }
}
