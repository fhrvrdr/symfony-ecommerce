<?php

namespace App\Repository\Order;

use App\Entity\Order\ShoppingSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @extends ServiceEntityRepository<ShoppingSession>
 *
 * @method ShoppingSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingSession[]    findAll()
 * @method ShoppingSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingSessionRepository extends ServiceEntityRepository
{
    private $logger;
    public function __construct(ManagerRegistry $registry,LoggerInterface $logger)
    {
        parent::__construct($registry, ShoppingSession::class);
        $this->logger = $logger;
    }

    public function add($user): void
    {
        try {
            $shoppingSession = new ShoppingSession();
            $shoppingSession->setUser($user);
            $shoppingSession->setTotal(0);
            $shoppingSession->setCreatedAt(date_create_immutable());
            $shoppingSession->setModifiedAt(date_create_immutable());

            $this->getEntityManager()->persist($shoppingSession);
            $this->getEntityManager()->flush();
        }catch (\Exception $e){
            $this->logger->error('Sepet Oluşturulurken hata ile karşılaşıldı. Hata: ' . $e->getMessage());
        }


    }


    public function remove(ShoppingSession $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return ShoppingSession[] Returns an array of ShoppingSession objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ShoppingSession
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
