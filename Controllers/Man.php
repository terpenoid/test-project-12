<?php

namespace Controllers;

use App\Controller;

/**
 * Manual page.
 *
 * The current version has only one manual page. Can be extended.
 */
class Man extends Controller
{
    public function index()
    {
        $this->render('ManIndexView');
    }
}