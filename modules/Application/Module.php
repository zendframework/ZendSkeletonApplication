<?php

namespace Application;

use InvalidArgumentException,
    Zend\Module\Manager,
    Zend\Config\Config,
    Zend\Di\Locator,
    Zend\EventManager\EventCollection,
    Zend\EventManager\StaticEventCollection;

class Module
{
    protected $appListeners    = array();
    protected $staticListeners = array();
    protected $viewListener;

    public function init(Manager $moduleManager)
    {
        $this->initAutoloader($moduleManager->getOptions()->getApplicationEnv());
    }

    protected function initAutoloader($env = null)
    {
        require __DIR__ . '/autoload_register.php';
    }

    public static function getConfig()
    {
        return new Config(include __DIR__ . '/configs/module.config.php');
    }
    
    public function registerApplicationListeners(EventCollection $events, Locator $locator, Config $config)
    {
        $view          = $locator->get('view');
        $viewListener  = $this->getViewListener($view, $config);
        $events->attachAggregate($viewListener);
    }

    public function registerStaticListeners(StaticEventCollection $events, Locator $locator, Config $config)
    {
        $view         = $locator->get('view');
        $viewListener = $this->getViewListener($view, $config);

        $viewListener->registerStaticListeners($events, $locator);
    }

    protected function getViewListener($view, $config)
    {
        if ($this->viewListener instanceof View\Listener) {
            return $this->viewListener;
        }

        $viewListener       = new View\Listener($view, $config->layout);
        $viewListener->setDisplayExceptionsFlag($config->display_exceptions);

        $this->viewListener = $viewListener;
        return $viewListener;
    }
}
