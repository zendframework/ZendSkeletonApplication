<?php

namespace Material\Factory;

use Interop\Container\ContainerInterface;
use Material\Repository\MaterialRepository;
use Material\Service\MaterialService;
use Zend\ServiceManager\Factory\FactoryInterface;

class MaterialRepositoryFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return MaterialService|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {

        dump($container);exit;

        return new MaterialRepository();
    }
}
