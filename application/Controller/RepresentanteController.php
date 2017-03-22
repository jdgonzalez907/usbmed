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

    public function postularme() {
        $this->loginUrl = 'usuario/iniciarSesion/representante/postularme';
        $this->verificarInicioSesion();

        $alerta = null;
        $grupoInteres = null;
        $facultad = null;
        $model = new Postulacion();
        $modelProgramacion = new Programacion();
        $modelProgramacion->getProgramacionActual();
        $fechaActual = strtotime(date('Y/m/d H:i:s'));

        if (!$modelProgramacion->getANNIO()) {
            $alerta = [
                'tipo' => 'warning',
                'mensaje' => 'En el momento ho hay fechas habilitadas para las postulaciones.'
            ];
        } else if ($fechaActual < strtotime($modelProgramacion->getFECHA_INICIO_INSCRIPCION()) || $fechaActual > strtotime($modelProgramacion->getFECHA_FIN_INSCRIPCION())) {
            $alerta = [
                'tipo' => 'warning',
                'mensaje' => 'No puede realizar la postulación porque la fecha actual no está entre las fechas de inscripciones.'
            ];
        } else {
            $model->setANNIO_ID(date('Y'));
            $model->setTIPO_IDENTIFICACION(Session::get('usuario')['info'][0]->TIPO_IDENTIFICACION);
            $model->setIDENTIFICACION(Session::get('usuario')['usuario']);
            $model->setNOMBRES(Session::get('usuario')['info'][0]->NOMBRES);
            $model->setCORREO(Session::get('usuario')['info'][0]->CORREO);
            $model->setTELEFONO(Session::get('usuario')['info'][0]->TELEFONO);
            $model->setESTADO('I');
            $model->setFECHA_POSTULACION(date('Y/m/d H:i:s'));

            if (!$model->existePostulacion()) {
                $informacion = Session::get('usuario')['info'];

                foreach ($informacion as $info) {
                    if ($info->GRUPO_INTERES === 'EGR') {
                        $grupoInteres[$info->GRUPO_INTERES] = ListaGlobal::getGrupoInteres($info->GRUPO_INTERES);

                        if ($info->GRUPO_INTERES === 'DOC' && is_numeric($info->FAC_DEP)) {
                            $info->FAC_DEP = ListaGlobal::getHomologacionFacultades($info->FAC_DEP);
                        }

                        $facultad[$info->GRUPO_INTERES][$info->FAC_DEP] = ListaGlobal::getFacultades($info->FAC_DEP);
                    }
                }

                if (empty($grupoInteres)) {
                    $alerta = [
                        'tipo' => 'warning',
                        'mensaje' => 'Usted no cuenta con el perfil <i>' . ListaGlobal::getGrupoInteres('EGR') . '</i> para poder realizar una postulación desde la web.'
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
                        $model->setPROPUESTA($_POST["Postulacion"]["PROPUESTA"]);

                        $extension = substr($_FILES["Postulacion"]["name"]["FOTO"], strpos($_FILES["Postulacion"]["name"]["FOTO"], '.'));

                        $carpetaRepresentante = '\img\\fotos\\representante\\' . date('Y') . '\\';

                        $directorio = ROOT . URL_PUBLIC_FOLDER . $carpetaRepresentante;
                        if (!is_dir($directorio)) {
                            mkdir($directorio, 0777, true);
                        }
                        $nombre_aleatorio = rand(10000, 99999);

                        move_uploaded_file($_FILES["Postulacion"]["tmp_name"]["FOTO"], $directorio . $nombre_aleatorio . $extension);

                        $model->setFOTO($carpetaRepresentante . $nombre_aleatorio . $extension);

                        if ($model->insert()) {
                            $alerta = [
                                'tipo' => 'success',
                                'mensaje' => 'Usted se ha postulado correctamente..<br><br>Plancha: #<strong>' . $model->getPOSTULACION_ID() . '</strong><br>Estado: <strong>' . ListaGlobal::getEstados($model->getESTADO()) . '</strong><br><br><strong>Nota:</strong> Recuerde que sus datos serán revisados y si cumple con los requisitos su plancha se habilitará y le será notificado.'
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
                'representante/postularme', [
            'alerta' => $alerta,
            'model' => $model,
            'grupoInteres' => $grupoInteres,
            'facultad' => $facultad
                ], 'login'
        );
    }

    public function actualizar() {
        $this->verificarPermisos();

        $model = new Postulacion();
        $dataProviderPosutlacion = [];
        $modelProgramacion = new Programacion();
        $modelProgramacion->getProgramacionActual();
        $fechaActual = strtotime(date('Y/m/d H:i:s'));
        $valido = false;

        $alerta = [
            'tipo' => 'info',
            'mensaje' => 'Por favor indique los filtros para proceder a buscar las planchas(año ' . date('Y') . ').'
        ];

        if (!$modelProgramacion->getANNIO()) {
            $alerta = [
                'tipo' => 'warning',
                'mensaje' => 'En el momento ho hay fechas habilitadas para las postulaciones.'
            ];
        } else if ($fechaActual < strtotime($modelProgramacion->getFECHA_INICIO_INSCRIPCION()) || $fechaActual > strtotime($modelProgramacion->getFECHA_FIN_INSCRIPCION())) {
            $alerta = [
                'tipo' => 'warning',
                'mensaje' => 'No puede realizar modificaciones a las planchas porque la fecha actual no está entre las fechas de inscripción.'
            ];
        } else {
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
                'representante/actualizar', [
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
        $alerta = null;

        $modelProgramacion = new Programacion();
        $modelProgramacion->getProgramacionActual();
        $fechaActual = strtotime(date('Y/m/d H:i:s'));
        $valido = false;

        $alerta = [
            'tipo' => 'info',
            'mensaje' => 'Por favor indique los filtros para proceder a buscar las planchas(año ' . date('Y') . ').'
        ];

        if (!$modelProgramacion->getANNIO()) {
            $alerta = [
                'tipo' => 'warning',
                'mensaje' => 'En el momento ho hay fechas habilitadas para las postulaciones.'
            ];
        } else if ($fechaActual < strtotime($modelProgramacion->getFECHA_INICIO_INSCRIPCION()) || $fechaActual > strtotime($modelProgramacion->getFECHA_FIN_INSCRIPCION())) {
            $alerta = [
                'tipo' => 'warning',
                'mensaje' => 'No puede crear planchas porque la fecha actual no está entre las fechas de inscripción.'
            ];
        } else {
            $valido = true;

            if (isset($_GET["Usuario"]["CEDULA"])) {
                $usuario->setCEDULA($_GET["Usuario"]["CEDULA"]);
                $personas = $usuario->getInfoPorCedula();

                if ($personas) {
                    $docente = null;
                    $egresado = null;
                    $estudiante = null;
                    foreach ($personas as $llave => $persona) {
                        if ($persona->GRUPO_INTERES === 'DOC') {
                            $docente = $persona;
                        } elseif ($persona->GRUPO_INTERES === 'EGR') {
                            $egresado = $persona;
                        } elseif ($persona->GRUPO_INTERES === 'EST') {
                            $estudiante = $persona;
                        }
                    }

                    $personas = null;

                    if ($docente) {
                        $personas[] = $docente;
                    } elseif ($egresado) {
                        $personas[] = $egresado;
                    } elseif ($estudiante) {
                        $personas[] = $estudiante;
                    }
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
                $model->setUSUARIO_ACTUALIZA(Session::get(Session::get('usuario')['usuario']));
                $model->setFECHA_ACTUALIZA(date('Y/m/d H:i:s'));
                $grupoInteres = [];
                $facultad = [];

                foreach ($info as $i) {
                    if ($i->GRUPO_INTERES === 'EST' || $i->GRUPO_INTERES === 'DOC') {
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
                            $model->setPROPUESTA($_POST["Postulacion"]["PROPUESTA"]);

                            $extension = substr($_FILES["Postulacion"]["name"]["FOTO"], strpos($_FILES["Postulacion"]["name"]["FOTO"], '.'));

                            $carpetaRepresentante = '\img\\fotos\\representante\\' . date('Y') . '\\';

                            $directorio = ROOT . URL_PUBLIC_FOLDER . $carpetaRepresentante;
                            if (!is_dir($directorio)) {
                                mkdir($directorio, 0777, true);
                            }
                            $nombre_aleatorio = rand(10000, 99999);

                            move_uploaded_file($_FILES["Postulacion"]["tmp_name"]["FOTO"], $directorio . $nombre_aleatorio . $extension);

                            $model->setFOTO($carpetaRepresentante . $nombre_aleatorio . $extension);

                            if ($model->insert()) {
                                $alerta = [
                                    'tipo' => 'success',
                                    'mensaje' => 'Usted se ha postulado correctamente..<br><br>Plancha: #<strong>' . $model->getPOSTULACION_ID() . '</strong><br>Estado: <strong>' . ListaGlobal::getEstados($model->getESTADO()) . '</strong><br><br><strong>Nota:</strong> Recuerde que sus datos serán revisados y si cumple con los requisitos su plancha se habilitará y le será notificado.'
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

        View::render('representante/reportes', []);
    }

}
