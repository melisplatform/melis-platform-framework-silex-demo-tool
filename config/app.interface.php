<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'plugins' => [
        'MelisPlatformFrameworkSilexDemoTool' => [
            'conf' => [
                'id' => '',
                'name' => 'tr_melisplatformsilexdemotool_tool_name',
                'rightsDisplay' => 'none',
            ],
            'ressources' => [
                'js' => [
                    '/MelisPlatformFrameworkSilexDemoTool/js/tool.js'
                ],
                'css' => [],
                /**
                 * the "build" configuration compiles all assets into one file to make
                 * lesser requests
                 */
                'build' => [
                    // configuration to override "use_build_assets" configuration, if you want to use the normal assets for this module.
                    'disable_bundle' => true,
                    // lists of assets that will be loaded in the layout
                    'css' => [
                        '/MelisPlatformFrameworkSilexDemoTool/build/css/bundle.css',
                    ],
                    'js' => [
                        '/MelisPlatformFrameworkSilexDemoTool/build/js/bundle.js',
                    ]
                ]
            ],
            'datas' => [],
            'interface' => [
                'melisplatformsilexdemotool_album_modal_container' => array(
                    'conf' => array(
                        'id' => 'id_melisplatformsilexdemotool_album_modal_container',
                        'name' => 'tr_meliscore_tool_gen_modal',
                        'melisKey' => 'melisplatformsilexdemotool_album_modal_container',
                    ),
                    'forward' => array(
                        'module' => 'MelisPlatformFrameworkSilexDemoTool',
                        'controller' => 'List',
                        'action' => 'render-tool-modal-container',
                        'jscallback' => '',
                        'jsdatas' => array()
                    ),
                    'interface' => array(
                        'melisplatformsilexdemotool_create_album_handler' => array(
                            'conf' => array(
                                'class' => 'glyphicons plus',
                                'id' => 'id_melisplatformsilexdemotool_create_album_handler',
                                'name' => 'tr_melisplatformsilexdemotool_create_album',
                                'melisKey' => 'melisplatformsilexdemotool_create_album_handler',
                            ),
                            'forward' => array(
                                'module' => 'MelisPlatformFrameworkSilexDemoTool',
                                'controller' => 'List',
                                'action' => 'render-tool-album-modal-create-handler',
                                'jscallback' => '',
                                'jsdatas' => array()
                            ),
                        ),

//                        'melisplatformsilexdemotool_edit_album_handler' => array(
//                            'conf' => array(
//                                'id' => 'id_melisplatformsilexdemotool_edit_album_handler',
//                                'name' => 'tr_melisplatformsilexdemotool_edit_album',
//                                'melisKey' => 'melisplatformsilexdemotool_edit_album_handler',
//                            ),
//                            'forward' => array(
//                                'module' => 'MelisPlatformFrameworkSilexDemoTool',
//                                'controller' => 'List',
//                                'action' => 'render-tool-album-modal-edit-handler',
//                                'jscallback' => '',
//                                'jsdatas' => array()
//                            ),
//                        ),
                    ),
                ),
            ]
        ]
    ]
];