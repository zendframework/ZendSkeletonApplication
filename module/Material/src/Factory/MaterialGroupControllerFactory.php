<?php

namespace Material\Factory;

use Interop\Container\ContainerInterface;
use Material\Controller\MaterialGroupController;
use Material\Service\MaterialGroupService;
use Zend\ServiceManager\Factory\FactoryInterface;

class MaterialGroupControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return MaterialGroupController|object
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $materialGroupService = $container->get(MaterialGroupService::class);

        return new MaterialGroupController(
            $materialGroupService
        );
    }
}
