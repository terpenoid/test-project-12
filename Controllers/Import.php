<?php

namespace Controllers;

use App\Controller;
use Exception;
use Models\DataSet;

/**
 * Accepts input data from file
 */
class Import extends Controller
{
    /**
     * Importing data from JSON file
     * Uses common view file (DataTableView) and direct_out() method (for maintenance the big array cases)
     *
     * @throws Exception
     */
    public function json_file($params)
    {
        if (!file_exists($params[0])) {
            throw new Exception('JSON file was not found: ' . $params[0]);
        }

        $raw_data = json_decode(file_get_contents($params[0]), true);

        if ($raw_data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('JSON file is invalid!');
        }

        if (!is_array($raw_data)) {
            throw new Exception('JSON file contains not correct data set!');
        }

        $model = new DataSet($raw_data);
        $this->direct_out('DataTableView', $model);
    }

    /**
     * Importing data from JSON file
     * Uses common view file (DataTableView) and direct_out() method (for maintenance the big array cases)
     *
     * @throws Exception
     */
    public function php_file($params)
    {
        if (!file_exists($params[0])) {
            throw new Exception('PHP file was not found: ' . $params[0]);
        }

        require $params[0];

        if (!isset($raw_data)) {
            throw new Exception('PHP file does not contains $raw_data variable!');
        }

        if (!is_array($raw_data)) {
            throw new Exception('PHP file contains not correct $raw_data variable!');
        }

        /** @var array $raw_data */
        $model = new DataSet($raw_data);
        $this->direct_out('DataTableView', $model);
    }

}