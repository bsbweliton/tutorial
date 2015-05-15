<?php
return [
    'zfc_rbac' => [
        // 'identity_provider' => 'ZfcRbac\Identity\AuthenticationIdentityProvider',
        'guest_role' => 'visitante',
        'guards' => [
            'ZfcRbac\Guard\RouteGuard' => [
                'dashboard' => ['usuario'],                
                'usuario/*' => ['admin'],
            	'papel/*' => ['admin'],            		
            ],
            'ZfcRbac\Guard\RoutePermissionsGuard' => [               
				'cliente/*' => ['listarcliente'],            
            ],
        ],

        //'protection_policy' => \ZfcRbac\Guard\GuardInterface::POLICY_DENY,
        'role_provider' => [
            'ZfcRbac\Role\ObjectRepositoryRoleProvider' => [
                'object_manager'     => 'doctrine.entitymanager.orm_default',
                'class_name'         => 'Papel\Entity\Papel',
                'role_name_property' => 'name'
            ]
        ],

        'unauthorized_strategy' => [
            'template' => 'error/403'
        ],

        'redirect_strategy' => [
            'redirect_when_connected' => true,
            'redirect_to_route_connected' => 'error/403',
            'redirect_to_route_disconnected' => 'zfcuser/login',
            'append_previous_uri' => false,
            'previous_uri_query_key' => 'redirect'
        ],
        // 'guard_manager'               => [],
        // 'role_provider_manager'       => []
    ]
];
