<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Application;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function consoleHelpAction()
    {
        $e = $this->getEvent();
        $e->setError(Application::ERROR_CONTROLLER_INVALID);
        $application     = $e->getApplication();
        $services        = $application->getServiceManager();
        $notFoundHandler = $services->get('RouteNotFoundStrategy');
        $notFoundHandler->setDisplayNotFoundReason(false);
        $notFoundHandler->handleRouteNotFoundError($e);
        $e->setError(null);
        return $e->getResult();
    }
}
