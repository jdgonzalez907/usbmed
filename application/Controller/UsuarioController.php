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
            View::render('usuario/iniciarSesionFechaNacimiento', ['alerta' => $alerta, 'model' => $model], 'login');
        } else {
            View::render('usuario/iniciarSesion', ['alerta' => $alerta, 'model' => $model, 'controlador' => $controlador, 'accion' => $accion], 'login');
        }
    }

    public function cambiarClave() {
        $this->verificarInicioSesion();

        $alerta = null;
        $model = new Usuario();

        if (isset($_POST["Usuario"])) {
            $model->setCEDULA(Session::get('usuario')['usuario']);
            $model->setCLAVE($_POST["Usuario"]["CLAVE"]);
            $claveActual = $model->claveActual();

            if ($claveActual->ES_VALIDA > 0) {
                $model->setCLAVE($_POST["Usuario"]["CLAVE_NUEVA"]);
                if ($model->cambiarClave()) {
                    $alerta = [
                        'tipo' => 'success',
                        'mensaje' => 'Su clave ha sido <strong>actualizada</strong> correctamente.'
                    ];
                } else {
                    $alerta = [
                        'tipo' => 'danger',
                        'mensaje' => 'Ocurrió un error, contácte al administrador del sistema.'
                    ];
                }
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'mensaje' => 'La clave actual ingresada no corresponde con la registrada en la base de datos.'
                ];
            }
        }

        View::render('usuario/cambiarClave', ['model' => $model, 'alerta' => $alerta], 'menu_top');
    }

    public function recordarClave($controlador = 'home', $accion = 'index') {
        $alerta = null;
        $model = new Usuario();

        if (isset($_POST["Usuario"])) {
            
            $model->setCEDULA($_POST["Usuario"]["CEDULA"]);
            $model->setCLAVE((isset($_POST["Usuario"]["CLAVE"]) ? $_POST["Usuario"]["CLAVE"] : ''));

            $info = $model->getInfoPorCedula();

            if ($info) {
                $correo = "";
                $clave = "";
                $nombre = "";

                foreach ($info as $key => $value) {
                    $correo = ($value->CORREO == $model->getCLAVE()) ? $model->getCLAVE() : "";
                    $clave = $value->CLAVE;
                    $nombre = $value->NOMBRES;
                }

                $enviado = $model->enviarClave($correo, $clave, $nombre);

                if ($enviado) {
                    $alerta = [
                        'tipo' => 'success',
                        'mensaje' => 'Se envió la contraseña al siguiente correo: <br><br>- ' . $correo
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

        View::render('usuario/recordarClave', ['alerta' => $alerta, 'model' => $model, 'controlador' => $controlador, 'accion' => $accion], 'login');
    }

    public function cerrarSesion($controlador = "", $accion = "") {
        Session::destroy();
        $url = ($controlador != "") ? $controlador : "usuario";
        $url .= '/' . (($accion != "") ? $accion : "iniciarSesion");

        View::redirect($url);
    }

    public function validarCedula() {
        $this->isAjax();
        $retorno = [];

        if ($_POST["cedula"]) {
            $model = new Usuario;
            $model->setCEDULA($_POST["cedula"]);

            $informacion = $model->getInfoPorCedula();

            if ($informacion) {
                $correos = [];

                foreach ($informacion as $key => $info) {
                    if (!is_null($info->CORREO) && !in_array($info->CORREO, $correos)) {
                        $correos[] = $info->CORREO;
                    }
                }

                if ($correos) {
                    $retorno = [
                        'tipo' => 'success',
                        'mensaje' => $correos
                    ];
                } else {
                    $retorno = [
                        'tipo' => 'error',
                        'mensaje' => 'No se encuentran correos asociados, por favor contácte a la universidad si cree que esto es un error.'
                    ];
                }
            } else {
                $retorno = [
                    'tipo' => 'error',
                    'mensaje' => 'No se encuentra información disponible, por favor contácte a la universidad si cree que esto es un error.'];
            }
        }

        echo json_encode($retorno);
    }

}
