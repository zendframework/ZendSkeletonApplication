<?php

namespace Material\Service;

use Material\Entity\MaterialGroup;
use Material\Repository\MaterialGroupRepository;
use Standard\Service\PaginationService;
use Zend\View\Helper\Url;

class MaterialGroupService
{

    /**
     * @var MaterialGroupRepository
     */
    public $materialGroupRepository;

    /**
     * @var Url
     */
    private $url;

    /**
     * MaterialGroupService constructor.
     *
     * @param MaterialGroupRepository $materialGroupRepository
     * @param Url $url
     */
    public function __construct(
        MaterialGroupRepository $materialGroupRepository,
        Url $url
    ) {
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
            $this->materialGroupRepository,
            'materials/groups/list',
            $this->url
        );
        $pagination->setPage($page);
        $pagination->setLimit($limit);

        $pagination->paginate();

        return $pagination;
    }

    /**
     * @param MaterialGroup $materialGroup
     * @param array $data
     * @param bool $save
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function fillEntityWithData(MaterialGroup $materialGroup, array $data, bool $save) : void
    {
        $materialGroup->setName($data['name']);

        $materialGroup->setParent(
            $data['parent'] ? $this->get($data['parent']) : null
        );

        $this->materialGroupRepository->persist($materialGroup);

        if($save)
        {
            $this->materialGroupRepository->flush();
        }
    }

    /**
     * @param int $id
     * @return MaterialGroup|null
     */
    public function get(int $id) : ?MaterialGroup
    {
        return $this->materialGroupRepository->get($id);
    }

    /**
     * @param MaterialGroup $materialGroup
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(MaterialGroup $materialGroup) : void
    {
        $this->materialGroupRepository->remove($materialGroup);
    }

}
