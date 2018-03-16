<?php

namespace Material\Service;

use Material\Entity\Material;
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
     * @var Url
     */
    private $url;

    /**
     * MaterialService constructor.
     * @param MaterialRepository $materialRepository
     * @param Url $url
     */
    public function __construct(
        MaterialRepository $materialRepository,
        Url $url
    ) {
        $this->materialRepository = $materialRepository;
        $this->url                = $url;
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
     *
     * @param array $data
     * @param bool $save
     */
    public function fillEntityWithData(Material $material, array $data, bool $save) : void
    {
        $material->setName($data['name']);

        $this->materialRepository->persist($material);

        if($save)
        {
            $this->materialRepository->flush();
        }
    }

}
