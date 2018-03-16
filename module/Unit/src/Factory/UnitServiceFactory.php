<?php

namespace Unit\Factory;

use Interop\Container\ContainerInterface;
use Unit\Repository\UnitRepository;
use Unit\Service\UnitService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Helper\Url;

/**
 * Class UnitServiceFactory
 *
 * @package Material\Factory
 */
class UnitServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     *
     * @return UnitService|object
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $unitRepository      = $container->get(UnitRepository::class);
        $url                 = $container->get('ViewHelperManager')->get(Url::class);

        return new UnitService($unitRepository, $url);
    }
}
