<?php

namespace App\Repository\Order;

use App\Entity\Order\CartItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CartItem>
 *
 * @method CartItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartItem[]    findAll()
 * @method CartItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    public function add($shoppingSession, $prodcut, $quantity): void
    {
        $cartItem = new CartItem();
        $cartItem->setSession($shoppingSession);
        $cartItem->setProduct($prodcut);
        $cartItem->setQuantity($quantity);
        $cartItem->setCreatedAt(date_create_immutable());
        $cartItem->setModifiedAt(date_create_immutable());

        $this->getEntityManager()->persist($cartItem);
        $this->getEntityManager()->flush();
    }

    public function remove(CartItem $entity): void
    {
        $this->getEntityManager()->remove($entity);

        $this->getEntityManager()->flush();
    }

    public function dropItem(CartItem $entity): void
    {
        if ($entity->getQuantity() > 1) {
            $entity->setQuantity($entity->getQuantity() - 1);
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        } else {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        }
    }

    public function increaseItem(CartItem $entity): void
    {
        $entity->setQuantity($entity->getQuantity() + 1);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
