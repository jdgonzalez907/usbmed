<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Core\View;

/**
 * Description of Postulacion
 *
 * @author ingeniero.analista1
 */
class Postulacion extends Model {

    const OBSERVACION_DEFAULT = 'Se creó la plancha exitosamente. Se procederá a verificar los datos.';

    private $POSTULACION_ID;
    private $ANNIO_ID;
    private $GRUPO_INTERES;
    private $FACULTAD;
    private $TIPO_IDENTIFICACION;
    private $IDENTIFICACION;
    private $NOMBRES;
    private $CORREO;
    private $TELEFONO;
    private $ESTADO;
    private $FOTO;
    private $OBSERVACIONES;
    private $USUARIO_ACTUALIZA;
    private $FECHA_ACTUALIZA;
    private $FECHA_POSTULACION;

    public function getPOSTULACION_ID() {
        return $this->POSTULACION_ID;
    }

    public function getANNIO_ID() {
        return $this->ANNIO_ID;
    }

    public function getGRUPO_INTERES() {
        return $this->GRUPO_INTERES;
    }

    public function getFACULTAD() {
        return $this->FACULTAD;
    }

    public function getTIPO_IDENTIFICACION() {
        return $this->TIPO_IDENTIFICACION;
    }

    public function getIDENTIFICACION() {
        return $this->IDENTIFICACION;
    }

    public function getNOMBRES() {
        return $this->NOMBRES;
    }

    public function getCORREO() {
        return $this->CORREO;
    }

    public function getTELEFONO() {
        return $this->TELEFONO;
    }

    public function getESTADO() {
        return $this->ESTADO;
    }

    public function getFOTO() {
        return $this->FOTO;
    }

    public function getOBSERVACIONES() {
        return $this->OBSERVACIONES;
    }

    public function getUSUARIO_ACTUALIZA() {
        return $this->USUARIO_ACTUALIZA;
    }

    public function getFECHA_ACTUALIZA() {
        return $this->FECHA_ACTUALIZA;
    }

    public function getFECHA_POSTULACION() {
        return $this->FECHA_POSTULACION;
    }

    public function setPOSTULACION_ID($POSTULACION_ID) {
        $this->POSTULACION_ID = $POSTULACION_ID;
    }

    public function setANNIO_ID($ANNIO_ID) {
        $this->ANNIO_ID = $ANNIO_ID;
    }

    public function setGRUPO_INTERES($GRUPO_INTERES) {
        $this->GRUPO_INTERES = $GRUPO_INTERES;
    }

    public function setFACULTAD($FACULTAD) {
        $this->FACULTAD = $FACULTAD;
    }

    public function setTIPO_IDENTIFICACION($TIPO_IDENTIFICACION) {
        $this->TIPO_IDENTIFICACION = $TIPO_IDENTIFICACION;
    }

    public function setIDENTIFICACION($IDENTIFICACION) {
        $this->IDENTIFICACION = $IDENTIFICACION;
    }

    public function setNOMBRES($NOMBRES) {
        $this->NOMBRES = $NOMBRES;
    }

    public function setCORREO($CORREO) {
        $this->CORREO = $CORREO;
    }

    public function setTELEFONO($TELEFONO) {
        $this->TELEFONO = $TELEFONO;
    }

    public function setESTADO($ESTADO) {
        $this->ESTADO = $ESTADO;
    }

    public function setFOTO($FOTO) {
        $this->FOTO = $FOTO;
    }

    public function setOBSERVACIONES($OBSERVACIONES) {
        $this->OBSERVACIONES = $OBSERVACIONES;
    }

    public function setUSUARIO_ACTUALIZA($USUARIO_ACTUALIZA) {
        $this->USUARIO_ACTUALIZA = $USUARIO_ACTUALIZA;
    }

    public function setFECHA_ACTUALIZA($FECHA_ACTUALIZA) {
        $this->FECHA_ACTUALIZA = $FECHA_ACTUALIZA;
    }

    public function setFECHA_POSTULACION($FECHA_POSTULACION) {
        $this->FECHA_POSTULACION = $FECHA_POSTULACION;
    }

    public function existePostulacion() {
        $sql = "select "
                . "* "
                . "from MU_REP_POSTULACION "
                . "where ANNIO_ID = :annio_id and "
                . "TIPO_IDENTIFICACION = :tipo_identificacion and "
                . "IDENTIFICACION = :identificacion";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':annio_id' => $this->getANNIO_ID(),
            ':tipo_identificacion' => $this->getTIPO_IDENTIFICACION(),
            ':identificacion' => $this->getIDENTIFICACION()
        ];

        $query->execute($parametros);

        $resultado = $query->fetch();

