<?php

namespace Material\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Material\Entity\Material;

class MaterialRepository
{

    /**
     * @var EntityManager
     */
    private $entityManager;

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

    private function getRepository() : EntityRepository
    {
        return $this->entityManager->getRepository(Material::class);
    }

    /**
     * @return QueryBuilder
     */
    private function getQueryBuilder() : QueryBuilder
    {
        return $this->getRepository()
            ->createQueryBuilder('material');
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
        $this->entityManager->persist($material);
        $this->entityManager->flush();
    }

    /**
     * @param Material $material
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Material $material) : void
    {
        $this->entityManager->remove($material);
        $this->entityManager->flush();
    }

}
