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

    public $loginUrl = 'usuario/iniciarSesion/representante';

    public function index() 
    {
        $this->verificarInicioSesion();

        View::render('representante/index');
    }

    public function programacion() 
    {
        $this->verificarPermisos();
        
        $alerta = null;
        
        $model = new Programacion();
        $tieneProgramacion = $model->getProgramacionActual();
        
        if ($tieneProgramacion)
        {
            $alerta = [
                'tipo' => 'info',
                'mensaje' => 'A continuación se muestra la programación ya creada para el presente año.'
            ];
        }
        
        if ( isset($_POST["Programacion"]) )
        {
            $valido = true;
            
            $model->setFECHA_INICIO_INSCRIPCION($_POST["Programacion"]["FECHA_INICIO_INSCRIPCION"]);
            $model->setFECHA_FIN_INSCRIPCION($_POST["Programacion"]["FECHA_FIN_INSCRIPCION"]);
            $model->setFECHA_INICIO_VOTACION($_POST["Programacion"]["FECHA_INICIO_VOTACION"]);
            $model->setFECHA_FIN_VOTACION($_POST["Programacion"]["FECHA_FIN_VOTACION"]);
            
            if (strtotime($model->getFECHA_FIN_INSCRIPCION()) < strtotime($model->getFECHA_INICIO_INSCRIPCION()))
            {
                $valido = false;
                $alerta = [
                    'tipo' => 'warning',
                    'mensaje' => 'La fecha <i>fin de inscripción</i> <strong>no puede ser menor</strong> a la fecha <i>inicio inscripción</i>.'
                ];
            }
            
            if (strtotime($model->getFECHA_INICIO_VOTACION()) < strtotime($model->getFECHA_FIN_INSCRIPCION()))
            {
                $valido = false;
                $alerta = [
                    'tipo' => 'warning',
                    'mensaje' => 'La fecha <i>inicio de votación</i> <strong>no puede ser menor</strong> a la fecha <i>fin inscripción</i>.'
                ];
            }
            
            if (strtotime($model->getFECHA_FIN_VOTACION()) < strtotime($model->getFECHA_INICIO_VOTACION()))
            {
                $valido = false;
                $alerta = [
                    'tipo' => 'warning',
                    'mensaje' => 'La fecha <i>fin de votación</i> <strong>no puede ser menor</strong> a la fecha <i>inicio votación</i>.'
                ];
            }
            
            if ( $valido )
            {
                if ( $tieneProgramacion )
                {
                    $model->setUSUARIO_ACTUALIZA(Session::get('usuario')['usuario']);
                    $model->setFECHA_ACTUALIZA(date('Y/m/d H:i:s'));
                    
                    if ( $model->update() )
                    {
                        $alerta = [
                            'tipo' => 'success',
                            'mensaje' => 'Programación <strong>actualizada</strong>.'
                        ];
                    }else{
                        $alerta = [
                            'tipo' => 'danger',
                            'mensaje' => 'Ocurrió un error, contácte al administrador del sistema.'
                        ];                        
                    }
                }else{
                    $model->setANNIO(date('Y'));
                    $model->setUSUARIO_CREA(Session::get('usuario')['usuario']);
                    $model->setFECHA_CREA(date('Y/m/d H:i:s'));
                    
                    if ( $model->insert() )
                    {
                        $alerta = [
                            'tipo' => 'success',
                            'mensaje' => 'Programación <strong>creada</strong>.'
                        ];                        
                    }else{
                        $alerta = [
                            'tipo' => 'danger',
                            'mensaje' => 'Ocurrió un error, contácte al administrador del sistema.'
                        ];                        
                    }
                }
            }
        }
        
        View::render('representante/programacion', ['alerta' => $alerta, 'model' => $model]);
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
    
}
