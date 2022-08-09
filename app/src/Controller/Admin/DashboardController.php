<?php

namespace App\Controller\Admin;


use App\Controller\Admin\CRUD\CategoryCrudController;
use App\Entity\Customer\UserAdress;
use App\Entity\Order\OrderDetails;
use App\Entity\Product\Category;
use App\Entity\Product\Discount;
use App\Entity\Product\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        // Option 1. Make your dashboard redirect to the same page for all users
        //return $this->redirect($adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl());
        return $this->render('admin/my-dashboard.html.twig', [
            'name' => 'Fahri'
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecommerce Project');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('Product Settings'),
            MenuItem::linkToCrud('Category', 'fa fa-list', Category::class),
            MenuItem::linkToCrud('Product', 'fa fa-shop', Product::class),
            MenuItem::section('Order Settings'),
            MenuItem::linkToCrud('Orders', 'fa fa-cart-shopping', OrderDetails::class),
            MenuItem::linkToCrud('Discounts', 'fa fa-percent', Discount::class),
            MenuItem::section('User'),
            MenuItem::linkToCrud('User Adresses', 'fa fa-user', UserAdress::class),
        ];
    }


}
