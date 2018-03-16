<?php

namespace Standard\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Standard\Interfaces\PaginationInterface;

/**
 * Class AbstractRepository
 *
 * @package Standard\Repository
 */
abstract class AbstractRepository implements PaginationInterface
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @return EntityRepository
     */
    abstract protected function getRepository() : EntityRepository;

    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder() : QueryBuilder
    {
        return $this->getRepository()
            ->createQueryBuilder($this->getBaseTable());
    }

    /**
     * @return String
     */
    abstract protected function getBaseTable() : String;

    /**
     * @return int
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getResultsAmount(): int
    {
        $qb = $this->getQueryBuilder()
            ->select('COUNT(' . $this->getBaseTable() . ')');

        return $qb
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function persist($entity) : void
    {
        $this->entityManager->persist($entity);
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush() : void
    {
        $this->entityManager->flush();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager() : EntityManager
    {
        return $this->entityManager;
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

    /**
     * @return array
     */
    public function getAll() : array
    {
        return $this->getRepository()->findAll();
    }

}
