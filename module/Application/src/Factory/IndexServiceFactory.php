<?php

namespace Application\Factory;

use Application\Controller\IndexController;
use Application\Service\IndexService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class IndexServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return IndexService|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new IndexService();
    }
}
