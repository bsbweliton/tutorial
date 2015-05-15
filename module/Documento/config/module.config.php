<?php
return [
    'controllers' => [
        'invokables' => [
            'Documento\Controller\Crud' => 'Documento\Controller\CrudController',
        ],
    ],
    'router' => [
        'routes' => [
            'documento' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/documento',
                    'defaults' => [
                        'controller' => 'Documento\Controller\Crud',
                        'action' => 'list',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'controller' => 'Documento\Controller\Crud',
                                'action' => 'list',
                            ],
                        ],
                    ],
                	'geraroficio' => [
                			'type' => 'Literal',
                			'options' => [
                					'route' => '/geraroficio',
                					'defaults' => [
                							'controller' => 'Documento\Controller\Crud',
                							'action' => 'geraroficio',
                					],
                			],
                	],                		
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Documento\Controller\Crud',
                                'action' => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/edit[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Documento\Controller\Crud',
                                'action' => 'edit',
                                'id' => 0,
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Documento\Controller\Crud',
                                'action' => 'delete',
                                'id' => 0,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Documento' => __DIR__.'/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'Documento_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Documento/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Documento\Entity' => 'Documento_driver',
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'documento' => [
            	'route' => 'documento/list',
            	'label' => 'Documento',            		
                        'pages' => [
                            'geraroficio' => [
                                'label' => 'Gerar Ofício',
                                'route' => 'documento/geraroficio',
                            ],
                            'add' => [
                                'label' => 'Gerar Memorando',
                                'route' => 'documento/add',
                            ],
                            'edit' => [
                                'label' => 'Gerar Despacho',
                                'route' => 'documento/edit',
                            ],
                            'delete' => [
                                'label' => 'Pesquisa administrativa',
                                'route' => 'documento/delete',
                            	'permission' => 'documento-pesquisaadmin'   
                            ],
                        ],
            ],
        ],
    ]
];
