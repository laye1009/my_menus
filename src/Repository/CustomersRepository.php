<?php

namespace App\Repository;

use App\Entity\Customers;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class CustomersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customers::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Customers $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Customers $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getUserInfos(){
        $sqlQ=$this->createQueryBuilder('u')
        ->select('u.firstName,u.lastName,u.email,ca.address,ca.city')
        ->join('App\Entity\CustomerAddresses','ca','with','u.id = ca.customer')
        ;
        $res = $sqlQ->getQuery()->getResult();
        return $res;

    }

}