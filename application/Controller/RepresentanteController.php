<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\View;
use Mini\Core\Session;
use Mini\Model\Usuario;
use Mini\Model\Programacion;

/**
 * Description of RepresentanteController
 *
 * @author ingeniero.analista1
 */
class RepresentanteController extends Controller {

    public $loginUrl = 'representante/iniciarSesion';

    public function index() 
    {
        $this->verificarInicioSesion();

        View::render('representante/index');
    }

    public function iniciarSesion() 
    {
        $error = null;

        if (isset($_POST['txtIdentificacion']) && isset($_POST['txtClave'])) {
            $model = new Usuario();
            $usuario = $model->getUsuarioClave($_POST['txtIdentificacion'], $_POST['txtClave']);

            if ($usuario) {
                if ( $model->iniciarSesion($usuario, $_POST['txtIdentificacion']) )
                {
                    View::redirect('representante/index');
                }
            }else{
                $error = [
                    'tipo' => 'danger',
                    'mensaje' => 'Credenciales incorrectas. Por favor verifique su identificación y su contraseña.'
                ];
            }
        }

        View::render('representante/iniciarSesion', ['error' => $error], 'login');
    }

    public function programacion() 
    {
        $this->verificarPermisos();
        
        $error = null;
        
        $model = new Programacion();
        $programacion = $model->getProgramacionActual();
        
        if( isset($_POST["btnGuardar"]))
        {
            $annio                      = null;
            $fecha_inicio_inscripcion 	= $_POST["txtFechaInicioInscripcion"];
            $fecha_fin_inscripcion 	= $_POST["txtFechaFinInscripcion"];
            $fecha_inicio_votacion 	= $_POST["txtFechaInicioVotacion"];
            $fecha_fin_votacion 	= $_POST["txtFechaFinVotacion"];
            $annio                      = null;
            $usuario_crea               = null;
            $usuario_actualiza          = null;
            $fecha_actualiza            = null;            
            
            if ($programacion){
                $annio              = $programacion->ANNIO;
                $usuario_crea       = $programacion->USUARIO_CREA;
                $fecha_crea         = $programacion->FECHA_CREA;
                $usuario_actualiza  = Session::get('usuario')[0]->CEDULA;
                $fecha_actualiza    = date('Y-m-d H:i:s');
                
                if ($model->update(
                    $annio,
                    $fecha_inicio_inscripcion,
                    $fecha_fin_inscripcion,
                    $fecha_inicio_votacion,
                    $fecha_fin_votacion,
                    $usuario_crea,
                    $fecha_crea,
                    $usuario_actualiza,
                    $fecha_actualiza
                ))
                {
                    $programacion = $model->getProgramacionActual();
                }
            }else{
                $annio              = date('Y');
                $usuario_crea       = Session::get('usuario')[0]->CEDULA;
                $fecha_crea         = date('Y-m-d H:i:s');
                $usuario_actualiza  = Session::get('usuario')[0]->CEDULA;
                $fecha_actualiza    = date('Y-m-d H:i:s');
                
                if ($model->insert(
                    $annio,
                    $fecha_inicio_inscripcion,
                    $fecha_fin_inscripcion,
                    $fecha_inicio_votacion,
                    $fecha_fin_votacion,
                    $usuario_crea,
                    $fecha_crea,
                    $usuario_actualiza,
                    $fecha_actualiza
                ))
                {
                    $programacion = $model->getProgramacionActual();
                }
            }
            
            if ($programacion){
                $error['tipo'] = 'success';
                $error['mensaje'] = 'Guardó exitosamente.';
            }else{
                $error['tipo'] = 'danger';
                $error['mensaje'] = 'Guardó exitosamente.';
            }
        }
        
        View::render('representante/programacion', ['error' => $error, 'programacion' => $programacion]);
    }

    public function planchas() 
    {
        $this->verificarPermisos();
        
        View::render('representante/planchas');
    }

    public function reportes() {
        $this->verificarPermisos();
        
        View::render('representante/reportes');
    }
    
    public function cerrarSesion()
    {
        $model = new Usuario();
        $model->cerrarSesion();
        
        View::redirect($this->loginUrl);
    }

    public function validarIdentificacion() {
        $response = [
            'valid' => false,
            'message' => 'Campo requerido'
        ];

        if (isset($_POST['txtIdentificacion'])) {
            
            if ($_POST['txtIdentificacion'] !== "")
            {
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
        }

        echo json_encode($response);
    }

}
