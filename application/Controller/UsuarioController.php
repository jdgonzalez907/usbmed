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
class UsuarioController extends Controller {

    public function iniciarSesion($controlador = 'home', $accion = 'index', $tipoLogin = 'clave') {
        $alerta = null;

        $model = new Usuario();

        if (isset($_POST["Usuario"])) {
            $model->setCEDULA($_POST["Usuario"]["CEDULA"]);
            $model->setCLAVE($_POST["Usuario"]["CLAVE"]);

            if ($model->existeInfo()) {
                $info = null;
                if ($tipoLogin === 'fechaNacimiento') {
                    $info = $model->getInfoPorFecha();
                } else {
                    $info = $model->getInfoPorClave();
                }

                if (!empty($info)) {
                    $cargarPermisos = ($tipoLogin === 'clave') ? true : false;
                    if ($model->iniciarSesion($info, $cargarPermisos)) {
                        View::redirect($controlador . '/' . $accion);
                    } else {
                        $alerta = [
                            'tipo' => 'danger',
                            'mensaje' => 'Ocurrió un problema en el sistema, por favor contácte al administrador.'
                        ];
                    }
                } else {
                    $alerta = [
                        'tipo' => 'warning',
                        'mensaje' => 'Credenciales incorrectas.'
                    ];
                }
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'mensaje' => 'No existe información relacionada con la identificación.'
                ];
            }
        }

        if ($tipoLogin === 'fechaNacimiento') {
            View::render('iniciarSesionFechaNacimiento', ['alerta' => $alerta, 'model' => $model], 'login');
        } else {
            View::render('iniciarSesion', ['alerta' => $alerta, 'model' => $model], 'login');
        }
    }

    public function cambiarClave() {
        $this->verificarInicioSesion();
        
        $alerta = null;        
        $model = new Usuario();
        
        if ( isset($_POST["Usuario"]) )
        {
            $model->setCEDULA(Session::get('usuario')['usuario']);
            $model->setCLAVE($_POST["Usuario"]["CLAVE_NUEVA"]);
            
            if ( $model->cambiarClave() )
            {
                $alerta = [
                    'tipo' => 'success',
                    'mensaje' => 'Su clave ha sido <strong>actualizada</strong> correctamente.'
                ];
            }else{
                $alerta = [
                    'tipo' => 'danger',
                    'mensaje' => 'Ocurrió un error, contácte al administrador del sistema.'
                ];
            }
            
        }

        View::render('usuario/cambiarClave', ['model' => $model, 'alerta' => $alerta], 'login');
    }

    public function recordarClave() {
        $alerta = null;
        $model = new Usuario();

        if (isset($_POST["Usuario"])) {
            $model->setCEDULA($_POST["Usuario"]["CEDULA"]);
            $model->setCLAVE($_POST["Usuario"]["CLAVE"]);

            $info = $model->getInfoPorFecha();

            if ($info) {
                $correos = [];
                $clave = "";
                $nombre = "";

                foreach ($info as $key => $value) {
                    $correos[]  = $value->CORREO;
                    $clave      = $value->CLAVE;
                    $nombre     = $value->NOMBRES;
                }

                $cabeceras = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $cabeceras .= 'From: Universidad San Buenaventura de Medellin<usbmed@usbmed.edu.co>';

                $titulo = "Recordar clave - USB Medellín";
                $para = implode(',', $correos);
                
                ob_start();
                View::render('_templates/email/recordarClave', [], []);
                $mensaje = ob_get_contents();
                ob_clean();
                
                $mensaje = str_replace('{_NOMBRE_}', $nombre, $mensaje);
                $mensaje = str_replace('{_CLAVE_}', $clave, $mensaje);

                $enviado = mail($para, $titulo, $mensaje, $cabeceras);

                if ($enviado) {
                    $alerta = [
                        'tipo' => 'success',
                        'mensaje' => 'Se envió la contraseña al(los) siguiente(es) correo(s): <br><br>- '. implode('<br>- ', $correos)
                    ];
                } else {
                    $alerta = [
                        'tipo' => 'danger',
                        'mensaje' => 'El servidor de envío de correos no está disponible, por favor intente más tarde.'
                    ];
                }
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'mensaje' => 'Las credenciales suministradas no cuentan con información relacionada.'
                ];
            }
        }

        View::render('usuario/recordarClave', ['alerta' => $alerta, 'model' => $model], 'login');
    }

    public function cerrarSesion($controlador = "", $accion = "") {
        Session::destroy();
        $url = ($controlador != "") ? $controlador : "usuario";
        $url .= '/' . (($accion != "") ? $accion : "iniciarSesion");
        
        View::redirect($url);
    }

}
