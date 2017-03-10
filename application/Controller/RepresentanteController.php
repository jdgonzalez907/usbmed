<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\View;

/**
 * Description of RepresentanteController
 *
 * @author ingeniero.analista1
 */
class RepresentanteController extends Controller
{
    public function index()
    {
        
    }
    
    public function registrarPostulacion()
    {
        $this->verificarPermisos();
    }
}
