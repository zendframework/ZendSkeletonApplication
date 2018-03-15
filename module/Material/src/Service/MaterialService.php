<?php

namespace Material\Service;

use Material\Repository\MaterialRepository;
use Standard\Service\PaginationService;

class MaterialService
{

    /**
     * @var MaterialRepository
     */
    private $materialRepository;

    /**
     * MaterialService constructor.
     *
     * @param MaterialRepository $materialRepository
     */
    public function __construct(
        MaterialRepository $materialRepository
    ) {
        $this->materialRepository = $materialRepository;
    }

    /**
     * @param int $page
     * @param int $limit
     *
     * @return PaginationService
     */
    public function getPagination(int $page, int $limit) : PaginationService
    {
        $pagination = new PaginationService($this->materialRepository);
        $pagination->setPage($page);
        $pagination->setLimit($limit);

        $pagination->paginate();

        return $pagination;
    }

}
