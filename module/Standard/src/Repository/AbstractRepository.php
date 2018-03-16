<?php

namespace Standard\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AbstractRepository
 *
 * @package Standard\Repository
 */
abstract class AbstractRepository
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @return QueryBuilder
     */
    abstract protected function getQueryBuilder() : QueryBuilder;

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

}
