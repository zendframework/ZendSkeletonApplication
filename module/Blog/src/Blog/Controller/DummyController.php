<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DummyController extends AbstractActionController
{
    public function indexAction()
    {
        echo __METHOD__;
        return new ViewModel();
    }
    
    public function saveAction()
    {
        echo __METHOD__;
        return new ViewModel();
    }
    
    
    public function editAction()
    {
        echo __METHOD__;
        return new ViewModel();
    }
    
}
