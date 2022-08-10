<?php

namespace App\Repository\Order;

use App\Entity\Order\OrderItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @extends ServiceEntityRepository<OrderItems>
 *
 * @method OrderItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderItems[]    findAll()
 * @method OrderItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderItemsRepository extends ServiceEntityRepository
{
    private $logger;
    public function __construct(ManagerRegistry $registry,LoggerInterface $logger)
    {
        parent::__construct($registry, OrderItems::class);
        $this->logger = $logger;
    }

    public function add($entity, $order): void
    {
        try {
            $orderItem = new OrderItems();
            $orderItem->setProduct($entity->getProduct());
            $orderItem->setQuantity($entity->getQuantity());
            $orderItem->setOrderDetails($order);
            $orderItem->setCreatedAt(date_create_immutable());
            $orderItem->setModifiedAt(date_create_immutable());

            $this->getEntityManager()->persist($orderItem);
            $this->getEntityManager()->flush();
        }catch (\Exception $e){
            $this->logger->error('Siparişe ürün eklenirken hata ile karşılaşıldı. Hata: ' . $e->getMessage());
        }


    }

    public function remove(OrderItems $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OrderItems[] Returns an array of OrderItems objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrderItems
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
