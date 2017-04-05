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

    public $loginUrl = 'usuario/iniciarSesion';

    protected function verificarPermisos($redirect = true) {
        if ($this->verificarInicioSesion($redirect)) {
            if (!array_key_exists(Application::$url_id, Session::get('permisos'))) {
                if ($redirect) {
                    $errorHandler = new \Mini\Controller\ControlController();
                    $errorHandler->error403();
                    exit();
                }

                return false;
            } else {
                return true;
            }
        }
        return false;
    }

    protected function verificarInicioSesion($redirect = true) {
        if (Session::isGuest()) {
            if ($redirect) {
                View::redirect($this->loginUrl);
            }

            return false;
        }

        return true;
    }

    protected function isAjax($method = 'post') {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } else {
            $errorHandler = new \Mini\Controller\ControlController();
            $errorHandler->error400();
            exit();
        }
    }

}
