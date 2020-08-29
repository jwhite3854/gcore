<?php
/**
 * Proprietary and confidential
 * Copyright (c) jWhite3854 2020 - All Rights Reserved.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 *
 * @copyright 2020
 */
declare(strict_types=1);

namespace Jaw\GauntCore;

class Router
{
    protected $controller;      // Request controller
    protected $action;          // Request action

    /**
     * Router constructor.
     * @param $uri
     */
    public function __construct(&$uri)
    {
        //Load Defaults
        $this->controller = 'home';
        $this->action = 'index';

        // Get the real $uri set in routes config
        if ( !empty(APP_REDIRECT_BASE) && APP_REDIRECT_BASE !== '/' ) {
            $uri = str_replace( APP_REDIRECT_BASE, '', $uri );
        }

        // If uri is empty, we're either on the homepage or an error has occurred
        if ( $uri === '/' ) {
            return;
        }

        $routes = self::getKeyedRoutes();

        // If uri is found in array of established routes, set the controller/action
        if ( array_key_exists( $uri, $routes ) ) {
            $this->controller = $routes[$uri]['controller'];
            $this->action = $routes[$uri]['action'];
        } else {
            $this->action = 'error404';
        }
    }
    
    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Gets all routes for the app
     */
    public static function getKeyedRoutes()
    {
        require APP_ROOT.'/config/routes.php';

        $keyedRoutes = [];
        foreach ( $routes as $route ) {
            list($uri, $controller, $action, $isVisible) = $route;
            $key = trim($uri, '/');
            $keyedRoutes[$key] = [
                'controller' => $controller,
                'action' => $action,
                'visible' => $isVisible
            ];
        }

        return $keyedRoutes;
    }

    public static function redirect( $uri, $params = array() )
    {
        header( 'Location: ' . Url::render( $uri, $params ) );
    }
}