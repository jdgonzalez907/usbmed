<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\View;
use Mini\Model\Estudio;
use Mini\Model\Estudiante;

/**
 * Description of ResolucionesController
 *
 * @author ingeniero.analista4
 */
class DerechosGradosController extends Controller {

    public function index() {
        $alerta = [
            'tipo' => 'info',
            'mensaje' => '- Su información debe ser igual a como aparece en el documento.<br>'
            . '- La foto debe ser fondo azul.'
        ];

        if (isset($_POST["btnEnviar"])) {

            $estudiante = new Estudiante();
            $estudiante->setTIPO_IDENTIFICACION($_POST["sltTipoID"]);
            $estudiante->setIDENTIFICACION($_POST["txtID"]);
            $estudiante->setNOMBRES($_POST["txtNombre"]);
            $estudiante->setAPELLIDOS($_POST["txtApellido"]);
            $estudiante->setCORREO($_POST["txtCorreo"]);
            $estudiante->setCELULAR($_POST["txtTelefono"]);
            $estudiante->setCODIGO($_POST["txtCodigo"]);
            $estudiante->setID_ESTUDIO($_POST["sltPrograma"]);

            if ($estudiante->consultarEstudiante()) {
                $carpeta = '\\documentos\\' . $estudiante->getIDENTIFICACION() . '\\';
                $extension = null;
                $nombre = null;
                $ruta = null;

                //Archivo PRUEBA
                $extension = substr($_FILES["achPruebas"]["name"], strpos($_FILES["achPruebas"]["name"], '.'));
                $nombre = $estudiante->getID_ESTUDIO() . '_' .
                        $estudiante->getNOMBRES() . '_' .
                        $estudiante->getAPELLIDOS() . '_PRUEBA_' .
                        $estudiante->getIDENTIFICACION();
                $ruta = ROOT . URL_PUBLIC_FOLDER . $carpeta;
                if (!is_dir($ruta)) {
                    mkdir($ruta);
                }
                if (move_uploaded_file($_FILES["achPruebas"]["tmp_name"], $ruta . $nombre . $extension)) {
                    $estudiante->setARCHIVO_PRUEBA($ruta . $nombre . $extension);
                }

                //Archivo DOCUMENTO
                $extension = substr($_FILES["achID"]["name"], strpos($_FILES["achID"]["name"], '.'));
                $nombre = $estudiante->getID_ESTUDIO() . '_' .
                        $estudiante->getNOMBRES() . '_' .
                        $estudiante->getAPELLIDOS() . '_DOCUMENTO_' .
                        $estudiante->getIDENTIFICACION();
                $ruta = ROOT . URL_PUBLIC_FOLDER . $carpeta;
                if (!is_dir($ruta)) {
                    mkdir($ruta);
                }
                if (move_uploaded_file($_FILES["achID"]["tmp_name"], $ruta . $nombre . $extension)) {
                    $estudiante->setARCHIVO_DOCUMENTO($ruta . $nombre . $extension);
                }

                //Archivo FOTO
                $extension = substr($_FILES["achFoto"]["name"], strpos($_FILES["achFoto"]["name"], '.'));
                $nombre = $estudiante->getID_ESTUDIO() . '_' .
                        $estudiante->getNOMBRES() . '_' .
                        $estudiante->getAPELLIDOS() . '_FOTO_' .
                        $estudiante->getIDENTIFICACION();
                $ruta = ROOT . URL_PUBLIC_FOLDER . $carpeta;
                if (!is_dir($ruta)) {
                    mkdir($ruta);
                }
                if (move_uploaded_file($_FILES["achFoto"]["tmp_name"], $ruta . $nombre . $extension)) {
                    $estudiante->setARCHIVO_FOTO($ruta . $nombre . $extension);
                }


                if ($estudiante->getARCHIVO_DOCUMENTO() && $estudiante->getARCHIVO_FOTO() && $estudiante->getARCHIVO_PRUEBA()) {

                    if ($estudiante->insertar()) {
                        $alerta = [
                            'tipo' => 'success',
                            'mensaje' => 'La información se guardó correctamente.'
                        ];
                    } else{
                        $alerta = [
                            'tipo' => 'danger',
                            'mensaje' => 'Error en el servidor.'
                        ];
                    }
                }
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'mensaje' => 'Usted ya ingresó los documentos.'
                ];
            }
        }

        View::render('derechosGrados/index', ['alerta' => $alerta], "derechosGrados");
    }

    public function consultarPorgrama() {
        if ($this->isAjax()) {
            $tipo = isset($_POST["Tipo"]) ? $_POST["Tipo"] : 0;

            $estudio = new Estudio();
            $estudio->setTIPO($tipo);
            $resultado = $estudio->consultarPrograma();

            echo json_encode($resultado);
        } else {
            View::redirect('control/error400');
        }
    }

}
