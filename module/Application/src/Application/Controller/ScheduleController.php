<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        // Uncomment the following line if the database needs to be
        // rebuilt from scratch. (make sure to re-comment this when you're done!!)
        // $this->rebuildDatabase();
    }

    /**
     * Rebuilds the database and loggs out the current user
     */
    protected function rebuildDatabase()
    {
        /**
         * @var $userService   \Application\Service\User
         * @var $schemaService \Application\Service\Schema
         */
        $serviceLocator = $this->getServiceLocator();
        $userService    = $serviceLocator->get('UserService');
        $schemaService  = $serviceLocator->get('SchemaService');

        // Rebuild the database
        $schemaService->updateSchema();

        // Make sure the current user is logged out since the database
        // has been reset.
        $userService->getAuthService()->clearIdentity();
    }
}
