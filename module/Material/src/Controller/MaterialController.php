<?php

namespace Material\Controller;

use Material\Entity\Material;
use Material\Form\MaterialForm;
use Material\Service\MaterialService;
use Standard\Controller\AbstractController;
use Standard\Enum\PaginationEnum;

/**
 * Class MaterialController
 *
 * @package Material\Controller
 */
class MaterialController extends AbstractController
{

    /**
     * @var MaterialService
     */
    private $materialService;

    /**
     * MaterialController constructor.
     *
     * @param MaterialService $materialService
     */
    public function __construct(
        MaterialService $materialService
    ) {
        $this->materialService = $materialService;
    }

    /**
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $page  = $this->params('page', 1);
        $limit = $this->params('limit', PaginationEnum::DEFAULT_LIMIT);

        $pagination = $this->materialService->getPagination($page, $limit);

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
        $form = new MaterialForm(
            $this->materialService->materialGroupRepository,
            $this->materialService->unitRepository
        );

        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if($form->isValid())
            {
                $material = new Material();
                $this->materialService->fillEntityWithData($material, $form->getData(), true);
                $this->redirect()->toRoute('materials');
            }
        }

        return [
            'form' => $form
        ];
    }


    /**
     * @return array
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editAction()
    {
        $form = new MaterialForm(
            $this->materialService->materialGroupRepository,
            $this->materialService->unitRepository
        );

        $material = $this->materialService->get(
            $this->params()->fromRoute('id', null)
        );

        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if($form->isValid())
            {
                $this->materialService->fillEntityWithData($material, $form->getData(), true);
                $this->redirect()->toRoute('materials');
            }
        } else {
            $hydrator = new \Zend\Hydrator\ClassMethods(false);
            $form->setData(
                $hydrator->extract($material)
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
        $material = $this->materialService->get(
            $this->params('id', null)
        );

        if(!is_null($material))
            $this->materialService->remove($material);

        return $this->redirect()->toRoute('materials');
    }

}
