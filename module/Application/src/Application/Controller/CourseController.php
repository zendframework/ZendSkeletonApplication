<?php

namespace Application\Controller;

use Application\Entity\Professor;
use Application\Entity\Administrator;
use Zend\Mvc\Exception;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Entity\Course as CourseEntity;


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
     * @param \Zend\Mvc\MvcEvent 
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {
        $auth = $this->zfcUserAuthentication();
        $identity = $auth->getIdentity();

        // only students can use this controller
        if (!$identity instanceof Professor) {
            return $this->redirect()->toRoute('home');
        }

        // If we get here, 'identity' is definitely a student, so
        // set the student property to the identity
        $this->professor = $identity;

        // and dispatch the appropriate action
        return parent::onDispatch($e);
    }

    /**
     * @return array|void
     */
    public function indexAction()
    {   
        $serviceLocator = $this->getServiceLocator();
        $entityManager =$serviceLocator->get('EntityManager');
        $courseRepo    = $entityManager->getRepository('Application\Entity\Course');
        $courses       = $courseRepo->findAll();

        $viewModel     = new ViewModel();
        $viewModel->setVariable('courses', $courses);
        return $viewModel;
    }

    public function addAction()
    {
           $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('EntityManager');
        $request        = $this->getRequest();
        $courseForm      = $serviceLocator->get('CourseForm');
        $courseForm->setLabel('Add a new Course');
        $courseForm->prepareElements();

        if ($request->isPost()) {
            $data = $request->getPost();

            if (isset($data['cancel'])) {
                // The cancel button was pressed. Redirect and return
                return $this->redirectToList();
            }

            $newCourse = new CourseEntity();
            $courseForm->bind($newCourse);
            $courseForm->setData($data);

            if ($courseForm->isValid()) {
                $entityManager->persist($newCourse);
                $entityManager->flush();

                // It should be saved to the db. Redirect back to the entity list
                return $this->redirectToList();
            }
        }

        
        

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $courseForm);
        return $viewModel;
    }

    

    public function editAction()
    {
        
        
        $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('EntityManager');
        $request        = $this->getRequest();
        $courseForm      = $serviceLocator->get('CourseForm');
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

        $courseForm->setLabel(sprintf('Edit %s', $course->getName()));
        $courseForm->prepareElements(); // (prepare before binding, otherwise the data will be empty)
        $courseForm->bind($course);

        if ($request->isPost()) {
            $data = $request->getPost();

            if (isset($data['cancel'])) {
                // The cancel button was pressed. Redirect and return
                return $this->redirectToList();
            }

            $courseForm->setData($data);
            if ($courseForm->isValid()) {
                $entityManager->flush();
                // It should be saved to the db. Redirect back to the entity list
                return $this->redirectToList();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $courseForm);
        return $viewModel;

    }

    public function deleteAction()
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

            $deleteForm->setData($data);
            if ($deleteForm->isValid()) {
                // Remove the entity from the db and flush
                $entityManager->remove($course);
                $entityManager->flush();
                return $this->redirectToList();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $deleteForm);
        return $viewModel;
    }

    /**
     * A helper function to redirect to the major list
     *
     * @return mixed
     */
    public function redirectToList()
    {
        // It should be saved to the db. Redirect back to the entity list
        return $this->redirect()->toRoute('course');
        
        
        
        
    }
}