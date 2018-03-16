<?php

namespace Unit\Controller;

use Unit\Entity\Unit;
use Unit\Form\UnitForm;
use Unit\Service\unitService;
use Standard\Controller\AbstractController;
use Standard\Enum\PaginationEnum;

/**
 * Class UnitController
 *
 * @package Material\Controller
 */
class UnitController extends AbstractController
{

    /**
     * @var unitService
     */
    private $unitService;

    /**
     * UnitController constructor.
     *
     * @param unitService $unitService
     */
    public function __construct(
        unitService $unitService
    ) {
        $this->unitService = $unitService;
    }

    /**
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $page  = $this->params('page', 1);
        $limit = $this->params('limit', PaginationEnum::DEFAULT_LIMIT);

        $pagination = $this->unitService->getPagination($page, $limit);

        return [
            'pagination' => $pagination,
        ];
    }

    /**
     * @return array
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addAction()
    {
        $form = new UnitForm();

        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if($form->isValid())
            {
                $unit = new Unit();
                $this->unitService->fillEntityWithData($unit, $form->getData(), true);
                $this->redirect()->toRoute('units');
            }
        }

        return [
            'form'           => $form
        ];
    }


    /**
     * @return array
     */
    public function editAction()
    {
        $form = new UnitForm();

        $unit = $this->unitService->get(
            $this->params()->fromRoute('id', null)
        );

        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if($form->isValid())
            {
                $this->unitService->fillEntityWithData($unit, $form->getData(), true);
                $this->redirect()->toRoute('materials');
            }
        } else {
            $hydrator = new \Zend\Hydrator\ClassMethods(false);
            $form->setData(
                $hydrator->extract($unit)
            );
        }

        return [
            'form' => $form
        ];
    }

    /**
     * @return \Zend\Http\Response
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeAction()
    {
        $unit = $this->unitService->get(
            $this->params('id', null)
        );

        if(!is_null($unit))
            $this->unitService->remove($unit);

        return $this->redirect()->toRoute('units');
    }

}
