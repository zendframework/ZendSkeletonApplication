<?php

namespace Application\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Course controller
 * TODO:
 * 1. Open Application/config/module.config.php and add this controller
 *      (under controllers => invokables)
 *
 * 2. Add a directory for this controller and a view for each action in
 *      Application/view/application/course
 *
 * 3. Add a form for courses in
 *      Application/src/Application/Form/Course.php
 */
class CourseController extends AbstractActionController
{
    /**
     * Check for authentication
     *
     * @param \Zend\Mvc\MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {
        // TODO: add authentication here

        return parent::onDispatch($e);
    }

    /**
     * @return array|void
     */
    public function indexAction()
    {
    }

    public function addAction()
    {

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}