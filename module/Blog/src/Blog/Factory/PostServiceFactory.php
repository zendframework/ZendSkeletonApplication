<?php
// Filename: /module/Blog/src/Blog/Factory/PostServiceFactory.php
namespace Blog\Factory;

use Blog\Service\PostService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PostService($serviceLocator->get('Blog\Mapper\PostMapperInterface'));
    }
}