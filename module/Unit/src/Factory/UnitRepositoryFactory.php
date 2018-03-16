<?php

namespace Unit\Factory;

use Interop\Container\ContainerInterface;
use Unit\Repository\UnitRepository;
use Unit\Service\UnitService;
use Zend\ServiceManager\Factory\FactoryInterface;

class UnitRepositoryFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return object|UnitRepository
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new UnitRepository(
            $entityManager
        );
    }
}
