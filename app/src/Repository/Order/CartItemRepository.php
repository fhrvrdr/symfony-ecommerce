<?php

namespace App\Repository\Order;

use App\Entity\Order\CartItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

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
    private $logger;
    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, CartItem::class);
        $this->logger = $logger;
    }

    public function add($shoppingSession, $prodcut, $quantity): void
    {
        try {
            $cartItem = new CartItem();
            $cartItem->setSession($shoppingSession);
            $cartItem->setProduct($prodcut);
            $cartItem->setQuantity($quantity);
            $cartItem->setCreatedAt(date_create_immutable());
            $cartItem->setModifiedAt(date_create_immutable());

            $this->getEntityManager()->persist($cartItem);
            $this->getEntityManager()->flush();
        }catch (\Exception $e){
            $this->logger->error('Sepete ürün eklenirken hata ile karşılaşıldı. Hata: ' . $e->getMessage());
        }

    }

    public function remove(CartItem $entity): void
    {
        $this->getEntityManager()->remove($entity);

        $this->getEntityManager()->flush();
    }


}
