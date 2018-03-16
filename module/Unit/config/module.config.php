<?php

namespace Unit;

use Unit\Controller\UnitController;
use Unit\Factory\UnitControllerFactory;
use Unit\Factory\UnitRepositoryFactory;
use Unit\Factory\UnitServiceFactory;
use Unit\Repository\UnitRepository;
use Unit\Service\UnitService;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'units' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/units',
                    'defaults' => [
                        'controller' => UnitController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/page/:page/limit/:limit',
                            'constraints' => [
                                'page'   => '[0-9]+',
                                'limit'  => '[0-9]+',
                            ],
                            'defaults' => [
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'add_unit' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                        'may_terminate' => true,
                    ],
                    'edit_unit' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/edit/:id',
                            'constraints' => [
                                'id'  => '[0-9]+',
                            ],
                            'defaults' => [
                                'action'     => 'edit',
                            ],
                        ],
                        'may_terminate' => true,
                    ],
                    'remove_unit' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/remove/:id',
                            'constraints' => [
                                'id'  => '[0-9]+',
                            ],
                            'defaults' => [
                                'action'     => 'remove',
                            ],
                        ],
                        'may_terminate' => true,
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            UnitController::class      => UnitControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            UnitService::class    => UnitServiceFactory::class,
            UnitRepository::class => UnitRepositoryFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'unit/unit/index'   => __DIR__ . '/../view/unit/unit/index.twig',
            'unit/unit/add'     => __DIR__ . '/../view/unit/unit/form.twig',
            'unit/unit/edit'    => __DIR__ . '/../view/unit/unit/form.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine'        => [
        'driver'        => [
            'unit_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity'],
            ],
            'orm_default'    => [
                'drivers' => [
                    'Unit\Entity' => 'unit_entities',
                ],
            ],
        ],
    ],
];
