<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Customer\UserAdress;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserAdressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserAdress::class;
    }

    public function createEntity(string $entityFqcn)
    {

        $category = new UserAdress();
        $category->setCreatedAt(date_create_immutable());
        $category->setModifiedAt(date_create_immutable());

        return $category;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->hideOnForm(),
            TextField::new('title', 'Title'),
            TextField::new('city', 'City'),
            TextField::new('country', 'Country'),
            TextField::new('telephone', 'Telephone'),
            TextareaField::new('adress', 'Adress'),
            DateField::new('created_at')->hideOnForm(),
        ];
    }

}
