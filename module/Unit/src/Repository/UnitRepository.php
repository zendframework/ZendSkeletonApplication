<?php

namespace Unit\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Standard\Repository\AbstractRepository;
use Unit\Entity\Unit;

class UnitRepository extends AbstractRepository
{

    /**
     * UnitRepository constructor.
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
        return $this->getEntityManager()->getRepository(Unit::class);
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
     * @return Unit|null
     */
    public function get(int $id) : ?Unit
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param Unit $unit
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Unit $unit) : void
    {
        $this->getEntityManager()->persist($unit);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Unit $unit
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Unit $unit) : void
    {
        $this->getEntityManager()->remove($unit);
        $this->getEntityManager()->flush();
    }

}
