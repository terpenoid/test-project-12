<?php

use App\Kernel;
use App\Router;

/**
 * Service Locator for storing application components.
 * As because we have a simple MVC application, we simply save the application components
 * in static properties to make them easier to access.
 * Also registers class loader and exception handler.
 */
class App
{
    public static $router;
    public static $kernel;

    public static function init()
    {
        spl_autoload_register(['static', 'loadClass']);
        static::bootstrap();
        set_exception_handler(['App', 'handleException']);
    }

    public static function bootstrap()
    {
        static::$router = new Router();
        static::$kernel = new Kernel();
    }

    public static function loadClass($className)
    {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOT_PATH . DIRECTORY_SEPARATOR . $className . '.php';
    }

    public static function handleException(Throwable $e)
    {
        print 'ERROR: ' . $e->getMessage() . PHP_EOL;
        print 'please read the manual - run this script (usually it calls `console.php`) without any parameters' . PHP_EOL;
    }
}