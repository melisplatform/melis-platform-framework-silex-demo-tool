<?php

return array(
    'plugins' => array(
        'melisplatformframeworksilexdemotool' => array(
            'conf' => array(
                // user rights exclusions
                'rightsDisplay' => 'none',
            ),
            'plugins' => array(
                'SilexDemoToolPlugin' => array(
                    'front' => array(
                        'template_path' => array('MelisPlatformFrameworkSilexDemoTool/demotool'),
                        'id' => 'demotool',
                        'demoToolId' => 1,
                        
                        // List the files to be automatically included for the correct display of the plugin
                        // To overide a key, just add it again in your site module
                        // To delete an entry, use the keyword "disable" instead of the file path for the same key
                        'files' => array(
                            'css' => array(
                            ),
                            'js' => array(
                            ),
                        ),
                    ),
                    'melis' => array(
                        'name' => 'tr_melisplatformsilexdemotool_plugin_name',
                        'thumbnail' => '/MelisPlatformFrameworkSilexDemoTool/plugins/images/demotool_thumb.JPG',
                        'description' => 'tr_melisplatformsilexdemotool_plugin_Description',
                        'files' => array(
                            'css' => array(
                            ),
                            'js' => array(
                            ),
                        ),
                        'js_initialization' => array(),
                        'modal_form' => array(
                            'cms_slider_plugin_tab_01' => array(
                                'tab_title' => 'tr_front_plugin_tab_properties',
                                'tab_icon'  => 'fa fa-cog',
                                'tab_form_layout' => 'MelisPlatformFrameworkSilexDemoTool/demotool/melis/form',
                                'attributes' => array(
                                    'name' => 'cms_demotool_plugin_tab_01',
                                    'id' => 'cms_demotool_plugin_tab_01',
                                    'method' => '',
                                    'action' => '',
                                ),
                                'hydrator'  => 'Zend\Stdlib\Hydrator\ArraySerializable',
                                'elements' => array(
                                    array(
                                        'spec' => array(
                                            'name' => 'template_path',
                                            'type' => 'MelisEnginePluginTemplateSelect',
                                            'options' => array(
                                                'label' => 'tr_melis_Plugins_Template',
                                                'tooltip' => 'tr_melis_Plugins_Template tooltip',
                                                'empty_option' => 'tr_melis_Plugins_Choose',
                                                'disable_inarray_validator' => true,
                                            ),
                                            'attributes' => array(
                                                'id' => 'id_page_tpl_id',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                            ),
                                        ),
                                    ),

                                ),
                                'input_filter' => array(
                                    'template_path' => array(
                                        'name'     => 'template_path',
                                        'required' => true,
                                        'validators' => array(
                                            array(
                                                'name' => 'NotEmpty',
                                                'options' => array(
                                                    'messages' => array(
                                                        \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_front_template_path_empty',
                                                    ),
                                                ),
                                            ),
                                        ),
                                        'filters'  => array(
                                        ),
                                    ),
                                )
                            )
                        )
                    ),
                ),
             ),
        ),
     ),
);