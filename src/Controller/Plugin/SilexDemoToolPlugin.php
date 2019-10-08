<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisPlatformFrameworkSilexDemoTool\Controller\Plugin;

use MelisEngine\Controller\Plugin\MelisTemplatingPlugin;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
/**
 *
 */
class SilexDemoToolPlugin extends MelisTemplatingPlugin
{

    public function __construct($updatesPluginConfig = array())
    {
        $this->configPluginKey = 'melisplatformframeworksilexdemotool';
        $this->pluginXmlDbKey = 'MelisPlatformFrameworkSilexDemoTool';
        parent::__construct($updatesPluginConfig);
    }
    
    /**
     * This function gets the datas and create an array of variables
     * that will be associated with the child view generated.
     */
    public function front()
    {

        // Get the parameters and config from $this->pluginFrontConfig (default > hardcoded > get > post)
        $id   = isset($this->pluginFrontConfig['demoToolId']) ? $this->pluginFrontConfig['demoToolId'] : null;

        //executing the silex route by using MelisDispatchThirdPartyService
        $this->getServiceLocator()->get('MelisPlatformService')->setRoute('/melis/silex-plugin');
        //Getting content from the silex route that has been executed and pass it to the view so that it will be displayed inside the melis platform.
        $silexContent = $this->getServiceLocator()->get('MelisPlatformService')->getContent();

        /*
         * construct view variables
         */
        $pluginData = $this->getFormData();
        // get preview mode
        $pluginData['previewMode'] = $this->previewMode;
        // get render mode
        $pluginData['renderMode'] = $this->renderMode;

        // Create an array with the variables that will be available in the view
        $viewVariables = array(
            'pluginId' => $this->pluginFrontConfig['id'],
            'silexContent' => $silexContent,
            'pluginData'   => $pluginData

        );
        
        // return the variable array and let the view be created
        return $viewVariables;
    }

    /**
     * This function generates the form displayed when editing the parameters of the plugin
     * @return array
     */
    public function createOptionsForms()
    {
        // construct form
        $factory = new \Zend\Form\Factory();
        $formElements = $this->getServiceLocator()->get('FormElementManager');
        $factory->setFormElementManager($formElements);
        $formConfig = $this->pluginBackConfig['modal_form'];

        $response = [];
        $render   = [];
        if (!empty($formConfig)) {
            foreach ($formConfig as $formKey => $config) {
                $form = $factory->createForm($config);
                $request = $this->getServiceLocator()->get('request');
                $parameters = $request->getQuery()->toArray();

                if (!isset($parameters['validate'])) {

                    $form->setData($this->getFormData());
                    $viewModelTab = new ViewModel();
                    $viewModelTab->setTemplate($config['tab_form_layout']);
                    $viewModelTab->modalForm = $form;
                    $viewModelTab->formData   = $this->getFormData();
                    $viewRender = $this->getServiceLocator()->get('ViewRenderer');
                    $html = $viewRender->render($viewModelTab);
                    array_push($render, [
                            'name' => $config['tab_title'],
                            'icon' => $config['tab_icon'],
                            'html' => $html
                        ]
                    );
                }
                else {

                    // validate the forms and send back an array with errors by tabs
                    $post = get_object_vars($request->getPost());
                    $success = false;
                    $form->setData($post);

                    $errors = array();
                    if ($form->isValid()) {
                        $data = $form->getData();
                        $success = true;
                        array_push($response, [
                            'name' => $this->pluginBackConfig['modal_form'][$formKey]['tab_title'],
                            'success' => $success,
                        ]);
                    } else {
                        $errors = $form->getMessages();

                        foreach ($errors as $keyError => $valueError) {
                            foreach ($config['elements'] as $keyForm => $valueForm) {
                                if ($valueForm['spec']['name'] == $keyError &&
                                    !empty($valueForm['spec']['options']['label'])
                                )
                                    $errors[$keyError]['label'] = $valueForm['spec']['options']['label'];
                            }
                        }


                        array_push($response, [
                            'name' => $this->pluginBackConfig['modal_form'][$formKey]['tab_title'],
                            'success' => $success,
                            'errors' => $errors,
                            'message' => '',
                        ]);
                    }

                }
            }
        }

        if (!isset($parameters['validate'])) {
            return $render;
        }
        else {
            return $response;
        }

    }

    /**
     * Returns the data to populate the form inside the modals when invoked
     * @return array|bool|null
     */
    public function getFormData()
    {
        $datas = parent::getFormData();
        
        return $datas;
    }

    /**
     * This method will decode the XML in DB to make it in the form of the plugin config file
     * so it can overide it. Only front key is needed to update.
     * The part of the XML corresponding to this plugin can be found in $this->pluginXmlDbValue
     */
    public function loadDbXmlToPluginConfig()
    {
        $configValues = array();

        $xml = simplexml_load_string($this->pluginXmlDbValue);
        if ($xml)
        {

            if (!empty($xml->template_path))
                $configValues['template_path'] = (string)$xml->template_path;

            if (!empty($xml->sliderId))
                $configValues['sliderId'] = (string)$xml->sliderId;
        }

        return $configValues;
    }

    /**
     * This method saves the XML version of this plugin in DB, for this pageId
     * Automatically called from savePageSession listenner in PageEdition
     */
    public function savePluginConfigToXml($parameters)
    {
        $xmlValueFormatted = '';

        // template_path is mendatory for all plugins
        if (!empty($parameters['template_path']))
            $xmlValueFormatted .= "\t\t" . '<template_path><![CDATA[' . $parameters['template_path'] . ']]></template_path>';

        if(!empty($parameters['sliderId']))
            $xmlValueFormatted .= "\t\t" . '<sliderId><![CDATA[' . $parameters['sliderId'] . ']]></sliderId>';

        // for resizing
        $widthDesktop = null;
        $widthMobile   = null;
        $widthTablet  = null;
        if (! empty($parameters['melisPluginDesktopWidth'])) {
            $widthDesktop =  " width_desktop=\"" . $parameters['melisPluginDesktopWidth'] . "\" ";
        }
        if (! empty($parameters['melisPluginMobileWidth'])) {
            $widthMobile =  "width_mobile=\"" . $parameters['melisPluginMobileWidth'] . "\" ";
        }
        if (! empty($parameters['melisPluginTabletWidth'])) {
            $widthTablet =  "width_tablet=\"" . $parameters['melisPluginTabletWidth'] . "\" ";
        }

        // Something has been saved, let's generate an XML for DB
        $xmlValueFormatted = "\t" . '<' . $this->pluginXmlDbKey . ' id="' . $parameters['melisPluginId'] . '"' .$widthDesktop . $widthMobile . $widthTablet . '>' .
            $xmlValueFormatted .
            "\t" . '</' . $this->pluginXmlDbKey . '>' . "\n";

        return $xmlValueFormatted;
    }
}
