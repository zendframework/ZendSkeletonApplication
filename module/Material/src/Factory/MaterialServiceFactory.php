<?php

namespace Material\Factory;

use Interop\Container\ContainerInterface;
use Material\Repository\MaterialRepository;
use Material\Service\MaterialService;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MaterialServiceFactory
 *
 * @package Material\Factory
 */
class MaterialServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return MaterialService|object
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $materialRepository = $container->get(MaterialRepository::class);

        return new MaterialService($materialRepository);
    }
}
