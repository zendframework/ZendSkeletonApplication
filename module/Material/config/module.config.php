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
            'materials' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/materials',
                    'defaults' => [
                        'controller' => MaterialController::class,
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
                    'add_material' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                        'may_terminate' => true,
                    ],
                    'edit_material' => [
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
                    'remove_material' => [
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
            'material/material/index'   => __DIR__ . '/../view/material/material/index.twig',
            'material/material/add'     => __DIR__ . '/../view/material/material/form.twig',
            'material/material/edit'    => __DIR__ . '/../view/material/material/form.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine'        => [
        'driver'        => [
            'material_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity'],
            ],
            'orm_default'    => [
                'drivers' => [
                    'Material\Entity' => 'material_entities',
                ],

            ],
        ],
    ],
];
