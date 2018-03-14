<?php

namespace Material\Factory;

use Interop\Container\ContainerInterface;
use Material\Controller\MaterialController;
use Material\Service\MaterialService;
use Zend\ServiceManager\Factory\FactoryInterface;

class MaterialControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return MaterialController|object
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $materialService = $container->get(MaterialService::class);

        return new MaterialController(
            $materialService
        );
    }
}
