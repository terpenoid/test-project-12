<?php

namespace App;

/**
 * A base class for all controllers.
 * Has two methods for generating output - direct out and rendering via buffering.
 */
class Controller
{
    /**
     * @param string $viewName
     * @param Model|null $model
     * @param array $params
     * @return bool
     */
    public function direct_out(string $viewName, Model $model = null, array $params = []): bool
    {
        $viewFile = ROOT_PATH . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $viewName . '.php';
        extract($params);
        require $viewFile;
        return true;
    }

    /**
     * @param string $viewName
     * @param Model|null $model
     * @param array $params
     * @param bool $renderOnly
     * @return bool|string
     */
    public function render(string $viewName, Model $model = null, array $params = [], bool $renderOnly = false)
    {
        $viewFile = ROOT_PATH . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $viewName . '.php';
        extract($params);
        ob_start();
        require $viewFile;
        $body = ob_get_clean();
        ob_end_clean();
        if ($renderOnly) {
            return $body;
        } else {
            print $body;
            return true;
        }
    }

}