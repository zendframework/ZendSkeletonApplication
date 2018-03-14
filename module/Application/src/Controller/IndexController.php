<?php

namespace Application\Controller;

use Application\Service\IndexService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    /**
     * @var IndexService
     */
    private $indexService;

    /**
     * IndexController constructor.
     *
     * @param IndexService $indexService
     */
    public function __construct(
        IndexService $indexService
    ) {
        $this->indexService = $indexService;
    }

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}
