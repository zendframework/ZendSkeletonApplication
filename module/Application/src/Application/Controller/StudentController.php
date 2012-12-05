<?php

namespace Application\Controller;

use Application\Entity\Student;
use Application\Entity\Administrator;

use Zend\Mvc\Exception;
use Zend\View\Model\ViewModel;
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
    }

    /**
     *
     */
    public function listCoursesAction()
    {
        $serviceLocator = $this->getServiceLocator();
        $entityManager =$serviceLocator->get('EntityManager');
        $courseRepo    = $entityManager->getRepository('Application\Entity\Course');
        $courses       = $courseRepo->findAll();

        $viewModel     = new ViewModel();
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
        $deleteForm     = $serviceLocator->get('DeleteForm');
        $courseId        = $this->params()->fromRoute('id');

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

        $deleteForm->setLabel(sprintf('Delete %s', $course->getName()));
        $deleteForm->prepareElements(); // (prepare before binding, otherwise the data will be empty)

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
        $viewModel->setVariable('course', $course);
        $viewModel->setVariable('form', $deleteForm);
        return $viewModel;
    }
}