<?php
namespace Application;

use Zend\Di\Configuration as DiConfiguration,
    Zend\Di\Di,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Manager as ModuleManager,
    Zend\Mvc\Application,
    Zend\Mvc\Router\Http\TreeRouteStack as Router;

class Bootstrap
{
    /**
     * @var \Zend\Config\Config
     */
    protected $config;

    /**
     * @var ModuleManager
     */
    protected $modules;

    public function __construct(ModuleManager $modules)
    {
        $this->modules = $modules; 
        $this->config  = $modules->getMergedConfig();
    }

    public function bootstrap(Application $app)
    {
        $this->setupLocator($app);
        $this->setupRoutes($app);
        $this->setupEvents($app);
    }

    protected function setupLocator(Application $app)
    {
        $di = new Di;
        $di->instanceManager()->addTypePreference('Zend\Di\Locator', $di);

        $config = new DiConfiguration($this->config->di);
        $config->configure($di);

        $app->setLocator($di);
    }

    protected function setupRoutes(Application $app)
    {
        $router = new Router();
        $router->addRoutes($this->config->routes);
        $app->setRouter($router);
    }

    protected function setupEvents(Application $app)
    {
        $view         = $this->getView($app);
        $locator      = $app->getLocator();
        $events       = $app->events();
        $staticEvents = StaticEventManager::getInstance();

        foreach ($this->modules->getLoadedModules() as $name => $module) {
            if (method_exists($module, 'registerApplicationListeners')) {
                $module->registerApplicationListeners($events, $locator, $this->config);
            }

            if (method_exists($module, 'registerStaticListeners')) {
                $module->registerStaticListeners($staticEvents, $locator, $this->config);
            }
        }
    }

    protected function getView($app)
    {
        $di     = $app->getLocator();
        $view   = $di->get('view');
        $url    = $view->plugin('url');
        $url->setRouter($app->getRouter());

        $view->plugin('headTitle')->setSeparator(' - ')
                                  ->setAutoEscape(false)
                                  ->append('Application');
        return $view;
    }
}
