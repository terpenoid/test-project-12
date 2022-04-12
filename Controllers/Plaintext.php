<?php

namespace Controllers;

use App\Controller;
use Exception;
use Models\DataSet;

/**
 * Accepts input data as plain text from command line
 */
class Plaintext extends Controller
{
    /**
     * Expected data as JSON string
     * Uses common view file (DataTableView) and direct_out() method (for maintenance the big array cases)
     *
     * @throws Exception
     */
    public function json($params)
    {
        $raw_data = json_decode($params[0], true);

        if ($raw_data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('JSON string is invalid!');
        }

        if (!is_array($raw_data)) {
            throw new Exception('JSON file contains not correct data set!');
        }

        $model = new DataSet($raw_data);
        $this->direct_out('DataTableView', $model);
    }
}