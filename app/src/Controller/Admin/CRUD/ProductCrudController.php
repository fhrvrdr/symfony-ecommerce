<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Product\Inventory;
use App\Entity\Product\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ProductCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(ManagerRegistry $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function createEntity(string $entityFqcn)
    {

        $product = new Product();
        $product->setCreatedAt(date_create_immutable());
        $product->setModifiedAt(date_create_immutable());

        return $product;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            TextEditorField::new('description'),
            IntegerField::new('price'),
            IntegerField::new('stock'),
            // Slug Sonuna Unique rakam ekle
            SlugField::new('slug', 'Slug')->setTargetFieldName('name'),
            ImageField::new('image_path')->setBasePath('images')->setUploadDir('public/images')->setUploadedFileNamePattern('[slug]-[uuid].[extension]'),
            ImageField::new('image_path_2')->setBasePath('images')->setUploadDir('public/images')->setUploadedFileNamePattern('[slug]-[uuid].[extension]'),
            ImageField::new('image_path_3')->setBasePath('images')->setUploadDir('public/images')->setUploadedFileNamePattern('[slug]-[uuid].[extension]'),

            ArrayField::new('category', 'Categories')->onlyOnIndex(),
            AssociationField::new('category', 'Categories')->hideOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Products');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
