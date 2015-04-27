<?php

/*
 * In order to load and configure a module, Zend Framework 2 has a ModuleManager. This will look for Module.php in the root of the module directory (module/Album) and expect to find a class called Album\Module within it. That is, the classes within a given module will have the namespace of the module’s name, which is the directory name of the module.
 */
namespace Album;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

// Add these import statements:
use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {
	// getAutoloaderConfig() and getConfig() methods here
	public function getAutoloaderConfig() {
		return array (
				'Zend\Loader\ClassMapAutoloader' => array (
						__DIR__ . '/autoload_classmap.php'
				),
				'Zend\Loader\StandardAutoloader' => array (
						'namespaces' => array (
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
						)
				)
		);
	}
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	/*
	 * This method returns an array of factories that are all merged together by the ModuleManager be-
	 * fore passing them to the ServiceManager.
	 * The factory for Album\Model\AlbumTable uses the
	 * ServiceManager to create an AlbumTableGateway to pass to the AlbumTable. We also tell the
	 * ServiceManager that an AlbumTableGateway is created by getting a Zend\Db\Adapter\Adapter (also
	 * from the ServiceManager) and using it to create a TableGateway object. The TableGateway is told to use
	 * an Album object whenever it creates a new result row. The TableGateway classes use the prototype pattern for cre-
	 * ation of result sets and entities. This means that instead of instantiating when required, the system clones a previously
	 * instantiated object. See PHP Constructor Best Practices and the Prototype Pattern for more details.
	 */
	public function getServiceConfig() {
		return array (
				'factories' => array (
						'Album\Model\AlbumTable' => function ($sm) {
							$tableGateway = $sm->get ( 'AlbumTableGateway' );
							$table = new AlbumTable ( $tableGateway );
							return $table;
						},
						'AlbumTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Album () );
							// TableGateway passing the database table name as bellow => album
							return new TableGateway ( 'album', $dbAdapter, null, $resultSetPrototype );
						}
				)
		);
	}
}