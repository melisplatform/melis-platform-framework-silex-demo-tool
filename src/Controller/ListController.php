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
        $this->serviceLocator->get('MelisDispatchThirdPartyService')->setRoute('/melis-news');
        //Getting content from the silex route that has been executed and pass it to the view so that it will be displayed inside the melis platform.
        $view->silexContent = $this->serviceLocator->get('MelisDispatchThirdPartyService')->getContent();
//        $view->silexContent =  $this->getEvent()->getParam('silex');

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
}