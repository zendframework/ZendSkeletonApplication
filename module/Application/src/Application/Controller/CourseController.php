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
        // TODO: add authentication here (hint: look at the AdminController)

        return parent::onDispatch($e);
    }

    /**
     * @return array|void
     */
    public function indexAction()
    {
        /**
         * $this->params() returns a special helper that lets you retrieve variables
         * from the system. Your options are: fromRoute(), fromGet(), or fromPost()
         * Each method takes two arguments: the variable name, and a value to return
         * if the variable isn't set. So, $this->params()->fromRoute('nothinghere', '1234');
         * would return '1234' if there's no 'nothinghere' variable defined in the route.
         */
        $secret = $this->params()->fromRoute('secret');

        if ($secret) {
            // This passes the variable along to the view as $mysecret
            return array('mysecret' => $secret);
        }

        return null;
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