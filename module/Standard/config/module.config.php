<?php

namespace Standard;

return [
    'view_manager' => [
        'template_map' => [
            'macro'   => __DIR__ . '/../view/macro.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
