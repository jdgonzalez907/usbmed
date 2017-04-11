<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;

/**
 * Description of AsistenciaCurso
 *
 * @author ingeniero.analista1
 */
class AsistenciaCurso extends Model {

    private $SECUENCIA;
    private $FECHA_ASISTENCIA;
    private $IDENTIFICACION_DOC;
    private $FECHA_CREACION;
    private $ASISTIO;
    private $CONSECUTIVO;
    private $IDENTIFICACION_EST;
    private $OBSERVACION;
    private $USUARIO_ACTUALIZA;
    private $FECHA_ACTUALIZA;
    private $FECHA_OFICIALIZA;

    public function getSECUENCIA() {
        return $this->SECUENCIA;
    }

    public function getFECHA_ASISTENCIA() {
        return $this->FECHA_ASISTENCIA;
    }

    public function getIDENTIFICACION_DOC() {
        return $this->IDENTIFICACION_DOC;
    }

    public function getFECHA_CREACION() {
        return $this->FECHA_CREACION;
    }

    public function getASISTIO() {
        return $this->ASISTIO;
    }

    public function getCONSECUTIVO() {
        return $this->CONSECUTIVO;
    }

    public function getIDENTIFICACION_EST() {
        return $this->IDENTIFICACION_EST;
    }

    public function getOBSERVACION() {
        return $this->OBSERVACION;
    }

    public function getUSUARIO_ACTUALIZA() {
        return $this->USUARIO_ACTUALIZA;
    }

    public function getFECHA_ACTUALIZA() {
        return $this->FECHA_ACTUALIZA;
    }

    public function getFECHA_OFICIALIZA() {
        return $this->FECHA_OFICIALIZA;
    }

    public function setSECUENCIA($SECUENCIA) {
        $this->SECUENCIA = $SECUENCIA;
    }

    public function setFECHA_ASISTENCIA($FECHA_ASISTENCIA) {
        $this->FECHA_ASISTENCIA = $FECHA_ASISTENCIA;
    }

    public function setIDENTIFICACION_DOC($IDENTIFICACION_DOC) {
        $this->IDENTIFICACION_DOC = $IDENTIFICACION_DOC;
    }

    public function setFECHA_CREACION($FECHA_CREACION) {
        $this->FECHA_CREACION = $FECHA_CREACION;
    }

    public function setASISTIO($ASISTIO) {
        $this->ASISTIO = $ASISTIO;
    }

    public function setCONSECUTIVO($CONSECUTIVO) {
        $this->CONSECUTIVO = $CONSECUTIVO;
    }

    public function setIDENTIFICACION_EST($IDENTIFICACION_EST) {
        $this->IDENTIFICACION_EST = $IDENTIFICACION_EST;
    }

    public function setOBSERVACION($OBSERVACION) {
        $this->OBSERVACION = $OBSERVACION;
    }

    public function setUSUARIO_ACTUALIZA($USUARIO_ACTUALIZA) {
        $this->USUARIO_ACTUALIZA = $USUARIO_ACTUALIZA;
    }

    public function setFECHA_ACTUALIZA($FECHA_ACTUALIZA) {
        $this->FECHA_ACTUALIZA = $FECHA_ACTUALIZA;
    }

    public function setFECHA_OFICIALIZA($FECHA_OFICIALIZA) {
        $this->FECHA_OFICIALIZA = $FECHA_OFICIALIZA;
    }

    public function existeFechaAsistencia() {
        $sql = "select distinct FECHA_ASISTENCIA "
                . "from con00.TEM_ASISTENCIA_CURSO "
                . "where TO_CHAR(FECHA_ASISTENCIA, 'DD/MM/YYYY') = :fecha_asistencia";
        
        $query = $this->db->prepare($sql);
        $parametros = [
            ':fecha_asistencia' => $this->getFECHA_ASISTENCIA()
        ];
        
        $query->execute($parametros);
        
        return $query->fetch();
    }

}
