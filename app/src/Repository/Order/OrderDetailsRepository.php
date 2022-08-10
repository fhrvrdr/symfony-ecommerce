<?php

namespace App\Repository\Order;

use App\Entity\Order\OrderDetails;
use App\Entity\Order\OrderItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @extends ServiceEntityRepository<OrderDetails>
 *
 * @method OrderDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDetails[]    findAll()
 * @method OrderDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDetailsRepository extends ServiceEntityRepository
{
    private $logger;
    public function __construct(ManagerRegistry $registry,LoggerInterface $logger)
    {
        parent::__construct($registry, OrderDetails::class);
        $this->logger = $logger;
    }

    public function add($cart, $user, $request, $discount)
    {
        try {
            $order = new OrderDetails();

            $order->setUser($user);
            $order->setStatus(false);
            $order->setTotalPrice($cart->getTotal() - $discount);
            $order->setPaymentType($request->request->get('payment_type'));
            $order->setCreatedAt(date_create_immutable());
            $order->setModifiedAt(date_create_immutable());

            $this->getEntityManager()->persist($order);
            $this->getEntityManager()->flush();

            return $order;
        }catch (\Exception $e){
            $this->logger->error('Sipariş oluşturulurken hata ile karşılaşıldı. Hata: ' . $e->getMessage());
        }

    }

    public function remove(OrderDetails $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OrderDetails[] Returns an array of OrderDetails objects
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

//    public function findOneBySomeField($value): ?OrderDetails
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
