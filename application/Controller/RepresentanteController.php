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
use Mini\Model\Programacion;
use Mini\Model\Postulacion;
use Mini\Model\ListaGlobal;
use Mini\Model\Usuario;
use Mini\Model\Voto;
use mPDF;

/**
 * Description of RepresentanteController
 *
 * @author ingeniero.analista1
 */
class RepresentanteController extends Controller {

    public $loginUrl = 'usuario/iniciarSesion/representante';

    public function index() {
        $this->verificarPermisos();

        View::render('representante/index');
    }

    public function programacion() {
        $this->verificarPermisos();

        $alerta = null;

        $model = new Programacion();
        $tieneProgramacion = $model->getProgramacionActual();

        if ($tieneProgramacion) {
            $alerta = [
                'tipo' => 'info',
                'mensaje' => 'A continuación se muestra la programación ya creada para el presente año.'
            ];
        }

        if (isset($_POST["Programacion"])) {
            $valido = true;

            $model->setFECHA_INICIO_INSCRIPCION($_POST["Programacion"]["FECHA_INICIO_INSCRIPCION"]);
            $model->setFECHA_FIN_INSCRIPCION($_POST["Programacion"]["FECHA_FIN_INSCRIPCION"]);
            $model->setFECHA_INICIO_VOTACION($_POST["Programacion"]["FECHA_INICIO_VOTACION"]);
            $model->setFECHA_FIN_VOTACION($_POST["Programacion"]["FECHA_FIN_VOTACION"]);

            if (strtotime($model->getFECHA_FIN_INSCRIPCION()) < strtotime($model->getFECHA_INICIO_INSCRIPCION())) {
                $valido = false;
                $alerta = [
                    'tipo' => 'warning',
                    'mensaje' => 'La fecha <i>fin de inscripción</i> <strong>no puede ser menor</strong> a la fecha <i>inicio inscripción</i>.'
                ];
            }

            if (strtotime($model->getFECHA_INICIO_VOTACION()) < strtotime($model->getFECHA_FIN_INSCRIPCION())) {
                $valido = false;
                $alerta = [
                    'tipo' => 'warning',
                    'mensaje' => 'La fecha <i>inicio de votación</i> <strong>no puede ser menor</strong> a la fecha <i>fin inscripción</i>.'
                ];
            }

            if (strtotime($model->getFECHA_FIN_VOTACION()) < strtotime($model->getFECHA_INICIO_VOTACION())) {
                $valido = false;
                $alerta = [
                    'tipo' => 'warning',
                    'mensaje' => 'La fecha <i>fin de votación</i> <strong>no puede ser menor</strong> a la fecha <i>inicio votación</i>.'
                ];
            }

            if ($valido) {
                if ($tieneProgramacion) {
                    $model->setUSUARIO_ACTUALIZA(Session::get('usuario')['usuario']);
                    $model->setFECHA_ACTUALIZA(date('Y/m/d H:i:s'));

                    if ($model->update()) {
                        $alerta = [
                            'tipo' => 'success',
                            'mensaje' => 'Programación <strong>actualizada</strong>.'
                        ];
                    } else {
                        $alerta = [
                            'tipo' => 'danger',
                            'mensaje' => 'Ocurrió un error, contácte al administrador del sistema.'
                        ];
                    }
                } else {
                    $model->setANNIO(date('Y'));
                    $model->setUSUARIO_CREA(Session::get('usuario')['usuario']);
                    $model->setFECHA_CREA(date('Y/m/d H:i:s'));

                    if ($model->insert()) {
                        $alerta = [
                            'tipo' => 'success',
                            'mensaje' => 'Programación <strong>creada</strong>.'
                        ];
                    } else {
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

    public function cargar() {
        $this->verificarPermisos();

        $alerta = [
            'tipo' => 'info',
            'mensaje' => 'Recuerde que la extensión del archivo debe ser .CSV y debe tener solo un campo que será la Identificación de la persona.'
        ];

        $model = new Voto();
        $modelProgramacion = new Programacion();
        $valido = false;

        $alerta = $modelProgramacion->fechaActualEn('INS');

        if (!$alerta) {
            $valido = true;
            if (isset($_FILES["Voto"])) {
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary");
                header("Content-disposition: attachment; filename=\"resultado_carga_votantes.csv\"");
                set_time_limit(1200);

                $outputBuffer = fopen("php://output", 'w');

                $temporal = file($_FILES["Voto"]["tmp_name"]["VOTANTE"]);

                foreach ($temporal as $i => $registro) {
                    $mensajeCSV = [];
                    if ($i > 0) {
                        $fila = explode(';', $registro);

                        if (isset($fila[0])) {
                            $identificacion = trim($fila[0]);

                            $persona = new Usuario();
                            $persona->setCEDULA($identificacion);

                            $informacion = $persona->getInfoPorCedula();

                            $mensajeCSV[] = $identificacion;

                            if ($informacion) {
                                foreach ($informacion as $p => $info) {
                                    if ($info->GRUPO_INTERES !== 'ADM') {
                                        $crearVoto = new Voto();

                                        $crearVoto->setANNIO_ID(date('Y'));
                                        $crearVoto->setVOTANTE($info->IDENTIFICACION);
                                        $crearVoto->setESTADO(($info->GRUPO_INTERES === 'EGR') ? 'A' : 'I');
                                        $crearVoto->setGRUPO_INTERES($info->GRUPO_INTERES);

                                        $yaTieneVotoConfigurado = $crearVoto->getUnico();

                                        if ($yaTieneVotoConfigurado) {
                                            $mensajeCSV[] = 'Advertencia: Para el grupo de interés: ' . $crearVoto->getGRUPO_INTERES() . ' ya tiene un voto configurado.';
                                        } elseif ($crearVoto->insert()) {
                                            $mensajeCSV[] = 'Éxito: Se configuró exitosamente un voto para el grupo de interés: ' . $crearVoto->getGRUPO_INTERES() . '.';
                                        } else {
                                            $mensajeCSV[] = 'Error: Ocurrió un error en el sistema, por favor contácte al administrador.';
                                        }
                                    } else {
                                        $mensajeCSV[] = 'Error: La identificación suministrada no cumple con los roles para poder participar.';
                                    }
                                }
                            } else {
                                $mensajeCSV[] = 'Error: No se encuentra información asociada. Por favor contácte al administrador.';
                            }
                        } else {
                            $mensajeCSV[] = 'Error: No ingresó una identificación.';
                        }
                    } else {
                        $mensajeCSV[] = 'IDENTIFICACIÓN';
                        $mensajeCSV[] = 'MENSAJES';
                    }

                    fputcsv($outputBuffer, array_map("utf8_decode", $mensajeCSV), ';');
                }

                fclose($outputBuffer);

                exit;
            }
        }

        View::render('representante/cargar', ['alerta' => $alerta, 'model' => $model, 'valido' => $valido]);
    }

    public function postularme() {
        $this->loginUrl = 'usuario/iniciarSesion/representante/postularme';
        $this->verificarInicioSesion();

        $grupoInteres = null;
        $facultad = null;
        $model = new Postulacion();
        $modelProgramacion = new Programacion();
        $alerta = $modelProgramacion->fechaActualEn('INS');

        if (!$alerta) {
            $informacion = Session::get('usuario')['info'];

            $model->setANNIO_ID(date('Y'));
            $model->setTIPO_IDENTIFICACION(Session::get('usuario')['info'][0]->TIPO_IDENTIFICACION);
            $model->setIDENTIFICACION(Session::get('usuario')['usuario']);
            $model->setNOMBRES(Session::get('usuario')['info'][0]->NOMBRES);
            $model->setCORREO(Session::get('usuario')['info'][0]->CORREO);
            $model->setTELEFONO(Session::get('usuario')['info'][0]->TELEFONO);
            $model->setESTADO('I');
            $model->setFECHA_POSTULACION(date('Y/m/d H:i:s'));

            if (!$model->existePostulacion()) {
                foreach ($informacion as $info) {
                    if ($info->GRUPO_INTERES !== 'ADM') {
                        $grupoInteres[$info->GRUPO_INTERES] = ListaGlobal::getGrupoInteres($info->GRUPO_INTERES);

                        if ($info->GRUPO_INTERES === 'DOC' && is_numeric($info->FAC_DEP)) {
                            $info->FAC_DEP = ListaGlobal::getHomologacionFacultades($info->FAC_DEP);
                        }

                        if (count(ListaGlobal::getFacultades($info->FAC_DEP)) > 1) {
                            continue;
                        }
                        $facultad[$info->GRUPO_INTERES][$info->FAC_DEP] = ListaGlobal::getFacultades($info->FAC_DEP);

                    }
                }
                
                if (empty($grupoInteres)) {
                    $alerta = [
                        'tipo' => 'warning',
                        'mensaje' => 'Usted no cuenta con el perfil para poder realizar una postulación desde la web.'
                    ];
                }

                if (isset($_POST["Postulacion"]) && isset($_FILES["Postulacion"])) {
                    if (ListaGlobal::getGrupoInteres($_POST["Postulacion"]["GRUPO_INTERES"]) &&
                            isset($grupoInteres[$_POST["Postulacion"]["GRUPO_INTERES"]]) &&
                            isset($facultad[$_POST["Postulacion"]["GRUPO_INTERES"]][$_POST["Postulacion"]["FACULTAD"]])
                    ) {
                        $model->setANNIO_ID(date('Y'));
                        $model->setGRUPO_INTERES($_POST["Postulacion"]["GRUPO_INTERES"]);
                        $model->setFACULTAD($_POST["Postulacion"]["FACULTAD"]);
                        $model->setCORREO($_POST["Postulacion"]["CORREO"]);
                        $model->setTELEFONO($_POST["Postulacion"]["TELEFONO"]);
                        $model->setOBSERVACIONES($model::OBSERVACION_DEFAULT);

                        $extension = substr($_FILES["Postulacion"]["name"]["FOTO"], strpos($_FILES["Postulacion"]["name"]["FOTO"], '.'));

                        $carpetaRepresentante = '\img\\fotos\\representante\\' . date('Y') . '\\';

                        $directorio = ROOT . URL_PUBLIC_FOLDER . $carpetaRepresentante;
                        if (!is_dir($directorio)) {
                            mkdir($directorio, 0777, true);
                        }

                        move_uploaded_file($_FILES["Postulacion"]["tmp_name"]["FOTO"], $directorio . $model->getIDENTIFICACION() . $extension);

                        $model->setFOTO($carpetaRepresentante . $model->getIDENTIFICACION() . $extension);

                        if ($model->insert()) {
                            $model->enviarActualizacionPlancha();
                            $alerta = [
                                'tipo' => 'success',
                                'mensaje' => 'Usted se ha postulado correctamente..<br><br>Plancha: #<strong>' . $model->getPOSTULACION_ID() . '</strong><br>Estado: <strong>' . ListaGlobal::getEstados($model->getESTADO()) . '</strong><br><br><strong>Nota:</strong> Recuerde que sus datos serán revisados y si cumple con los requisitos su plancha se habilitará y le será notificado por correo.'
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
                            'mensaje' => 'Verifique los datos <strong>Grupo de interés y Facultad</strong>.'
                        ];
                    }
                }
            } else {
                $alerta = [
                    'tipo' => 'info',
                    'mensaje' => 'Para el presente año, usted ya se encuentra registrado como postulante.<br><br>Plancha: #<strong>' . $model->getPOSTULACION_ID() . '</strong><br>Estado: <strong>' . ListaGlobal::getEstados($model->getESTADO()) . '</strong>'
                ];
            }
        }


        View::render(
                'representante/postularme', 
                [
                    'alerta' => $alerta,
                    'model' => $model,
                    'grupoInteres' => $grupoInteres,
                    'facultad' => $facultad
                ]
        );
    }

    public function actualizar() {
        $this->verificarPermisos();

        $model = new Postulacion();
        $dataProviderPosutlacion = [];
        $valido = false;

        $modelProgramacion = new Programacion();
        $alerta = $modelProgramacion->fechaActualEn('INS');

        if (!$alerta) {
            $alerta = [
                'tipo' => 'info',
                'mensaje' => 'Por favor indique los filtros para proceder a buscar las planchas(año ' . date('Y') . ').'
            ];

            $valido = true;

            if (isset($_GET["Postulacion"])) {
                $alerta = null;

                $model->setANNIO_ID(date('Y'));
                $model->setGRUPO_INTERES($_GET["Postulacion"]["GRUPO_INTERES"]);
                $model->setFACULTAD($_GET["Postulacion"]["FACULTAD"]);

                $dataProviderPosutlacion = $model->getPlanchas();
            }
        }

        View::render(
            'representante/actualizar', 
            [
                'model' => $model,
                'alerta' => $alerta,
                'dataProviderPosutlacion' => $dataProviderPosutlacion,
                'valido' => $valido
            ]
        );
    }

    public function crear() {
        $this->verificarPermisos();

        $usuario = new Usuario();
        $personas = [];

        $modelProgramacion = new Programacion();
        $alerta = $modelProgramacion->fechaActualEn('INS');

        $valido = false;

        if (!$alerta) {
            $alerta = [
                'tipo' => 'info',
                'mensaje' => 'Por favor indique los filtros para proceder a buscar las planchas(año ' . date('Y') . ').'
            ];

            $valido = true;

            if (isset($_GET["Usuario"]["CEDULA"])) {
                $alerta = null;
                $usuario->setCEDULA($_GET["Usuario"]["CEDULA"]);
                $informacion = $usuario->getInfoPorCedula();

                foreach ($informacion as $llave => $persona) {
                    if ($persona->GRUPO_INTERES !== 'ADM') {
                        $personas[0] = $persona;
                    }
                }

                if (empty($personas)) {
                    $alerta = [
                        'tipo' => 'danger',
                        'mensaje' => 'El usuario NO presenta los roles necesarios para poder participar en la elección de representante.'
                    ];
                }
            }
        }

        View::render('representante/crear', ['personas' => $personas, 'usuario' => $usuario, 'valido' => $valido, 'alerta' => $alerta]);
    }

    public function actualizarPlancha($id) {
        if ($this->isAjax()) {
            if (!$this->verificarPermisos(false)) {
                View::render('control/error403', [], '');
            } else {
                $alerta = null;
                $model = new Postulacion();

                $model->setPOSTULACION_ID($id);
                if (!$model->getPlancha()) {
                    $alerta = [
                        'tipo' => 'danger',
                        'mensaje' => 'La plancha #' . $id . ' no se encuentra en la base de datos.'
                    ];
                } else {
                    if (isset($_POST["Postulacion"])) {
                        $model->setESTADO($_POST["Postulacion"]["ESTADO"]);
                        $model->setOBSERVACIONES($_POST["Postulacion"]["OBSERVACIONES"]);
                        $model->setUSUARIO_ACTUALIZA(Session::get('usuario')['usuario']);
                        $model->setFECHA_ACTUALIZA(date('Y/m/d H:i:s'));

                        if ($model->update()) {
                            $model->enviarActualizacionPlancha();
                            $alerta = [
                                'tipo' => 'success',
                                'mensaje' => 'Plancha <strong>actualizada</strong> correctamente. <br><br> Refrescando los datos, espere por favor...'
                            ];
                        } else {
                            $alerta = [
                                'tipo' => 'danger',
                                'mensaje' => 'Ocurrió un error, contácte al administrador del sistema.'
                            ];
                        }
                    }
                }

                View::render('representante/actualizarPlancha', ['id' => $id, 'model' => $model, 'alerta' => $alerta], '');
            }
        } else {
            View::redirect('control/error400');
        }
    }

    public function crearPlancha($id) {
        if ($this->isAjax()) {
            if (!$this->verificarPermisos(false)) {
                View::render('control/error403', [], '');
            } else {
                $alerta = null;
                $model = new Postulacion();
                $usuario = new Usuario();
                $usuario->setCEDULA($id);
                $info = $usuario->getInfoPorCedula();

                $model->setANNIO_ID(date('Y'));
                $model->setTIPO_IDENTIFICACION($info[0]->TIPO_IDENTIFICACION);
                $model->setIDENTIFICACION($info[0]->IDENTIFICACION);
                $model->setNOMBRES($info[0]->NOMBRES);
                $model->setCORREO($info[0]->CORREO);
                $model->setTELEFONO($info[0]->TELEFONO);
                $model->setESTADO('I');
                $model->setFECHA_POSTULACION(date('Y/m/d H:i:s'));
                $model->setUSUARIO_ACTUALIZA(Session::get('usuario')['usuario']);
                $model->setOBSERVACIONES($model::OBSERVACION_DEFAULT);
                $model->setFECHA_ACTUALIZA(date('Y/m/d H:i:s'));
                $grupoInteres = [];
                $facultad = [];

                foreach ($info as $i) {
                    if ($i->GRUPO_INTERES !== 'ADM') {
                        $grupoInteres[$i->GRUPO_INTERES] = ListaGlobal::getGrupoInteres($i->GRUPO_INTERES);

                        if ($i->GRUPO_INTERES === 'DOC' && is_numeric($i->FAC_DEP)) {
                            $i->FAC_DEP = ListaGlobal::getHomologacionFacultades($i->FAC_DEP);
                        }

                        $facultad[$i->GRUPO_INTERES][$i->FAC_DEP] = ListaGlobal::getFacultades($i->FAC_DEP);
                    }
                }

                if ($model->getPlanchaPorIdentificacion()) {
                    $alerta = [
                        'tipo' => 'danger',
                        'mensaje' => 'Ya existe una plancha para la identificación suministrada.'
                    ];
                } else {
                    if (isset($_POST["Postulacion"]) && isset($_FILES["Postulacion"])) {
                        if (ListaGlobal::getGrupoInteres($_POST["Postulacion"]["GRUPO_INTERES"]) &&
                                isset($grupoInteres[$_POST["Postulacion"]["GRUPO_INTERES"]]) &&
                                isset($facultad[$_POST["Postulacion"]["GRUPO_INTERES"]][$_POST["Postulacion"]["FACULTAD"]])
                        ) {
                            $model->setANNIO_ID(date('Y'));
                            $model->setGRUPO_INTERES($_POST["Postulacion"]["GRUPO_INTERES"]);
                            $model->setFACULTAD($_POST["Postulacion"]["FACULTAD"]);
                            $model->setCORREO($_POST["Postulacion"]["CORREO"]);
                            $model->setTELEFONO($_POST["Postulacion"]["TELEFONO"]);
                            $model->setESTADO($_POST["Postulacion"]["ESTADO"]);
                            $model->setOBSERVACIONES($_POST["Postulacion"]["OBSERVACIONES"]);

                            $extension = substr($_FILES["Postulacion"]["name"]["FOTO"], strpos($_FILES["Postulacion"]["name"]["FOTO"], '.'));

                            $carpetaRepresentante = '\img\\fotos\\representante\\' . date('Y') . '\\';

                            $directorio = ROOT . URL_PUBLIC_FOLDER . $carpetaRepresentante;
                            if (!is_dir($directorio)) {
                                mkdir($directorio, 0777, true);
                            }

                            move_uploaded_file($_FILES["Postulacion"]["tmp_name"]["FOTO"], $directorio . $model->getIDENTIFICACION() . $extension);

                            $model->setFOTO($carpetaRepresentante . $model->getIDENTIFICACION() . $extension);

                            if ($model->insert()) {
                                $model->enviarActualizacionPlancha();
                                $alerta = [
                                    'tipo' => 'success',
                                    'mensaje' => 'Usted se ha postulado correctamente..<br><br>Plancha: #<strong>' . $model->getPOSTULACION_ID() . '</strong><br>Estado: <strong>' . ListaGlobal::getEstados($model->getESTADO()) . '</strong><br><br><strong>Nota:</strong> Recuerde que sus datos serán revisados y si cumple con los requisitos su plancha se habilitará y le será notificado por correo.'
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
                                'mensaje' => 'Verifique los datos <strong>Grupo de interés y Facultad</strong>.'
                            ];
                        }
                    }
                }

                View::render('representante/crearPlancha', ['id' => $id, 'model' => $model, 'alerta' => $alerta, 'grupoInteres' => $grupoInteres, 'facultad' => $facultad], '');
            }
        } else {
            View::redirect('control/error400');
        }
    }

    public function reportes() {
        $this->verificarPermisos();

        View::render('representante/reportes');
    }

    public function reportePlanchas($tipo) {
        $this->verificarPermisos();
        $postulacion = new Postulacion();

        $postulacion->setANNIO_ID(date('Y'));

        $planchas = $postulacion->consultarPlanchas();

        ob_start();
        View::render('representante/reportePlanchas', ['planchas' => $planchas, 'tipo' => $tipo], []);
        $html = ob_get_contents();
        ob_clean();

        $nombreArchivo = 'Reporte_de_planchas_' . date('Y');

        switch ($tipo) {
            case 'pdf':
                $mpdf = new mPDF('c', 'A4', 10, '', 15, 15, 30, 10);
                $mpdf->SetHeader('Univesridad San Buenaventura de Medellín||Elección de representantes ' . date('Y'));
                $mpdf->setFooter('|{PAGENO}|');
                $mpdf->WriteHTML($html);

                $mpdf->Output($nombreArchivo, 'D');
                break;

            case 'excel':
                header("Content-Encoding: UTF-8");
                header("Content-type: application/vnd.ms-excel; charset=utf-8");
                header("Content-Disposition: attachment; filename=$nombreArchivo");
                echo utf8_decode($html);
                break;

            default:
                break;
        }
    }

}
