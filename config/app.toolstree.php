<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'plugins' => [
        'meliscore' => [
            'interface' => [
                'meliscore_leftmenu' => [
                    'interface' => [
                        'meliscore_toolstree_section' => [
                            'interface' => [
                                'meliscore_tool_creatrion_designs' => [
                                    'conf' => [
                                        'id' => 'id_meliscore_tool_creatrion_designs',
                                        'melisKey' => 'meliscore_tool_creatrion_designs',
                                        'name' => 'tr_meliscore_tool_creatrion_designs',
                                        'icon' => 'fa fa-paint-brush',
                                    ],
                                    'interface' => [
                                        'meliscore_tool_tools' => [
                                            'conf' => [
                                                'id' => 'id_meliscore_tool_tools',
                                                'melisKey' => 'meliscore_tool_tools',
                                                'name' => 'tr_meliscore_tool_tools',
                                                'icon' => 'fa fa-magic',
                                            ],
                                            'interface' => [
                                                'melisplatformsilexdemotool_tool' => [
                                                    'conf' => [
                                                        'id' => 'id_melisplatformsilexdemotool_tool',
                                                        'melisKey' => 'melisplatformsilexdemotool_tool',
                                                        'name' => 'tr_melisplatformsilexdemotool_title',
                                                        'icon' => 'fa fa-puzzle-piece',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'MelisPlatformFrameworkSilexDemoTool',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                    'interface' => [
                                                        'MelisPlatformFrameworkSilexDemoTool_content' => [
                                                            'conf' => [
                                                                'id' => 'id_melisplatformsilexdemotool_content',
                                                                'melisKey' => 'MelisPlatformFrameworkSilexDemoTool_content',
                                                                'name' => 'tr_melisplatformsilexdemotool_content',
                                                            ],
                                                            'forward' => [
                                                                'module' => 'MelisPlatformFrameworkSilexDemoTool',
                                                                'controller' => 'List',
                                                                'action' => 'render-tool-content',
                                                                'jscallback' => '',
                                                                'jsdatas' => []
                                                            ],
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];