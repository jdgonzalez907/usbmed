<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\View;
use Mini\Model\Usuario;

/**
 * Description of RepresentanteController
 *
 * @author ingeniero.analista1
 */
class RepresentanteController extends Controller {

    public $loginUrl = 'representante/iniciarSesion';

    public function index() {
        $this->verificarInicioSesion();

        View::render('representante/index');
    }

    public function iniciarSesion() {

        if (isset($_POST['txtIdentificacion']) && isset($_POST['txtClave'])) {
            $model = new Usuario();
            $usuario = $model->getUsuarioClave($_POST['txtIdentificacion'], $_POST['txtClave']);

            if ($usuario) {
                if ( $model->iniciarSesion($usuario, $_POST['txtIdentificacion']) )
                {
                    View::redirect('representante/index');
                }
            }
        }

        View::render('representante/iniciarSesion', [], 'login');
    }

    public function administrarFechas() {
        $this->verificarPermisos();
        
        View::render('representante/administrarFechas');
    }

    public function validarIdentificacion() {
        $response = [
            'valid' => false,
            'message' => 'Campo requerido'
        ];

        if (isset($_POST['txtIdentificacion'])) {
            $model = new Usuario();

            $usuario = $model->getUsuario($_POST['txtIdentificacion']);

            if ($usuario) {
                $response['valid'] = true;
            } else {
                $response = [
                    'valid' => false,
                    'message' => 'No existe información relacionada con la identificación'
                ];
            }
        }

        echo json_encode($response);
    }

}
