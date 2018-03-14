<?php

namespace Material;

use Material\Controller\MaterialController;
use Material\Factory\MaterialControllerFactory;
use Material\Factory\MaterialRepositoryFactory;
use Material\Factory\MaterialServiceFactory;
use Material\Repository\MaterialRepository;
use Material\Service\MaterialService;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'material' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/material[/:action]',
                    'defaults' => [
                        'controller' => MaterialController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            MaterialController::class => MaterialControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            MaterialService::class    => MaterialServiceFactory::class,
            MaterialRepository::class => MaterialRepositoryFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'material/material/index' => __DIR__ . '/../view/material/material/index.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
