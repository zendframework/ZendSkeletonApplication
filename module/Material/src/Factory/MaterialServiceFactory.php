<?php

namespace Material\Factory;

use Interop\Container\ContainerInterface;
use Material\Repository\MaterialGroupRepository;
use Material\Repository\MaterialRepository;
use Material\Service\MaterialService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Helper\Url;

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
        $materialRepository      = $container->get(MaterialRepository::class);
        $materialGroupRepository = $container->get(MaterialGroupRepository::class);
        $url                     = $container->get('ViewHelperManager')->get(Url::class);

        return new MaterialService($materialRepository, $materialGroupRepository, $url);
    }
}
