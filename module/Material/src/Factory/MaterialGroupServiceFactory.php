<?php

namespace Material\Factory;

use Interop\Container\ContainerInterface;
use Material\Repository\MaterialGroupRepository;
use Material\Repository\MaterialRepository;
use Material\Service\MaterialGroupService;
use Material\Service\MaterialService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Helper\Url;

/**
 * Class MaterialGroupServiceFactory
 *
 * @package Material\Factory
 */
class MaterialGroupServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return MaterialGroupService|object
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $materialGroupRepository = $container->get(MaterialGroupRepository::class);
        $url                     = $container->get('ViewHelperManager')->get(Url::class);

        return new MaterialGroupService($materialGroupRepository, $url);
    }
}
