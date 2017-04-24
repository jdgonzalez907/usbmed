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
 * Description of DerechoGradosController
 *
 * @author ingeniero.analista1
 */
class DerechoGradosController extends Controller {

    public function index() {
        $alerta = [
            'tipo' => 'info',
            'mensaje' => '- Su información debe ser tal cuál cómo aparece en el documento. <br>'
            . '- La foto debe ser fondo azul. '
        ];

        if (isset($_POST["btnEnviar"])) {
            $modeloEstudiante = new Estudiante();
            $modeloEstudiante->setTIPO_IDENTIFICACION($_POST["sltTIPO"]);
            $modeloEstudiante->setIDENTIFICACION($_POST["txtID"]);
            $modeloEstudiante->setID_ESTUDIO($_POST["sltPROGRAMA"]);

            if (!$modeloEstudiante->consultarLlavePrimaria()) {
                $modeloEstudiante->setNOMBRES($_POST["txtNOMBRE"]);
                $modeloEstudiante->setAPELLIDOS($_POST["txtAPELLIDO"]);
                $modeloEstudiante->setCORREO($_POST["txtCORREO"]);
                $modeloEstudiante->setCELULAR($_POST["txtTELEFONO"]);
                $modeloEstudiante->setCODIGO($_POST["txtCODIGO"]);

                $carpeta = "\\documentos\\";
                $rutaServidor = "";
                $rutaUrl = "";
                $nombre = "";
                $extension;

                //FOTO
                $extension = substr($_FILES["flFOTO"]["name"], strpos($_FILES["flFOTO"]["name"], '.'));
                $nombre = $modeloEstudiante->getID_ESTUDIO() . '_'
                        . 'FOTO_'
                        . $modeloEstudiante->getIDENTIFICACION()
                        . '(' . $modeloEstudiante->getTIPO_IDENTIFICACION() . ')_'
                        . $modeloEstudiante->getNOMBRES() . ' '
                        . $modeloEstudiante->getAPELLIDOS()
                        . $extension;
                $rutaServidor = ROOT
                        . URL_PUBLIC_FOLDER
                        . $carpeta
                        . '\fotos'
                        . "\\";

                if (!is_dir($rutaServidor)) {
                    mkdir($rutaServidor);
                }

                if (move_uploaded_file($_FILES["flFOTO"]["tmp_name"], $rutaServidor . $nombre)) {
                    $rutaUrl = URL
                            . URL_PUBLIC_FOLDER
                            . str_replace("\\", "/", $carpeta)
                            . '/fotos'
                            . "/"
                            . $nombre;

                    $modeloEstudiante->setARCHIVO_FOTO($rutaUrl);
                }

                //PRUEBA
                $extension = substr($_FILES["flPRUEBA"]["name"], strpos($_FILES["flPRUEBA"]["name"], '.'));
                $nombre = $modeloEstudiante->getID_ESTUDIO() . '_'
                        . 'PRUEBA_'
                        . $modeloEstudiante->getIDENTIFICACION()
                        . '(' . $modeloEstudiante->getTIPO_IDENTIFICACION() . ')_'
                        . $modeloEstudiante->getNOMBRES() . ' '
                        . $modeloEstudiante->getAPELLIDOS()
                        . $extension;
                $rutaServidor = ROOT
                        . URL_PUBLIC_FOLDER
                        . $carpeta
                        . '\pruebasSaber'
                        . "\\";

                if (!is_dir($rutaServidor)) {
                    mkdir($rutaServidor);
                }

                if (move_uploaded_file($_FILES["flPRUEBA"]["tmp_name"], $rutaServidor . $nombre)) {
                    $rutaUrl = URL
                            . URL_PUBLIC_FOLDER
                            . str_replace("\\", "/", $carpeta)
                            . '/pruebasSaber'
                            . "/"
                            . $nombre;

                    $modeloEstudiante->setARCHIVO_PRUEBA($rutaUrl);
                }

                //DOCUMENTO
                $extension = substr($_FILES["flDOCUMENTO"]["name"], strpos($_FILES["flDOCUMENTO"]["name"], '.'));
                $nombre = $modeloEstudiante->getID_ESTUDIO() . '_'
                        . 'DOCUMENTO_'
                        . $modeloEstudiante->getIDENTIFICACION()
                        . '(' . $modeloEstudiante->getTIPO_IDENTIFICACION() . ')_'
                        . $modeloEstudiante->getNOMBRES() . ' '
                        . $modeloEstudiante->getAPELLIDOS()
                        . $extension;
                $rutaServidor = ROOT
                        . URL_PUBLIC_FOLDER
                        . $carpeta
                        . '\documentos'
                        . "\\";

                if (!is_dir($rutaServidor)) {
                    mkdir($rutaServidor);
                }

                if (move_uploaded_file($_FILES["flDOCUMENTO"]["tmp_name"], $rutaServidor . $nombre)) {
                    $rutaUrl = URL
                            . URL_PUBLIC_FOLDER
                            . str_replace("\\", "/", $carpeta)
                            . '/documentos'
                            . "/"
                            . $nombre;

                    $modeloEstudiante->setARCHIVO_DOCUMENTO($rutaUrl);
                }

                if ($modeloEstudiante->getARCHIVO_DOCUMENTO() && $modeloEstudiante->getARCHIVO_FOTO() && $modeloEstudiante->getARCHIVO_PRUEBA()) {
                    if ($modeloEstudiante->insert()) {
                        $alerta = [
                            'tipo' => 'success',
                            'mensaje' => 'Los documentos se subieron correctamente.'
                        ];
                    } else {
                        $alerta = [
                            'tipo' => 'danger',
                            'mensaje' => 'Ocurrió un error al tratar de insertar los datos, por favor contácte a la Unidad de Tecnología.'
                        ];
                    }
                } else {
                    $alerta = [
                        'tipo' => 'danger',
                        'mensaje' => 'Ocurrió un error al subir los archivos.'
                    ];
                }
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'mensaje' => 'Usted ya cargó los documentos, si cree que esto es un error por favor contácte a registro académico.'
                ];
            }
        }

        View::render('derechoGrados/index', ['alerta' => $alerta], 'derechoGrados');
    }

    public function ajaxConsultarPrograma() {
        if ($this->isAjax()) {
            $retorno = [];

            if (isset($_POST["txtGRADO"])) {
                $txtGRADO = $_POST["txtGRADO"];

                $modeloEstudio = new Estudio();
                $modeloEstudio->setTIPO($txtGRADO);

                $retorno = $modeloEstudio->consultarPorTipo();
            }

            echo json_encode($retorno);
        }
    }

}
