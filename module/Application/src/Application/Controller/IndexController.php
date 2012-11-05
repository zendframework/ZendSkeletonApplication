<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Doctrine\ORM\Tools\SchemaTool;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function generateSchemaAction()
    {
        /** @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getServiceLocator()->get('EntityManager');
        $tool = new SchemaTool($em);

        // This will scan the Application/Entity directory and automatically
        // generate the sql needed to create the tables used to store your entity data.
        $classDir        = __DIR__ . '/../Entity/';
        $classMetaArray  = array();
        $files           = scandir($classDir);
        foreach ($files as $file) {
            if (preg_match('/^(?<name>[A-Za-z]+)\.php$/', $file, $match)) {
                $className = sprintf('Application\Entity\%s', $match['name']);
                if (class_exists($className)) {
                    $classMetaArray[] = $em->getClassMetadata($className);
                }
            }
        }

        $viewModel = new ViewModel();

        if (!empty($classMetaArray)) {
            $sql = $tool->getCreateSchemaSql($classMetaArray);
            $viewModel->setVariable('sql', $sql);

            if ($this->getRequest()->isPost()) {
                $data = $this->getRequest()->getPost();

                if (isset($data['cancel'])) {
                    // If the user presses the 'cancel' button, redirect to the 'home' route.
                    return $this->redirect()->toRoute('home');
                } elseif (isset($data['submit'])) {
                    // The user chose to run the queries.
                    $tool->updateSchema($classMetaArray);
                    $viewModel->setVariable('success', true);
                }
            }
        }

        return $viewModel;
    }
}
