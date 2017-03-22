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
 * Description of HomeController
 *
 * @author ingeniero.analista1
 */
class HomeController extends Controller{
    
    public function index()
    {
        $this->verificarInicioSesion();
        View::render('home/index', [], 'menu_top');
    }
    
    public function contacto()
    {
        
    }
}
