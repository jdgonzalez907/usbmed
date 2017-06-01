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

        View::render('ascensoReubicacionDocente/asistencia');
    }

    public function consultarConsecutivos() {
        $alerta = null;
        $data = null;

        $fechas_curso = new FechasCurso();
        $fechas_curso->setCEDULA_PROFESOR(Session::get("usuario")["usuario"]);

        $data = $fechas_curso->consecutivosAsociados();

        if ($data === null) {
            $alerta = [
                "tipo" => "danger",
                "mensaje" => "Usted no cuenta con consecutivos asociados."
            ];
        }

        $retorno = ["alerta" => $alerta, "data" => $data];
        echo json_encode($retorno);
    }

    public function consultarFechas() {
        $alerta = null;
        $data = null;

        if (isset($_POST["consecutivo"])) {
            $consecutivo = $_POST["consecutivo"];

            if ($consecutivo) {
                $fechas_curso = new FechasCurso();
                $fechas_curso->setCEDULA_PROFESOR(Session::get("usuario")["usuario"]);
                $fechas_curso->setCONSECUTIVO($consecutivo);

                $data = $fechas_curso->consultarFechas();

                if ($data == null) {
                    $alerta = [
                        "tipo" => "info",
                        "mensaje" => "No hay fechas creadas para el consecutivo: $consecutivo."
                    ];
                }
            } else {
                $alerta = [
                    "tipo" => "danger",
                    "mensaje" => "Consecutivo no válido."
                ];
            }
        } else {
            $alerta = [
                "tipo" => "danger",
                "mensaje" => "Consecutivo no válido."
            ];
        }

        $retorno = ["alerta" => $alerta, "data" => $data];
        echo json_encode($retorno);
    }

    public function crearFecha() {
        $alerta = null;
        $data = null;

        if (isset($_POST["fecha"]) && isset($_POST["consecutivo_seleccionado"]))
        {
            $fecha = $_POST["fecha"];
            $consecutivo_seleccionado = $_POST["consecutivo_seleccionado"];
            
            $fecha_time = strtotime(str_replace('/', '-', $fecha));
            $dia  = 0;
            $mes  = 0;
            $anio = 0;
            
            if ($fecha_time) 
            {
                $dia  = date('d', $fecha_time);
                $mes  = date('m', $fecha_time);
                $anio = date('Y', $fecha_time);
            }
            
            if ($fecha && checkdate($mes, $dia, $anio)){
                $asistencia_curso = new AsistenciaCurso();
                $asistencia_curso->setFECHA_ASISTENCIA($fecha);
                $asistencia_curso->setCONSECUTIVO($consecutivo_seleccionado);
                
                $existe_asistencia = $asistencia_curso->existeFechaAsistencia();
                
                if ($existe_asistencia){
                    $alerta = [
                        "tipo" => "warning",
                        "mensaje" => "Ya existe la fecha."
                    ];
                }else{
                    $inscripcion_curso = new InscripcionCurso();
                    $inscripcion_curso->setCONSECUTIVO($consecutivo_seleccionado);
                    
                    $data = $inscripcion_curso->consultarInscritos();
                    
                    $contador = 0;
                    
                    foreach ($data as $inscrito) {
                        $crear_asistencia = new AsistenciaCurso();
                        $crear_asistencia->setFECHA_ASISTENCIA($fecha);
                        $crear_asistencia->setIDENTIFICACION_DOC(Session::get("usuario")["usuario"]);
                        $crear_asistencia->setFECHA_CREACION(date('d/m/Y'));
                        $crear_asistencia->setASISTIO('N');
                        $crear_asistencia->setCONSECUTIVO($consecutivo_seleccionado);
                        $crear_asistencia->setIDENTIFICACION_EST($inscrito->IDENTIFICACION);
                        $crear_asistencia->setOBSERVACION('');
                        $crear_asistencia->setUSUARIO_ACTUALIZA(Session::get("usuario")["usuario"]);
                        $crear_asistencia->setFECHA_ACTUALIZA(date('d/m/Y'));
                        $crear_asistencia->setFECHA_OFICIALIZA(null);
                        
                        if ( $crear_asistencia->insert() )
                            $contador++;
                    }
                    
                    if ($contador == count($data)){
                        $alerta = [
                            "tipo" => "success",
                            "mensaje" => "Fecha creada correctamente."
                        ];
                    }else{
                        $alerta = [
                            "tipo" => "danger",
                            "mensaje" => "Hubo un error en el sistema. Por favor contácte al administrador."
                        ];
                    }
                }
                
            } else {
                $alerta = [
                    "tipo" => "danger",
                    "mensaje" => "Fecha no válida."
                ];
            }
        } else {
            $alerta = [
                "tipo" => "danger",
                "mensaje" => "Fecha no válida."
            ];
        }

        $retorno = ["alerta" => $alerta, "data" => $data];
        echo json_encode($retorno);
    }
    
    public function consultarAsistencia()
    {
        $alerta = null;
        $data = null;
        
        if (isset($_POST["fecha_consultar_asistencia"]) && isset($_POST["consecutivo_consultar_asistencia"])) {
            $fecha_consultar_asistencia = $_POST["fecha_consultar_asistencia"];
            $consecutivo_consultar_asistencia = $_POST["consecutivo_consultar_asistencia"];
            
            $asistencia_curso = new AsistenciaCurso();
            $asistencia_curso->setCONSECUTIVO($consecutivo_consultar_asistencia);
            $asistencia_curso->setFECHA_ASISTENCIA($fecha_consultar_asistencia);
            
            $data = $asistencia_curso->consultarAsistenciaCurso();
            
        }else{
            $alerta = [
                "tipo" => "danger",
                "mensaje" => "Parámetros no válidos"
            ];
        }
        
        $retorno = ["alerta" => $alerta, "data" => $data];
        echo json_encode($retorno);
    }
    
    public function modificarAsistencia(){
        $alerta = null;
        $data = null;
        
        if (isset($_POST["consecutivo"])) {
            
            $asistio = isset($_POST["asistio"]) ? $_POST["asistio"] : [] ;
            $consecutivo = $_POST["consecutivo"];
            
            $asistencia_curso = new AsistenciaCurso();
            $asistencia_curso->setCONSECUTIVO($consecutivo);
            
            $estudiantes = $asistencia_curso->obtenerPorConsecutivo();
            
            foreach ($estudiantes as $estudiante) {
                $actualizar_asistencia = new AsistenciaCurso();
                $actualizar_asistencia->setSECUENCIA($estudiante->SECUENCIA);
                $actualizar_asistencia->setFECHA_ACTUALIZA(date('d/m/Y'));
                $actualizar_asistencia->setUSUARIO_ACTUALIZA(Session::get("usuario")["usuario"]);
                
                if (in_array($estudiante->SECUENCIA, $asistio)) {
                    $actualizar_asistencia->setASISTIO($actualizar_asistencia::ASISTIO);
                }else{
                    $actualizar_asistencia->setASISTIO($actualizar_asistencia::NO_ASISTIO);
                }
                
                $actualizar_asistencia->updateASISTENCIA();
            }
            
            $alerta = [
                "tipo" => "success",
                "mensaje" => "Asistencia modificada correctamente."
            ];
        }else{
            $alerta = [
                "tipo" => "danger",
                "mensaje" => "Parámetros no válidos."
            ];
        }
        
        $retorno = ["alerta" => $alerta, "data" => $data];
        echo json_encode($retorno);
    }

    public function eliminarAsistencia() {
        $alerta = null;
        $data = null;

        if (isset($_POST["consecutivo_eliminar_asistencia"]) && isset($_POST["fecha_eliminar_asistencia"])) {
            $fecha_eliminar_asistencia = $_POST["fecha_eliminar_asistencia"];
            $consecutivo_eliminar_asistencia = $_POST["consecutivo_eliminar_asistencia"];
            
            $asistencia_curso = new AsistenciaCurso();
            $asistencia_curso->setFECHA_ASISTENCIA($fecha_eliminar_asistencia);
            $asistencia_curso->setCONSECUTIVO($consecutivo_eliminar_asistencia);
            
            $registros_eliminados = $asistencia_curso->deleteAsistencia();
            
            if ($registros_eliminados) {
                $alerta = [
                    "tipo" => "success",
                    "mensaje" => "Se eliminó correctamente la asistencia de $registros_eliminados estudiantes para la fecha $fecha_eliminar_asistencia"
                ];
            }else{
                $alerta = [
                    "tipo" => "danger",
                    "mensaje" => "Error al eliminar la asistencia."
                ];
            }
            
        }else{            
            $alerta = [
                "tipo" => "danger",
                "mensaje" => "Parámetros no válidos."
            ];
        }
        
        $retorno = ["alerta" => $alerta, "data" => $data];
        echo json_encode($retorno);
    }

    public function oficializarAsistencia() {
        $alerta = null;
        $data = null;

        if (isset($_POST["consecutivo_oficializar_asistencia"]) && isset($_POST["fecha_oficializar_asistencia"])) {
            $fecha_oficializar_asistencia = $_POST["fecha_oficializar_asistencia"];
            $consecutivo_oficializar_asistencia = $_POST["consecutivo_oficializar_asistencia"];
            
            $asistencia_curso = new AsistenciaCurso();
            $asistencia_curso->setFECHA_ACTUALIZA(date('d/m/Y'));
            $asistencia_curso->setUSUARIO_ACTUALIZA(Session::get("usuario")["usuario"]);
            $asistencia_curso->setFECHA_OFICIALIZA(date('d/m/Y'));
            $asistencia_curso->setFECHA_ASISTENCIA($fecha_oficializar_asistencia);
            $asistencia_curso->setCONSECUTIVO($consecutivo_oficializar_asistencia);
            
            $registros_oficializados = $asistencia_curso->oficializarAsistencia();
            
            if ($registros_oficializados) {
                $alerta = [
                    "tipo" => "success",
                    "mensaje" => "Se oficializó correctamente la asistencia de $registros_oficializados estudiantes para la fecha $fecha_oficializar_asistencia"
                ];
            }else{
                $alerta = [
                    "tipo" => "danger",
                    "mensaje" => "Error al oficializar la asistencia."
                ];
            }
            
        }else{            
            $alerta = [
                "tipo" => "danger",
                "mensaje" => "Parámetros no válidos."
            ];
        }
        
        $retorno = ["alerta" => $alerta, "data" => $data];
        echo json_encode($retorno);
    }

}
