<?php

namespace Application\Controller;

use Application\Entity\Student;
use Application\Entity\Administrator;
use Zend\View\Model\ViewModel;

use Zend\Mvc\Exception;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Entity\Course as CourseEntity;



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
        $viewModel = new ViewModel();
        $viewModel->setVariable('student', $this->student);
        return $viewModel;
    }

    /**
     *
     */
    public function listCoursesAction()
    {
        $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('EntityManager');
        $courseRepo     = $entityManager->getRepository('Application\Entity\Course');
        $courses        = $courseRepo->findAll();
        $viewModel      = new ViewModel();

        $viewModel->setVariable('courses', $courses);
        return $viewModel;
    }

    /**
     *
     */
    public function addCourseAction()
    {
        $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('EntityManager');
        $request        = $this->getRequest();
        $form           = $serviceLocator->get('ConfirmForm');
        $courseId       = $this->params()->fromRoute('id');

        // If there's no major id, we can't edit anything. Redirect back to the list
        if (!$courseId) {
            return $this->redirectToList();
        }

        // Find the major
        /** @var $major \Application\Entity\Major */
        $course = $entityManager->find('Application\Entity\Course', $courseId);

        if (!$course) {
            // The major couldn't be found even though the ID was present! That's a problem
            throw new Exception\InvalidArgumentException("Invalid Course ID!");
        }

        $form->setLabel(sprintf('Register for class "%s"', $course->getName()));
        $form->prepareElements();

        if ($request->isPost()) {
            $data = $request->getPost();

            if (isset($data['cancel'])) {
                // The cancel button was pressed. Redirect and return
                return $this->redirectToList();
            }
            
            $this->student->addCourse($course);
            $entityManager->flush();
            return $this->redirectToList();
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $form);
        return $viewModel;
    }

    /**
     * @return \Zend\View\Model\ViewModel
     * @throws \Zend\Mvc\Exception\InvalidArgumentException
     */
    public function removeCourseAction()
    {
        $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('EntityManager');
        $request        = $this->getRequest();
        $form           = $serviceLocator->get('ConfirmForm');
        $courseId       = $this->params()->fromRoute('id');

        // If there's no major id, we can't edit anything. Redirect back to the list
        if (!$courseId) {
            return $this->redirectToList();
        }

        // Find the major
        /** @var $major \Application\Entity\Major */
        $course = $entityManager->find('Application\Entity\Course', $courseId);

        if (!$course) {
            // The course couldn't be found even though the ID was present! That's a problem
            throw new Exception\InvalidArgumentException("Invalid Course ID!");
        }

        $form->setLabel(sprintf('Remove "%s"', $course->getName()));
        $form->prepareElements();

        if ($request->isPost()) {
            $data = $request->getPost();

            if (isset($data['cancel'])) {
                // The cancel button was pressed. Redirect and return
                return $this->redirectToList();
            }

            $this->student->removeCourse($course);
            $entityManager->flush();
            return $this->redirectToList();
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $form);
        return $viewModel;
    }

    public function redirectToList()
    {
        // It should be saved to the db. Redirect back to the entity list
        return $this->redirect()->toRoute('student', array('controller' => 'list-courses'));
    }
}