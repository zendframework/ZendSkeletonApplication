<?php

namespace Material\Factory;

use Interop\Container\ContainerInterface;
use Material\Repository\MaterialGroupRepository;
use Material\Repository\MaterialRepository;
use Material\Service\MaterialService;
use Zend\ServiceManager\Factory\FactoryInterface;

class MaterialGroupRepositoryFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return MaterialGroupRepository|object
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new MaterialGroupRepository(
            $entityManager
        );
    }
}
