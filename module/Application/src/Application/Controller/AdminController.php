<?php

namespace Application\Controller;

use Application\Entity\Administrator;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;

class AdminController extends AbstractActionController
{
    /**
     * Since this runs before anything else, it's a good time to check
     * if the user is allowed to be here.
     *
     * @param \Zend\Mvc\MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {
        /** @var $auth \ZfcUser\Controller\Plugin\ZfcUserAuthentication */
        $auth = $this->zfcUserAuthentication();
        $identity = $auth->getIdentity();

        // only administrators can use this controller
        /*
        if (!$identity instanceof Administrator) {
            return $this->redirect()->toRoute('home');
        }
        */

        return parent::onDispatch($e);
    }

    /**
     * @return array|void
     */
    public function indexAction()
    {
    }

    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function updateSchemaAction()
    {
        /**
         * @var $schemaService \Application\Service\Schema
         * @var $request       \Zend\Http\Request
         */
        $request        = $this->getRequest();
        $serviceLocator = $this->getServiceLocator();
        $schemaService  = $serviceLocator->get('SchemaService');
        $sqlCommands    = $schemaService->getUpdateSchemaSql();
        $viewModel      = new ViewModel();
        $viewModel->setVariable('sql', $sqlCommands);

        if ($request->getPost('cancel')) {
            return $this->redirect()->toRoute('application/default', array(
                'controller' => 'admin',
                'action'     => 'index'
            ));
        } elseif ($request->getPost('submit')) {
            $schemaService->updateSchema();
            $viewModel->setVariable('success', true);
        }

        return $viewModel;
    }
}