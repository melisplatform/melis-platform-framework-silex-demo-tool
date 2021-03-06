<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'third-party-framework' => [
        'index-path' => [
            '/Silex/web/index.php'
        ],
        'translations' => [
            'locale' => [
                'en_EN' => [
                    __DIR__ .'/../../melis-platform-framework-silex-demo-tool-logic/src/Translations/en_EN.interface.php'
                ],
                'fr_FR' => [
                    __DIR__ .'/../../melis-platform-framework-silex-demo-tool-logic/src/Translations/fr_FR.interface.php'
                ]
            ],
        ],

    ],
    'router' => [
        'routes' => [
        	'melis-backoffice' => [
                'child_routes' => [
                    'application-MelisPlatformFrameworkSilexDemoTool' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => 'MelisPlatformFrameworkSilexDemoTool',
                            'defaults' => [
                                '__NAMESPACE__' => 'MelisPlatformFrameworkSilexDemoTool\Controller',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'default' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'    => '/[:controller[/:action]]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ],
                                    'defaults' => [
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
        	],
        ],
    ],
    'translator' => [
        'locale' => 'en_EN',
    ],
    'service_manager' => [
        'aliases' => [
            'translator' => 'MvcTranslator',
        ],
        'factories' => [
        ],
    ],
    'controllers' => [
        'invokables' => [
            'MelisPlatformFrameworkSilexDemoTool\Controller\List' => 'MelisPlatformFrameworkSilexDemoTool\Controller\ListController',
        ],
    ],
    'controller_plugins' => array(
        'invokables' => array(
            'SilexDemoToolPlugin' => 'MelisPlatformFrameworkSilexDemoTool\Controller\Plugin\SilexDemoToolPlugin',
        )
    ),
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => [
            'MelisPlatformFrameworkSilexDemoTool/demotool' => __DIR__ . '/../view/melis-platform-framework-silex-demo-tool/plugins/demotool.phtml',
            'MelisPlatformFrameworkSilexDemoTool/demotool/melis/form' => __DIR__ . '/../view/melis-platform-framework-silex-demo-tool/plugins/form.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