        if (!empty($resultado)) {
            $this->setPOSTULACION_ID($resultado->POSTULACION_ID);
            $this->setANNIO_ID($resultado->ANNIO_ID);
            $this->setGRUPO_INTERES($resultado->GRUPO_INTERES);
            $this->setFACULTAD($resultado->FACULTAD);
            $this->setTIPO_IDENTIFICACION($resultado->TIPO_IDENTIFICACION);
            $this->setIDENTIFICACION($resultado->IDENTIFICACION);
            $this->setNOMBRES($resultado->NOMBRES);
            $this->setCORREO($resultado->CORREO);
            $this->setTELEFONO($resultado->TELEFONO);
            $this->setESTADO($resultado->ESTADO);
            $this->setFOTO($resultado->FOTO);
            $this->setOBSERVACIONES($resultado->OBSERVACIONES);
            $this->setUSUARIO_ACTUALIZA($resultado->USUARIO_ACTUALIZA);
            $this->setFECHA_ACTUALIZA($resultado->FECHA_ACTUALIZA);
            $this->setFECHA_POSTULACION($resultado->FECHA_POSTULACION);

            return true;
        } else {
            return false;
        }
    }

    public function insert() {
        $sql = "select SQ_REP_POSTULACION.nextval as POSTULACION_ID from DUAL";

        $query = $this->db->prepare($sql);
        $query->execute();
        $this->setPOSTULACION_ID($query->fetch()->POSTULACION_ID);

        $sql = "insert into MU_REP_POSTULACION ("
                . "POSTULACION_ID, "
                . "ANNIO_ID, "
                . "GRUPO_INTERES, "
                . "FACULTAD, "
                . "TIPO_IDENTIFICACION, "
                . "IDENTIFICACION, "
                . "NOMBRES, "
                . "CORREO, "
                . "TELEFONO, "
                . "ESTADO, "
                . "FOTO, "
                . "FECHA_POSTULACION, "
                . "USUARIO_ACTUALIZA, "
                . "FECHA_ACTUALIZA,"
                . "OBSERVACIONES) values ("
                . ":postulacion_id, "
                . ":annio_id, "
                . ":grupo_interes, "
                . ":facultad, "
                . ":tipo_identificacion, "
                . ":identificacion, "
                . ":nombres, "
                . ":correo, "
                . ":telefono, "
                . ":estado, "
                . ":foto, "
                . "TO_DATE(:fecha_postulacion, 'YYYY/MM/DD HH24:MI:SS'),"
                . ":usuario_actualiza,"
                . "TO_DATE(:fecha_actualiza, 'YYYY/MM/DD HH24:MI:SS'),"
                . ":observaciones"
                . ")";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':postulacion_id' => $this->getPOSTULACION_ID(),
            ':annio_id' => $this->getANNIO_ID(),
            ':grupo_interes' => $this->getGRUPO_INTERES(),
            ':facultad' => $this->getFACULTAD(),
            ':tipo_identificacion' => $this->getTIPO_IDENTIFICACION(),
            ':identificacion' => $this->getIDENTIFICACION(),
            ':nombres' => $this->getNOMBRES(),
            ':correo' => $this->getCORREO(),
            ':telefono' => $this->getTELEFONO(),
            ':estado' => $this->getESTADO(),
            ':foto' => $this->getFOTO(),
            ':fecha_postulacion' => $this->getFECHA_POSTULACION(),
            ':usuario_actualiza' => $this->getUSUARIO_ACTUALIZA(),
            ':fecha_actualiza' => $this->getFECHA_ACTUALIZA(),
            ':observaciones' => $this->getOBSERVACIONES()
        ];

        $query->execute($parametros);

        return $query->rowCount();
    }

    public function update() {
        $sql = "update MU_REP_POSTULACION set "
                . "POSTULACION_ID = :postulacion_id, "
                . "ANNIO_ID = :annio_id, "
                . "GRUPO_INTERES = :grupo_interes, "
                . "FACULTAD= :facultad, "
                . "TIPO_IDENTIFICACION = :tipo_identificacion, "
                . "IDENTIFICACION = :identificacion, "
                . "NOMBRES = :nombres, "
                . "CORREO = :correo, "
                . "TELEFONO = :telefono, "
                . "ESTADO = :estado, "
                . "FOTO = :foto, "
                . "OBSERVACIONES = :observaciones, "
                . "USUARIO_ACTUALIZA = :usuario_actualiza, "
                . "FECHA_ACTUALIZA = TO_DATE(:fecha_actualiza , 'YYYY/MM/DD HH24:MI:SS'),"
                . "FECHA_POSTULACION = TO_DATE(:fecha_postulacion , 'YYYY/MM/DD HH24:MI:SS') "
                . "where "
                . "POSTULACION_ID = :postulacion_id";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':postulacion_id' => $this->getPOSTULACION_ID(),
            ':annio_id' => $this->getANNIO_ID(),
            ':grupo_interes' => $this->getGRUPO_INTERES(),
            ':facultad' => $this->getFACULTAD(),
            ':tipo_identificacion' => $this->getTIPO_IDENTIFICACION(),
            ':identificacion' => $this->getIDENTIFICACION(),
            ':nombres' => $this->getNOMBRES(),
            ':correo' => $this->getCORREO(),
            ':telefono' => $this->getTELEFONO(),
            ':estado' => $this->getESTADO(),
            ':foto' => $this->getFOTO(),
            ':observaciones' => $this->getOBSERVACIONES(),
            ':usuario_actualiza' => $this->getUSUARIO_ACTUALIZA(),
            ':fecha_actualiza' => $this->getFECHA_ACTUALIZA(),
            ':fecha_postulacion' => $this->getFECHA_POSTULACION()
        ];
        $query->execute($parametros);

        return $query->rowCount();
    }

    public function getPlanchas() {
        $sql = "select "
                . "POSTULACION_ID, "
                . "ANNIO_ID, "
                . "GRUPO_INTERES, "
                . "FACULTAD, "
                . "TIPO_IDENTIFICACION, "
                . "IDENTIFICACION, "
                . "NOMBRES, "
                . "CORREO, "
                . "TELEFONO, "
                . "ESTADO, "
                . "FOTO, "
                . "OBSERVACIONES, "
                . "USUARIO_ACTUALIZA, "
                . "TO_CHAR(FECHA_ACTUALIZA , 'YYYY/MM/DD HH24:MI:SS') FECHA_ACTUALIZA, "
                . "TO_CHAR(FECHA_POSTULACION , 'YYYY/MM/DD HH24:MI:SS') FECHA_POSTULACION "
                . "from "
                . "MU_REP_POSTULACION "
                . "where "
                . "ANNIO_ID = :annio "
                . "and GRUPO_INTERES = :grupo_interes "
                . "and FACULTAD = :facultad";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':annio' => $this->getANNIO_ID(),
            ':grupo_interes' => $this->getGRUPO_INTERES(),
            ':facultad' => $this->getFACULTAD()
        ];

        $query->execute($parametros);

        return $query->fetchAll();
    }

    public function getPlancha() {
        $sql = "select "
                . "POSTULACION_ID, "
                . "ANNIO_ID, "
                . "GRUPO_INTERES, "
                . "FACULTAD, "
                . "TIPO_IDENTIFICACION, "
                . "IDENTIFICACION, "
                . "NOMBRES, "
                . "CORREO, "
                . "TELEFONO, "
                . "ESTADO, "
                . "FOTO, "
                . "OBSERVACIONES, "
                . "USUARIO_ACTUALIZA, "
                . "TO_CHAR(FECHA_ACTUALIZA , 'YYYY/MM/DD HH24:MI:SS') FECHA_ACTUALIZA, "
                . "TO_CHAR(FECHA_POSTULACION , 'YYYY/MM/DD HH24:MI:SS') FECHA_POSTULACION "
                . "from "
                . "MU_REP_POSTULACION "
                . "where "
                . "POSTULACION_ID = :postulacion_id";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':postulacion_id' => $this->getPOSTULACION_ID(),
        ];

        $query->execute($parametros);

        $resultado = $query->fetch();

        if (!empty($resultado)) {
            $this->setPOSTULACION_ID($resultado->POSTULACION_ID);
            $this->setANNIO_ID($resultado->ANNIO_ID);
            $this->setGRUPO_INTERES($resultado->GRUPO_INTERES);
            $this->setFACULTAD($resultado->FACULTAD);
            $this->setTIPO_IDENTIFICACION($resultado->TIPO_IDENTIFICACION);
            $this->setIDENTIFICACION($resultado->IDENTIFICACION);
            $this->setNOMBRES($resultado->NOMBRES);
            $this->setCORREO($resultado->CORREO);
            $this->setTELEFONO($resultado->TELEFONO);
            $this->setESTADO($resultado->ESTADO);
            $this->setFOTO($resultado->FOTO);
            $this->setOBSERVACIONES($resultado->OBSERVACIONES);
            $this->setUSUARIO_ACTUALIZA($resultado->USUARIO_ACTUALIZA);
            $this->setFECHA_ACTUALIZA($resultado->FECHA_ACTUALIZA);
            $this->setFECHA_POSTULACION(($resultado->FECHA_POSTULACION));

            return true;
        } else {
            return false;
        }
    }

    public function getPlanchaPorIdentificacion() {
        $sql = "select "
                . "POSTULACION_ID, "
                . "ANNIO_ID, "
                . "GRUPO_INTERES, "
                . "FACULTAD, "
                . "TIPO_IDENTIFICACION, "
                . "IDENTIFICACION, "
                . "NOMBRES, "
                . "CORREO, "
                . "TELEFONO, "
                . "ESTADO, "
                . "FOTO, "
                . "OBSERVACIONES, "
                . "USUARIO_ACTUALIZA, "
                . "TO_CHAR(FECHA_ACTUALIZA , 'YYYY/MM/DD HH24:MI:SS') FECHA_ACTUALIZA, "
                . "TO_CHAR(FECHA_POSTULACION , 'YYYY/MM/DD HH24:MI:SS') FECHA_POSTULACION "
                . "from "
                . "MU_REP_POSTULACION "
                . "where "
                . "IDENTIFICACION = :identificacion "
                . "and ANNIO_ID = :annio_id";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':identificacion' => $this->getIDENTIFICACION(),
            ':annio_id' => $this->getANNIO_ID()
        ];

        $query->execute($parametros);

        $resultado = $query->fetch();

        if (!empty($resultado)) {
            $this->setPOSTULACION_ID($resultado->POSTULACION_ID);
            $this->setANNIO_ID($resultado->ANNIO_ID);
            $this->setGRUPO_INTERES($resultado->GRUPO_INTERES);
            $this->setFACULTAD($resultado->FACULTAD);
            $this->setTIPO_IDENTIFICACION($resultado->TIPO_IDENTIFICACION);
            $this->setIDENTIFICACION($resultado->IDENTIFICACION);
            $this->setNOMBRES($resultado->NOMBRES);
            $this->setCORREO($resultado->CORREO);
            $this->setTELEFONO($resultado->TELEFONO);
            $this->setESTADO($resultado->ESTADO);
            $this->setFOTO($resultado->FOTO);
            $this->setOBSERVACIONES($resultado->OBSERVACIONES);
            $this->setUSUARIO_ACTUALIZA($resultado->USUARIO_ACTUALIZA);
            $this->setFECHA_ACTUALIZA($resultado->FECHA_ACTUALIZA);
            $this->setFECHA_POSTULACION(($resultado->FECHA_POSTULACION));

            return true;
        } else {
            return false;
        }
    }

    public function consultarPlanchas() {
        $sql = "select "
                . "POSTULACION_ID, "
                . "ANNIO_ID, "
                . "GRUPO_INTERES, "
                . "FACULTAD, "
                . "TIPO_IDENTIFICACION, "
                . "IDENTIFICACION, "
                . "NOMBRES, "
                . "CORREO, "
                . "TELEFONO, "
                . "ESTADO, "
                . "FOTO, "
                . "OBSERVACIONES, "
                . "USUARIO_ACTUALIZA, "
                . "TO_CHAR(FECHA_ACTUALIZA , 'YYYY/MM/DD HH24:MI:SS') FECHA_ACTUALIZA, "
                . "TO_CHAR(FECHA_POSTULACION , 'YYYY/MM/DD HH24:MI:SS') FECHA_POSTULACION "
                . "from "
                . "MU_REP_POSTULACION "
                . "where ANNIO_ID = :annio_id "
                . "order by GRUPO_INTERES asc, FACULTAD asc, IDENTIFICACION asc";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':annio_id' => $this->getANNIO_ID()
        ];

        $query->execute($parametros);

        return $query->fetchAll();
    }

    public function enviarActualizacionPlancha() {
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $cabeceras .= 'From: Universidad San Buenaventura de Medellin<usbmed@usbmed.edu.co>';

        $titulo = "Actualización a la plancha #".$this->getPOSTULACION_ID()." - Universidad San Buenaventura de Medellín";
        $para = $this->getCORREO();

        ob_start();
        View::render('_templates/email/actualizacionPlancha', [], []);
        $mensaje = ob_get_contents();
        ob_clean();

        $mensaje = str_replace('{_NOMBRE_}', $this->getNOMBRES(), $mensaje);
        $mensaje = str_replace('{_PLANCHA_}', $this->getPOSTULACION_ID(), $mensaje);
        $mensaje = str_replace('{_OBSERVACION_}', nl2br($this->getOBSERVACIONES()), $mensaje);
        $mensaje = str_replace('{_ESTADO_}', ListaGlobal::getEstados($this->getESTADO()), $mensaje);

        $enviado = mail($para, $titulo, $mensaje, $cabeceras);
        
        return $enviado;
    }

}
