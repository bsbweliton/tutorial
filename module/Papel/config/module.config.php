<?php
return [
    'controllers' => [
        'invokables' => [
            'Papel\Controller\Crud' => 'Papel\Controller\CrudController',
        ],
    ],
    'router' => [
        'routes' => [
            'papel' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/papel',
                    'defaults' => [
                        'controller' => 'Papel\Controller\Crud',
                        'action' => 'list'
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'controller' => 'Papel\Controller\Crud',
                                'action' => 'list'
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Papel\Controller\Crud',
                                'action' => 'add'
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/edit[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => 'Papel\Controller\Crud',
                                'action' => 'edit',
                                'id' => 0
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => 'Papel\Controller\Crud',
                                'action' => 'delete',
                                'id' => 0
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Papel' => __DIR__.'/../view'
        ],
    ],
    'doctrine' => [
        'driver' => [
            'Papel_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Papel/Entity'
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Papel\Entity' => 'Papel_driver'
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'configuracao' => [
                'pages' => [
                    'papel' => [
                        'label' => 'Papel',
                        'route' => 'papel/list',
                    	'permission' => 'admin',                    		
                        'pages' => [
                            'list' => [
                                'label' => 'Listar',
                                'route' => 'papel/list'
                            ],
                            'add' => [
                                'label' => 'Adicionar',
                                'route' => 'papel/add'
                            ],
                            'edit' => [
                                'label' => 'Editar',
                                'route' => 'papel/edit'
                            ],
                            'delete' => [
                                'label' => 'Apagar',
                                'route' => 'papel/delete'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
