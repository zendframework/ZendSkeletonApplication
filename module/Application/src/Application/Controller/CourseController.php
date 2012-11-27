<?php

namespace Application\Controller;

use Application\Entity\Course as CourseEntity;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;


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
        // TODO: add authentication here (hint: look at the AdminController)

        return parent::onDispatch($e);
    }

    /**
     * @return array|void
     */
    public function indexAction()
    {
        $entityManager = $this->getEntityManager();
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
        $courseForm      = $serviceLocator->get('Application\Form\Course');
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

            if ($majorForm->isValid()) {
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
        $courseForm      = $serviceLocator->get('Application\Form\Course');
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
        $deleteForm     = $serviceLocator->get('Application\Form\Delete');
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
        return $this->redirect()->toRoute('application/default', array(
            'controller' => 'major',
            'action'     => 'index'
        ));
        
        
        
        
    }
}