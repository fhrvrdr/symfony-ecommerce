<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Product\Category;
use Cassandra\Time;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class CategoryCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return Category::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->hideOnForm(),
            TextField::new('name', 'Name'),
            AssociationField::new('parent', 'Parent'),
            ArrayField::new('products')->onlyOnDetail(),
            DateField::new('created_at')->onlyOnIndex(),
            DateField::new('modified_at')->onlyOnIndex(),

        ];
    }

    public function createEntity(string $entityFqcn)
    {

        $category = new Category();
        $category->setCreatedAt(date_create_immutable());
        $category->setModifiedAt(date_create_immutable());

        return $category;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Categories');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
