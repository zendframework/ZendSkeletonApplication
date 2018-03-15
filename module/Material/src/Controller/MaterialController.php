<?php

namespace Material\Controller;

use Material\Form\MaterialForm;
use Material\Service\MaterialService;
use Standard\Pagination\Enum\PaginationEnum;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Paginator;

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

    /**
     * @return array
     */
    public function indexAction()
    {
        $page = $this->params('page', 1);
        $page = $this->params('limit', PaginationEnum::DEFAULT_LIMIT);

        $pagiantion = $this->materialService->getPagination();
    }

    /**
     * @return array
     */
    public function addAction()
    {
        $form = new MaterialForm();

        return [
            'form' => $form
        ];
    }

}
