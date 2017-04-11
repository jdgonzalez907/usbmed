<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\View;
use Mini\Model\FechasCurso;
use Mini\Core\Session;
use Mini\Model\AsistenciaCurso;
use Mini\Model\InscripcionCurso;

/**
 * Description of ascensoReubicacionDocente
 *
 * @author ingeniero.analista1
 */
class AscensoReubicacionDocenteController extends Controller {

    public $loginUrl = 'usuario/iniciarSesion/ascensoReubicacionDocente';

    public function index() {
        $this->verificarPermisos();
        View::render('ascensoReubicacionDocente/index');
    }

    public function asistencia() {
        $this->verificarPermisos();

        $alerta = null;
        $consecutivosAsociados = [];

        $fechasCurso = new FechasCurso();
        $fechasCurso->setCEDULA_PROFESOR(Session::get('usuario')['usuario']);
        $consecutivosAsociados = $fechasCurso->consecutivosAsociados();

        if (!$consecutivosAsociados) {
            $alerta = [
                'tipo' => 'danger',
                'mensaje' => 'Usted no cuenta con cursos asignados'
            ];
        }

        View::render(
                'ascensoReubicacionDocente/asistencia', [
            'alerta' => $alerta,
            'consecutivosAsociados' => $consecutivosAsociados,
            'fechasCurso' => $fechasCurso
                ]
        );
    }

    public function consultarFechas() {
        if ($this->isAjax()) {
            if (!$this->verificarPermisos(false)) {
                View::render('control/error403', [], '');
            } else {
                $consecutivo = null;

                if (isset($_POST['consecutivo'])) {
                    $consecutivo = $_POST['consecutivo'];
                }

                $model = new FechasCurso();
                $model->setCEDULA_PROFESOR(Session::get('usuario')['usuario']);
                $model->setCONSECUTIVO($consecutivo);

                echo json_encode($model->consultarFechas());
            }
        } else {
            View::redirect('control/error400');
        }
    }

    public function crearFecha() {
        if ($this->isAjax()) {
            if (!$this->verificarPermisos(false)) {
                View::render('control/error403', [], '');
            } else {
                $fechaAsistencia = null;
                $consecutivo = null;
                $retorno = [];

                if (isset($_POST['fechaAsistencia']) && isset($_POST["consecutivo"])) {
                    $fechaAsistencia = $_POST['fechaAsistencia'];
                    $consecutivo = $_POST["consecutivo"];
                }

                $model = new AsistenciaCurso();
                $model->setFECHA_ASISTENCIA($fechaAsistencia);

                if ($model->existeFechaAsistencia() !== false) {
                    $retorno = [
                        'error' => true,
                        'resultado' => \Mini\Libs\Alerta::crear('warning', 'Ya existe esta fecha de asistencia.')
                    ];
                } else {
                    $inscritos = new InscripcionCurso();
                    $inscritos->setCONSECUTIVO($consecutivo);
                    $consultarInscritos = $inscritos->consultarInscritos();

                    $resultado = [];

                    foreach ($consultarInscritos as $unInscrito) {
                        $resultado[] = [
                            'persona' => $unInscrito->IDENTIFICACION,
                            'observaciones' => '',
                            'asistio' => true,
                        ];
                    }

                    $retorno = [
                        'error' => false,
                        'resultado' => $resultado
                    ];
                }

                echo json_encode($retorno);
            }
        } else {
            View::redirect('control/error400');
        }
    }

    public function guardarFecha() {
        if ($this->isAjax()) {
            //if (!$this->verificarPermisos(false)) {
                //View::render('control/error403', [], '');
            //} else {
                if ( isset( $_POST["persona"] ) ) {
                    $personas = $_POST["persona"];
                    $fechaAsistioPersona = [];
                    
                    foreach ($personas as $unaPersona) {
                        $model = new AsistenciaCurso();
                        //$model->setFECHA_ASISTENCIA($FECHA_ASISTENCIA)
                    }
                }
            //}
        } else {
            View::redirect('control/error400');
        }
    }

}
