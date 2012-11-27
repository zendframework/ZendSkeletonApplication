<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZendController;

abstract class AbstractActionController extends ZendController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (!$this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('EntityManager');
        }
        return $this->entityManager;
    }
}