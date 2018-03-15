<?php

namespace Material\Service;

use Material\Repository\MaterialRepository;

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

}
