<?php

namespace Material\Controller;

use Material\Service\MaterialService;
use Zend\Mvc\Controller\AbstractActionController;

class MaterialController extends AbstractActionController
{

    /**
     * @var MaterialService
     */
    private $materialService;

    public function __construct(
        MaterialService $materialService
    ) {
        $this->materialService = $materialService;
    }

}
