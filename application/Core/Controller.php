<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Core;

use Mini\Core\View;
use Mini\Core\Session;

/**
 * Description of Controller
 *
 * @author ingeniero.analista1
 */
class Controller {
    
    public $loginUrl = 'home/inciarSesion';
    
    protected function verificarPermisos()
    {
        if ( $this->verificarInicioSesion() )
        {
            if (!in_array(Application::$url_id, Session::get('permisos')))
            {
                View::redirect('error/error403');
            }
        }
      
    }
    
    protected function verificarInicioSesion()
    {
        if ( Session::isGuest() )
        {
            View::redirect($this->loginUrl);
            
            return false;
        }
        
        return true;
    }
}
