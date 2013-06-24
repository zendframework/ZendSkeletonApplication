<?php

namespace ApplicationTest\Controller;

use ApplicationTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    protected $controller;

    protected function setUp()
    {
        $serviceManager   = Bootstrap::getServiceManager();
        $this->controller = new IndexController();

        // Load the user-defined test configuration file, if it exists; otherwise, load the dist
        if (is_readable(__DIR__ . '/../../TestConfig.php')) {
            $testConfig = include __DIR__ . '/../../TestConfig.php';
        } else {
            $testConfig = include __DIR__ . '/../../TestConfig.php.dist';
        }

        $this->setApplicationConfig($testConfig);

        parent::setUp();
    }

    public function testIsEventManagerAware()
    {
        $this->assertInstanceOf('Zend\EventManager\EventManagerAwareInterface', $this->controller);
    }

    public function testIsDispatchable()
    {
        $this->assertInstanceOf('Zend\Stdlib\DispatchableInterface', $this->controller);
    }

    public function testIsEventInjectable()
    {
        $this->assertInstanceOf('Zend\Mvc\InjectApplicationEventInterface', $this->controller);
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/');

        $this->assertResponseStatusCode(200);

        $this->assertActionName('index');
        $this->assertModuleName('Application');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');
    }
}
