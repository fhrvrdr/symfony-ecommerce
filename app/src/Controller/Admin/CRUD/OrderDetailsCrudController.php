<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Order\OrderDetails;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderDetails::class;
    }

    public function createEntity(string $entityFqcn)
    {

        $orderDetails = new OrderDetails();
        $orderDetails->setCreatedAt(date_create_immutable());
        $orderDetails->setModifiedAt(date_create_immutable());

        return $orderDetails;

    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user', 'Customer')->hideOnForm(),
            DateField::new('modified_at', 'Order Date')->hideOnForm(),
            ArrayField::new('orderItems')->onlyOnDetail(),
            BooleanField::new('status', 'Order Status')->onlyOnIndex()->setDisabled(),
            BooleanField::new('status', 'Order Status')->hideOnIndex(),

            AssociationField::new('orderItems', 'Items')->onlyOnIndex(),


        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Order')
            ->setEntityLabelInPlural('Orders')
            ->setPageTitle('detail', 'Order Details');
    }
}
