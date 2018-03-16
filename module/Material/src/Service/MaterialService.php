<?php

namespace Material\Service;

use Material\Entity\Material;
use Material\Repository\MaterialGroupRepository;
use Material\Repository\MaterialRepository;
use Standard\Service\PaginationService;
use Unit\Repository\UnitRepository;
use Zend\View\Helper\Url;

class MaterialService
{

    /**
     * @var MaterialRepository
     */
    public $materialRepository;

    /**
     * @var MaterialGroupRepository
     */
    public $materialGroupRepository;

    /**
     * @var UnitRepository
     */
    public $unitRepository;

    /**
     * @var Url
     */
    private $url;

    /**
     * MaterialService constructor.
     *
     * @param MaterialRepository $materialRepository
     * @param MaterialGroupRepository $materialGroupRepository
     * @param UnitRepository $unitRepository
     * @param Url $url
     */
    public function __construct(
        MaterialRepository $materialRepository,
        MaterialGroupRepository $materialGroupRepository,
        UnitRepository $unitRepository,
        Url $url
    ) {
        $this->materialRepository      = $materialRepository;
        $this->materialGroupRepository = $materialGroupRepository;
        $this->unitRepository          = $unitRepository;
        $this->url                     = $url;
    }

    /**
     * @param int $page
     * @param int $limit
     *
     * @return PaginationService
     */
    public function getPagination(int $page, int $limit) : PaginationService
    {
        $pagination = new PaginationService(
            $this->materialRepository,
            'materials/list',
            $this->url
        );
        $pagination->setPage($page);
        $pagination->setLimit($limit);

        $pagination->paginate();

        return $pagination;
    }

    /**
     * @param Material $material
     * @param array $data
     * @param bool $save
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function fillEntityWithData(Material $material, array $data, bool $save) : void
    {
        $material->setName($data['name']);
        $material->setCode($data['code']);

        $material->setMaterialGroup(
            $this->materialGroupRepository->get($data['material_group'])
        );
        $material->setUnit(
            $data['unit'] ? $this->unitRepository->get($data['unit']) : null
        );

        $this->materialRepository->persist($material);

        if($save)
        {
            $this->materialRepository->flush();
        }
    }

    /**
     * @param int $id
     * @return Material|null
     */
    public function get(int $id) : ?Material
    {
        return $this->materialRepository->get($id);
    }

    /**
     * @param Material $material
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Material $material) : void
    {
        $this->materialRepository->remove($material);
    }

}
