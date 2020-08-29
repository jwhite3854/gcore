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

use Jaw\GauntCore\Router;
use Jaw\GauntCore\Controller;

class App
{
    protected static $request;
    public static $isDevMode;

     /**
     * Start the process...
     * @param $request
     * @param $is_dev_mode
     */
    public static function run( $request, $isDevMode = false )
    {
        // Set the Request object
        self::$request = $request;
        self::$isDevMode = $isDevMode;

        $controllerOutput = 'Error! Unable to Render Page.';
        try {
            // Get Controller / Action / Params from request
            $router = new Router($request->getPathInfo());
            $controllerName = $router->getController();
            $actionName = $router->getAction();
            $paramArray = $request->getQueryArray();

            // Add Namespace to have a fully qualified Controller Class name.
            $controllerClass = '\\App\\Controllers\\' . $controllerName . 'Controller';

            //Dynamically Call Controller's Method accordingly, if any Exception is thrown a Custom Page is rendered to the user.
            if ( class_exists($controllerClass) ) {
                // Create the new controller class with the action and parameters
                $controllerObject = new $controllerClass( $controllerName, $actionName, $paramArray );
                if ( method_exists($controllerObject, $actionName) ) {
                    // Get the output of the controller of the given action with the params provided
                    $controllerOutput = $controllerObject->$actionName( $paramArray );
                } else {
                    self::printError( 'Cannot find '.$controllerName.' method: '. $actionName );
                }
            } else {
                self::printError( 'Cannot find controller class: ' .$controllerClass );
            }
        } catch ( Exception $e ) {
            if ( $isDevMode ) {
                self::printException( $e );
            } 
        } finally {
            echo $controllerOutput;
        }

        exit();
    }

    /**
     * Prints exceptions for debugging
     * @param $e
     * @param $is_dev_mode
     */
    private static function printException( $e )
    {
        echo '<pre>';
        echo $e->getMessage() . "\n\n";
        echo $e->getTraceAsString();
        echo '</pre>';
    }

    /**
     * Prints error for debugging
     * @param $e
     * @param $is_dev_mode
     */
    private static function printError( $error )
    {
        echo '<pre>', $error, '</pre>';
        die();
    }

    public function getRequest()
    {
        return self::$request;
    }
}

class Registry
{
    public static function set($key, $value)
    {
        session_start();
        $_SESSION[$key] = $value;
    }

    public static function see($key)
    {
        session_start();
        return $_SESSION[$key];
    }

    public static function get($key)
    {
        session_start();
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);

        return $value;
    }
}