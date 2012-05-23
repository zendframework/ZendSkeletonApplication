ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.


Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use composer to install dependencies:

    cd my/project/dir
    git clone git://github.com/zendframework/ZendSkeletonApplication.git
    cd ZendSkeletonApplication
    php composer.phar install

Using Git submodules
--------------------
Alternatively, you can install using native git submodules. This method works fine but it is
recommended that you use Composer due to the dependency management it provides.

    git clone git://github.com/zendframework/ZendSkeletonApplication.git --recursive

You will also need to update public/index.php and modules/Application/Module.php to enable autoloading.
For public/index.php, replace lines 2-13 with:

    use Zend\Loader\AutoloaderFactory,
        Zend\ServiceManager\ServiceManager,
        Zend\Mvc\Service\ServiceManagerConfiguration;

    chdir(dirname(__DIR__));
    require_once (getenv('ZF2_PATH') ?: 'vendor/ZendFramework/library') . '/Zend/Loader/AutoloaderFactory.php';

    // Setup autoloader
    AutoloaderFactory::factory();

Within modules/Application/Module.php add this method to the Application class:

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

Virtual Host
------------
Afterwards, set up a virtual host to point to the public/ directory of the
project and you should be ready to go!
