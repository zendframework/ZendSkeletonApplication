<?php

namespace Application\Controller;

use Application\Entity\Professor;
use Application\Entity\Major as MajorEntity;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Exception;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MajorController extends AbstractActionController
{
    /**
     * This is always run before anything else. It's a good time
     * to check to see if the user is allowed to access this controller.
     *
     * @param \Zend\Mvc\MvcEvent $e
     * @return mixed
     * @throws \Zend\Mvc\Exception\RuntimeException
     */
    public function onDispatch(MvcEvent $e)
    {
        /** @var $auth \ZfcUser\Controller\Plugin\ZfcUserAuthentication */
        $auth = $this->zfcUserAuthentication();
        if (!$auth->hasIdentity()) {
            // The user is not authenticated! Redirect to the login route.
            return $this->redirect()->toRoute('zfcuser/login');
        }

        $identity = $auth->getIdentity();
        // Only professors are allowed to see this controller.
        if (!$identity instanceof Professor) {
            throw new Exception\RuntimeException("Only professors are allowed here!");
        }

        return parent::onDispatch($e);
    }

    /**
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        /** @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager   = $this->getServiceLocator()->get('EntityManager');
        $majorRepository = $entityManager->getRepository('Application\Entity\Major');
        $majors          = $majorRepository->findAll();

        $viewModel = new ViewModel();
        $viewModel->setVariable('majors', $majors);
        return $viewModel;
    }

    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        /**
         * @var $request \Zend\Http\Request
         * @var $majorForm \Application\Form\Major
         * @var $entityManager \Doctrine\ORM\EntityManager
         */
        $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('EntityManager');
        $request        = $this->getRequest();
        $majorForm      = $serviceLocator->get('MajorForm');
        $majorForm->setLabel('Add a new Major');
        $majorForm->prepareElements();

        if ($request->isPost()) {
            $data = $request->getPost();

            if (isset($data['cancel'])) {
                // The cancel button was pressed. Redirect and return
                return $this->redirectToList();
            }

            $newMajor = new MajorEntity();
            $majorForm->bind($newMajor);
            $majorForm->setData($data);

            if ($majorForm->isValid()) {
                $entityManager->persist($newMajor);
                $entityManager->flush();

                // It should be saved to the db. Redirect back to the entity list
                return $this->redirectToList();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $majorForm);
        return $viewModel;
    }

    /**
     * Very similar to the Add action, but the differences are important.
     */
    public function editAction()
    {
        /**
         * @var $request \Zend\Http\Request
         * @var $majorForm \Application\Form\Major
         * @var $entityManager \Doctrine\ORM\EntityManager
         */
        $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('EntityManager');
        $request        = $this->getRequest();
        $majorForm      = $serviceLocator->get('MajorForm');
        $majorId        = $this->params()->fromRoute('id');

        // If there's no major id, we can't edit anything. Redirect back to the list
        if (!$majorId) {
            return $this->redirectToList();
        }

        // Find the major
        /** @var $major \Application\Entity\Major */
        $major = $entityManager->find('Application\Entity\Major', $majorId);

        if (!$major) {
            // The major couldn't be found even though the ID was present! That's a problem
            throw new Exception\InvalidArgumentException("Invalid Major ID!");
        }

        $majorForm->setLabel(sprintf('Edit %s', $major->getName()));
        $majorForm->prepareElements(); // (prepare before binding, otherwise the data will be empty)
        $majorForm->bind($major);

        if ($request->isPost()) {
            $data = $request->getPost();

            if (isset($data['cancel'])) {
                // The cancel button was pressed. Redirect and return
                return $this->redirectToList();
            }

            $majorForm->setData($data);
            if ($majorForm->isValid()) {
                $entityManager->flush();
                // It should be saved to the db. Redirect back to the entity list
                return $this->redirectToList();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $majorForm);
        return $viewModel;
    }

    /**
     * @return \Zend\View\Model\ViewModel
     * @throws \Zend\Mvc\Exception\InvalidArgumentException
     */
    public function deleteAction()
    {
        /**
         * @var $request \Zend\Http\Request
         * @var $majorForm \Application\Form\Major
         * @var $entityManager \Doctrine\ORM\EntityManager
         */
        $serviceLocator = $this->getServiceLocator();
        $entityManager  = $serviceLocator->get('EntityManager');
        $request        = $this->getRequest();
        $deleteForm     = $serviceLocator->get('DeleteForm');
        $majorId        = $this->params()->fromRoute('id');

        // If there's no major id, we can't edit anything. Redirect back to the list
        if (!$majorId) {
            return $this->redirectToList();
        }

        // Find the major
        /** @var $major \Application\Entity\Major */
        $major = $entityManager->find('Application\Entity\Major', $majorId);

        if (!$major) {
            // The major couldn't be found even though the ID was present! That's a problem
            throw new Exception\InvalidArgumentException("Invalid Major ID!");
        }

        $deleteForm->setLabel(sprintf('Delete %s', $major->getName()));
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
                $entityManager->remove($major);
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
        return $this->redirect()->toRoute('major');
    }
}