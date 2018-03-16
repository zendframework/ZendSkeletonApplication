<?php

namespace Unit\Service;

use Unit\Entity\Material;
use Unit\Entity\Unit;
use Unit\Repository\MaterialGroupRepository;
use Unit\Repository\UnitRepository;
use Standard\Service\PaginationService;
use Zend\View\Helper\Url;

class UnitService
{

    /**
     * @var UnitRepository
     */
    public $unitRepository;

    /**
     * @var Url
     */
    private $url;

    /**
     * UnitService constructor.
     * @param UnitRepository $unitRepository
     * @param Url $url
     */
    public function __construct(
        UnitRepository $unitRepository,
        Url $url
    ) {
        $this->unitRepository = $unitRepository;
        $this->url            = $url;
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
            $this->unitRepository,
            'units/list',
            $this->url
        );
        $pagination->setPage($page);
        $pagination->setLimit($limit);

        $pagination->paginate();

        return $pagination;
    }

    /**
     * @param Unit $unit
     * @param array $data
     * @param bool $save
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function fillEntityWithData(Unit $unit, array $data, bool $save) : void
    {
        $unit->setName($data['name']);

        $this->unitRepository->persist($unit);

        if($save)
        {
            $this->unitRepository->flush();
        }
    }

    /**
     * @param int $id
     * @return Unit|null
     */
    public function get(int $id) : ?Unit
    {
        return $this->unitRepository->get($id);
    }

    /**
     * @param Unit $unit
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Unit $unit) : void
    {
        $this->unitRepository->remove($unit);
    }

}
