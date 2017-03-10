<?php

/**
 * Class Error
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\View;

class ErrorController extends Controller
{
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function error404()
    {
        // load views
        View::render('error/error404', [], 'login');
    }
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function error403()
    {
        // load views
        View::render('error/error403', [], 'login');
    }
}
