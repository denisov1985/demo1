<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }


    public function findByCustom($value)
    {
        return $this->createQueryBuilder('p')
            ->join('p.category', 'category')
            ->where('p.name = :value')
            ->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->setFirstResult(5)
            ->getQuery()->getResult();
    }

    public function getByPrice($price)
    {
        $em = $this->getEntityManager()->createQuery();

        $query = $em->createQuery(
            'SELECT p, c 
                FROM App\Entity\Product p
                JOIN p.category c
                WHERE p.price > :price
                ORDER BY p.price ASC'
            )->setParameter('price', $price);

        $query->getResult();
    }

}
