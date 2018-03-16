<?php

namespace Material\Service;

use Material\Entity\Material;
use Material\Repository\MaterialGroupRepository;
use Material\Repository\MaterialRepository;
use Standard\Service\PaginationService;
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
     * @var Url
     */
    private $url;

    /**
     * MaterialService constructor.
     * @param MaterialRepository $materialRepository
     * @param MaterialGroupRepository $materialGroupRepository
     * @param Url $url
     */
    public function __construct(
        MaterialRepository $materialRepository,
        MaterialGroupRepository $materialGroupRepository,
        Url $url
    ) {
        $this->materialRepository      = $materialRepository;
        $this->materialGroupRepository = $materialGroupRepository;
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

        $material->setMaterialGroup(
            $this->materialGroupRepository->get($data['material_group'])
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
