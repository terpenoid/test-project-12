<?php

namespace App;

use App;

/**
 * Simple router. Expects params in next order: <controller> <action> [extra params]
 * If params does not exist - uses the default values
 */
class Router
{
    public function resolve ($argv): array
    {
        if (count($argv) == 1) {
            $result = [App::$kernel->defaultControllerName, App::$kernel->defaultActionName, []];
        } else {
            $result = array_slice($argv, 1, 2);
            $result[2] = array_slice($argv, 3);
        }
        return $result;
    }
}