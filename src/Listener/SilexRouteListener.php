<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisPlatformFrameworkSilexDemoTool\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
/*
 * This Listener lets you visit the silex route outside the Melis Platform
 */
class SilexRouteListener implements ListenerAggregateInterface
{
    public function attach(EventManagerInterface $events)
    {
        $callBackHandler = $events->attach(
            MvcEvent::EVENT_DISPATCH_ERROR,
            function(MvcEvent $e) {
                $error  = $e->getError();
                if ($error == Application::ERROR_ROUTER_NO_MATCH){

                    //getting silex application
                    $silex = require_once __DIR__ . "/../../../../../thirdparty/framework/silex/web/index.php";

                    //checking if the route is found in Silex, if found return the content if silex route
                    $response = $silex['statusCode'];
                    if ($response != Response::HTTP_NOT_FOUND && $response != Response::HTTP_INTERNAL_SERVER_ERROR) {
                        echo $silex['content'];
                        // set zend template error
                        $viewModel = $e->getViewModel();
                        die;
                    }
                }
            },1);

        $this->listeners[] = $callBackHandler;
    }
    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
}