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
    
    protected function verificarPermisos()
    {
        if ( !Session::isGuest() )
        {
            if ( Session::get('permisos') )
            {
                
            }else{
                View::redirect('error/error403');
            }
        }else{
            View::redirect('error/error403');
        }
    }
}
