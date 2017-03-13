<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\Session;
use Mini\Core\View;

use Mini\Model\Usuario;

/**
 * Description of UsuarioController
 *
 * @author ingeniero.analista1
 */
class UsuarioController extends Controller{
    
    public function iniciarSesion(string $modulo) 
    {
        $alerta = null;
        
        $model = new Usuario();
        
        if ( isset($_POST["Usuario"]) )
        {
            $model->setCEDULA($_POST["Usuario"]["CEDULA"]);
            $model->setCLAVE($_POST["Usuario"]["CLAVE"]);
            
            if ( $model->existeInfo() )
            {
                $info = $model->getInfoPorClave();
                
                if ( !empty($info) ) 
                {
                    if ( $model->iniciarSesion($info) )
                    {
                        View::redirect($modulo);
                    }else{
                        $alerta = [
                            'tipo' => 'danger',
                            'mensaje' => 'Ocurrió un problema en el sistema, por favor contácte al administrador.'
                        ];
                    }
                }else{
                    $alerta = [
                        'tipo' => 'warning',
                        'mensaje' => 'Credenciales incorrectas.'
                    ];
                }
            }else{
                $alerta = [
                    'tipo' => 'danger',
                    'mensaje' => 'No existe información relacionada con la identificación.'
                ];
            }
        }

        View::render('iniciarSesion', ['alerta' => $alerta, 'model' => $model], 'login');
    }
    
    public function cerrarSesion()
    {
        Session::destroy();
        View::redirect('home/index');
    }
    
    public function cambiarClave()
    {
        
    }
    
}
