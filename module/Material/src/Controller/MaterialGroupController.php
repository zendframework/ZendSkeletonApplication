<?php

namespace Material\Controller;

use Material\Entity\Material;
use Material\Entity\MaterialGroup;
use Material\Form\MaterialForm;
use Material\Form\MaterialGroupForm;
use Material\Service\MaterialGroupService;
use Material\Service\MaterialService;
use Standard\Controller\AbstractController;
use Standard\Enum\PaginationEnum;

/**
 * Class MaterialGroupController
 *
 * @package Material\Controller
 */
class MaterialGroupController extends AbstractController
{

    /**
     * @var MaterialGroupService
     */
    private $materialGroupService;

    /**
     * MaterialController constructor.
     *
     * @param MaterialGroupService $materialGroupService
     */
    public function __construct(
        MaterialGroupService $materialGroupService
    ) {
        $this->materialGroupService = $materialGroupService;
    }

    /**
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $page  = $this->params('page', 1);
        $limit = $this->params('limit', PaginationEnum::DEFAULT_LIMIT);

        $pagination = $this->materialGroupService->getPagination($page, $limit);

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
        $form = new MaterialGroupForm(
            $this->materialGroupService->materialGroupRepository
        );

        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if($form->isValid())
            {
                $materialGroup = new MaterialGroup();
                $this->materialGroupService->fillEntityWithData($materialGroup, $form->getData(), true);
                $this->redirect()->toRoute('materials/groups');
            }
        }

        return [
            'form'           => $form
        ];
    }


    /**
     * @return array
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editAction()
    {
        $form = new MaterialGroupForm(
            $this->materialGroupService->materialGroupRepository
        );

        $materialGroup = $this->materialGroupService->get(
            $this->params()->fromRoute('id', null)
        );

        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if($form->isValid())
            {
                $this->materialGroupService->fillEntityWithData($materialGroup, $form->getData(), true);
                $this->redirect()->toRoute('materials/groups');
            }
        } else {
            $hydrator = new \Zend\Hydrator\ClassMethods(false);
            $form->setData(
                $hydrator->extract($materialGroup)
            );
        }

        return [
            'successMessage' => isset($message) ? $message : null,
            'form'           => $form
        ];
    }

    /**
     * @return \Zend\Http\Response
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeAction()
    {
        $materialGroup = $this->materialGroupService->get(
            $this->params('id', null)
        );

        if(!is_null($materialGroup))
            $this->materialGroupService->remove($materialGroup);

        return $this->redirect()->toRoute('materials/groups');
    }

}
