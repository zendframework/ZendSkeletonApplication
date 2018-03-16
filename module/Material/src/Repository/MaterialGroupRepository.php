<?php

namespace Material\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Material\Entity\Material;
use Material\Entity\MaterialGroup;
use Standard\Interfaces\PaginationInterface;
use Standard\Repository\AbstractRepository;

class MaterialGroupRepository extends AbstractRepository implements PaginationInterface
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
        return $this->getEntityManager()->getRepository(MaterialGroup::class);
    }

    /**
     * @return String
     */
    protected function getBaseTable(): String
    {
        return 'materialGroup';
    }

    /**
     * @param int $id
     *
     * @return MaterialGroup|null
     */
    public function get(int $id) : ?MaterialGroup
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param MaterialGroup $materialGroup
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(MaterialGroup $materialGroup) : void
    {
        $this->getEntityManager()->persist($materialGroup);
        $this->getEntityManager()->flush();
    }

    /**
     * @param MaterialGroup $materialGroup
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(MaterialGroup $materialGroup) : void
    {
        $this->getEntityManager()->remove($materialGroup);
        $this->getEntityManager()->flush();
    }

}
