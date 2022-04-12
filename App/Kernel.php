<?php

namespace App;

use App;
use Exception;

/**
 * Access the router and start the controller.
 * Can throw an exception if it does not have the required controller or method.
 */
class Kernel
{
    /**
     * By default, script show the manual page
     */
    public $defaultControllerName = 'man';
    public $defaultActionName = "index";

    /**
     * Call Router for current pair - Controller+Action
     * and then launch it with params.
     * Throws an exception if it does not have the required controller or action (handles exceptions from launcher).
     *
     * @throws Exception
     */
    public function launch($argv)
    {
        list($controllerName, $actionName, $params) = App::$router->resolve($argv);
        $this->launchAction($controllerName, $actionName, $params);
    }

    /**
     * Launcher. If Controller/Action doesn't present - uses default-values.
     * Throws an exception if it does not have the required controller or action.
     *
     * @throws Exception
     */
    public function launchAction($controllerName, $actionName, $params)
    {
        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName);
        if (!file_exists(ROOT_PATH . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php')) {
            throw new Exception('Controller class file was not found: ' . ROOT_PATH . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php');
        }

        require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php';
        if (!class_exists("\\Controllers\\" . ucfirst($controllerName))) {
            throw new Exception('Valid class was not found: ' . "\\Controllers\\" . ucfirst($controllerName));
        }

        $controllerName = "\\Controllers\\" . ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)) {
            throw new Exception('Valid action was not found: ' . $actionName);
        }

        $controller->$actionName($params);
    }

}