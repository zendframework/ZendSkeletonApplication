<?php

namespace Unit\Factory;

use Interop\Container\ContainerInterface;
use Unit\Controller\UnitController;
use Unit\Service\UnitService;
use Zend\ServiceManager\Factory\FactoryInterface;

class UnitControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return UnitController|object
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $unitService = $container->get(UnitService::class);

        return new UnitController(
            $unitService
        );
    }
}
