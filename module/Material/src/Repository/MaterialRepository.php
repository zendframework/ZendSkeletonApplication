<?php

namespace Material\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Material\Entity\Material;
use Standard\Interfaces\PaginationInterface;
use Standard\Repository\AbstractRepository;

class MaterialRepository extends AbstractRepository implements PaginationInterface
{

    /**
     * MaterialRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository() : EntityRepository
    {
        return $this->getEntityManager()->getRepository(Material::class);
    }

    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder() : QueryBuilder
    {
        return $this->getRepository()
            ->createQueryBuilder('material');
    }

    /**
     * @return String
     */
    protected function getBaseTable(): String
    {
        return 'material';
    }

    /**
     * @param int $id
     *
     * @return Material|null
     */
    public function get(int $id) : ?Material
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param Material $material
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Material $material) : void
    {
        $this->getEntityManager()->persist($material);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Material $material
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Material $material) : void
    {
        $this->getEntityManager()->remove($material);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $first
     * @param int $limit
     *
     * @return array
     */
    public function getPaginationResults(
        int $first,
        int $limit
    ): array
    {
        $qb = $this->getQueryBuilder()
            ->setFirstResult($first)
            ->setMaxResults($limit);

        return $qb
            ->getQuery()
            ->getResult();
    }

}
