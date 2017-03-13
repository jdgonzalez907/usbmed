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

class ControlController extends Controller
{
    /**
     * Acción error 400
     */
    public function error400()
    {
        View::render('control/error400', [], 'login');
    }
    
    /**
     * Acción error 403
     */
    public function error403()
    {
        
        View::render('control/error403', [], 'login');
    }
    
    /**
     * Acción error 404
     */
    public function error404()
    {
        
        View::render('control/error404', [], 'login');
    }
    
    /**
     * Acción error 500
     */
    public function error500()
    {
        View::render('control/error500', [], 'login');
    }
    
}
