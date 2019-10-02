<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2017 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisPlatformFrameworkSilexDemoTool\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{
    public function renderToolAction()
    {
        $view = new ViewModel();
        return $view;
    }
    public function renderToolContentAction()
    {
        $view = new ViewModel();
        $view->melisKey = $this->getMelisKey();
        //executing the silex route by using MelisDispatchThirdPartyService
        $this->serviceLocator->get('MelisPlatformService')->setRoute('/silex-list');
        //Getting content from the silex route that has been executed and pass it to the view so that it will be displayed inside the melis platform.
        $view->silexContent = $this->serviceLocator->get('MelisPlatformService')->getContent();

        return $view;
    }
    /**
     * @return mixed
     */
    private function getMelisKey()
    {
        $melisKey = $this->params()->fromRoute('melisKey', null);

        return $melisKey;
    }
    /**
     * The parent container of all modals, this is where you initialze your modal.
     * @return \Zend\View\Model\ViewModel
     */
    public function renderToolModalContainerAction()
    {

        $id = $this->params()->fromRoute('id', $this->params()->fromQuery('id', ''));

        $melisKey = $this->getMelisKey();

        $view = new ViewModel();
        $view->setTerminal(false);
        $view->melisKey = $melisKey;
        $view->id = $id;

        return $view;
    }

    public function renderToolAlbumModalCreateHandlerAction(){

        $translator = $this->getServiceLocator()->get('translator');

        $melisKey = $this->params()->fromRoute('melisKey', '');

        $view = new ViewModel();

        $view->melisKey = $melisKey;
        $view->title = $translator->translate("tr_melisplatformsilexdemotool_create_album");

        return $view;
    }

    /**
     * @return array|object
     */
    private function tool()
    {
        $tool = $this->getServiceLocator()->get('MelisCoreTool');
        $tool->setMelisToolKey('melistoolprospects', 'melistoolprospects_tool_prospects_themes');
        return $tool;
    }
}
