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
use Zend\Mvc\MvcEvent;

class RenderSilexListener implements ListenerAggregateInterface
{
    public function attach(EventManagerInterface $events)
    {
        $callBackHandler = $events->attach(
            MvcEvent::EVENT_DISPATCH,
            function(MvcEvent $e) {
                $request = $e->getRequest();
                $cpath = $request->getQuery('cpath') ?? null;
                $silexContent = null;

                //run only if the silex module is requested.
                if ($cpath === 'meliscodeexamplesilex_tool') {


                    //getting silex application
                    $silex = require_once __DIR__ . "/../../../../../thirdparty/framework/silex/web/index.php";

                    //getting selix content
                    $response = $silex['statusCode'];
                    if ($response != Response::HTTP_NOT_FOUND && $response != Response::HTTP_INTERNAL_SERVER_ERROR) {
                        $silexContent = $silex['content'];
                    }

                    //putting silex content on event param
                    $e->setParam('silex',$silexContent);
                }
            },100);

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