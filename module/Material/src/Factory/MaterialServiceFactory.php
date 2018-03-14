<?php

namespace Material\Factory;

use Interop\Container\ContainerInterface;
use Material\Service\MaterialService;
use Zend\ServiceManager\Factory\FactoryInterface;

class MaterialServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return MaterialService|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new MaterialService();
    }
}
