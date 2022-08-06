<?php

namespace App\Repository\Customer;

use App\Entity\Customer\UserAdress;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<UserAdress>
 *
 * @method UserAdress|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAdress|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAdress[]    findAll()
 * @method UserAdress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAdressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAdress::class);
    }

    public function add($request, $user): void
    {
        $adress = new UserAdress();
        $adress->setUser($user);
        $adress->setAdress($request->request->get('adress'));
        $adress->setCity($request->request->get('city'));
        $adress->setCountry($request->request->get('country'));
        $adress->setTitle($request->request->get('title'));
        $adress->setTelephone($request->request->get('telephone'));
        $adress->setCreatedAt(date_create_immutable());
        $adress->setModifiedAt(date_create_immutable());

        $this->getEntityManager()->persist($adress);
        $this->getEntityManager()->flush();
    }

    public function update($request, $adress): void
    {

        $adress->setAdress($request->request->get('adress'));
        $adress->setCity($request->request->get('city'));
        $adress->setCountry($request->request->get('country'));
        $adress->setTitle($request->request->get('title'));
        $adress->setTelephone($request->request->get('telephone'));
        $adress->setCreatedAt(date_create_immutable());
        $adress->setModifiedAt(date_create_immutable());

        $this->getEntityManager()->persist($adress);
        $this->getEntityManager()->flush();
    }

    public function remove(UserAdress $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return UserAdress[] Returns an array of UserAdress objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserAdress
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
