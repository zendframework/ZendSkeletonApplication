<?php

namespace Application\Controller;

use Application\Entity\Student;
use Application\Entity\Administrator;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;

class StudentController extends AbstractActionController
{
    /**
     * @var Student
     */
    protected $student;

    /**
     * @param \Zend\Mvc\MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {
        /** @var $auth \ZfcUser\Controller\Plugin\ZfcUserAuthentication */
        $auth = $this->zfcUserAuthentication();
        $identity = $auth->getIdentity();

        // only students can use this controller
        if (!$identity instanceof Student) {
            return $this->redirect()->toRoute('home');
        }

        // If we get here, 'identity' is definitely a student, so
        // set the student property to the identity
        $this->student = $identity;

        // and dispatch the appropriate action
        return parent::onDispatch($e);
    }

    /**
     * @return array|void
     */
    public function indexAction()
    {

    }

    /**
     *
     */
    public function listCoursesAction()
    {

    }

    /**
     *
     */
    public function addCourseAction()
    {

    }
}