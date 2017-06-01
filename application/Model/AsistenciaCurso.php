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
    
    protected $conexion = "con00";
    
    const ASISTIO = 'S';
    const NO_ASISTIO = 'N';

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
        $sql = "select count(FECHA_ASISTENCIA) CONTADOR "
                . "from TEM_ASISTENCIA_CURSO "
                . "where TO_CHAR(FECHA_ASISTENCIA, 'DD/MM/YYYY') = :fecha_asistencia and CONSECUTIVO = :consecutivo";
        
        $query = $this->db->prepare($sql);
        $parametros = [
            ':fecha_asistencia' => $this->getFECHA_ASISTENCIA(),
            ':consecutivo' => $this->getCONSECUTIVO()
        ];
        
        $query->execute($parametros);
        
        return $query->fetch()->CONTADOR;
    }
    
    public function insert() {
        $sql = "select TEM_ASISTENCIA_CURSO_SEQ.nextVal as SECUENCIA from DUAL";

        $query = $this->db->prepare($sql);
        $query->execute();
        $this->setSECUENCIA($query->fetch()->SECUENCIA);
        
        $sql = "insert into TEM_ASISTENCIA_CURSO("
                . "SECUENCIA,"
                . "FECHA_ASISTENCIA,"
                . "IDENTIFICACION_DOC,"
                . "FECHA_CREACION,"
                . "ASISTIO,"
                . "CONSECUTIVO,"
                . "IDENTIFICACION_EST,"
                . "OBSERVACION,"
                . "USUARIO_ACTUALIZA,"
                . "FECHA_ACTUALIZA,"
                . "FECHA_OFICIALIZA"
                . ") values ("
                . ":secuencia,"
                . "TO_DATE(:fecha_asistencia , 'DD/MM/YYYY'),"
                . ":identificacion_doc,"
                . "TO_DATE(:fecha_creacion , 'DD/MM/YYYY'),"
                . ":asistio,"
                . ":consecutivo,"
                . ":identificacion_est,"
                . ":observacion,"
                . ":usuario_actualiza,"
                . "TO_DATE(:fecha_actualiza , 'DD/MM/YYYY'),"
                . "TO_DATE(:fecha_oficializa , 'DD/MM/YYYY')"
                . ")";
        
        $query = $this->db->prepare($sql);
        $parametros = [
            ":secuencia" => $this->getSECUENCIA(),
            ":fecha_asistencia" => $this->getFECHA_ASISTENCIA(),
            ":identificacion_doc" => $this->getIDENTIFICACION_DOC(),
            ":fecha_creacion" => $this->getFECHA_CREACION(),
            ":asistio" => $this->getASISTIO(),
            ":consecutivo" => $this->getCONSECUTIVO(),
            ":identificacion_est" => $this->getIDENTIFICACION_EST(),
            ":observacion" => $this->getOBSERVACION(),
            ":usuario_actualiza" => $this->getUSUARIO_ACTUALIZA(),
            ":fecha_actualiza" => $this->getFECHA_ACTUALIZA(),
            ":fecha_oficializa" => $this->getFECHA_OFICIALIZA(),
        ];
        
        $query->execute($parametros);
        
        return $query->rowCount();
    }
            
    public function consultarAsistenciaCurso()
    {
        $sql = "select "
                . "acu.SECUENCIA SECUENCIA, "
                . "acu.IDENTIFICACION_EST IDENTIFICACION, "
                . "asi.NOMBRES NOMBRES, "
                . "asi.APELLIDOS APELLIDOS, "
                . "acu.ASISTIO ASISTIO, "
                . "TO_CHAR(acu.FECHA_ASISTENCIA, 'DD/MM/YYYY') FECHA_ASISTENCIA, "
                . "TO_CHAR(acu.FECHA_OFICIALIZA, 'DD/MM/YYYY') FECHA_OFICIALIZA "
                . "from tem_asistencia_curso acu "
                . "inner join aca00.scr_asistentes asi "
                . "on acu.IDENTIFICACION_EST = asi.IDENTIFICACION "
                . "where TO_CHAR(acu.FECHA_ASISTENCIA, 'DD/MM/YYYY') = :fecha_asistencia "
                . "and acu.CONSECUTIVO = :consecutivo";
        
        $query = $this->db->prepare($sql);
        
        $parametros = [
            ":fecha_asistencia" => $this->getFECHA_ASISTENCIA(),
            ":consecutivo" => $this->getCONSECUTIVO()
        ];
        
        $query->execute($parametros);
        
        return $query->fetchAll();
    }
    
    public function obtenerPorConsecutivo() {
        $sql = "select * "
                . "from TEM_ASISTENCIA_CURSO "
                . "where CONSECUTIVO = :consecutivo";
        
        $query = $this->db->prepare($sql);
        
        $parametros = [
            ":consecutivo" => $this->getCONSECUTIVO()
        ];
        
        $query->execute($parametros);
        
        return $query->fetchAll();
    }
    
    public function updateASISTENCIA()
    {
        $sql = "update TEM_ASISTENCIA_CURSO set "
                . "ASISTIO = :asistio "
                . "where SECUENCIA = :secuencia "
                . "and USUARIO_ACTUALIZA = :usuario_actualiza "
                . "and FECHA_ACTUALIZA = TO_DATE(:fecha_actualiza , 'DD/MM/YYYY')";
        
        $query = $this->db->prepare($sql);
        
        $parametros = [
            ":asistio" => $this->getASISTIO(),
            ":secuencia" => $this->getSECUENCIA(),
            ":usuario_actualiza" => $this->getUSUARIO_ACTUALIZA(),
            ":fecha_actualiza" => $this->getFECHA_ACTUALIZA(),
        ];
        
        $query->execute($parametros);
        
        return $query->rowCount();
    }
    
    public function deleteAsistencia()
    {
        $sql = "delete "
                . "from TEM_ASISTENCIA_CURSO "
                . "where CONSECUTIVO = :consecutivo "
                . "and TO_CHAR(FECHA_ASISTENCIA, 'DD/MM/YYYY') = :fecha_asistencia";
        
        $query = $this->db->prepare($sql);
        
        $parametros = [
            ":consecutivo" => $this->getCONSECUTIVO(),
            ":fecha_asistencia" => $this->getFECHA_ASISTENCIA()
        ];
        
        $query->execute($parametros);
        
        return $query->rowCount();
    }    
    
    public function oficializarAsistencia()
    {
        $sql = "update TEM_ASISTENCIA_CURSO set "
                . "USUARIO_ACTUALIZA = :usuario_actualiza, "
                . "FECHA_ACTUALIZA = TO_DATE(:fecha_actualiza , 'DD/MM/YYYY'), "
                . "FECHA_OFICIALIZA = TO_DATE(:fecha_oficializa , 'DD/MM/YYYY') "
                . "where CONSECUTIVO = :consecutivo "
                . "and TO_CHAR(FECHA_ASISTENCIA, 'DD/MM/YYYY') = :fecha_asistencia";
        
        $query = $this->db->prepare($sql);
        
        $parametros = [            
            ":consecutivo" => $this->getCONSECUTIVO(),
            ":fecha_asistencia" => $this->getFECHA_ASISTENCIA(),
            ":usuario_actualiza" => $this->getUSUARIO_ACTUALIZA(),
            ":fecha_actualiza" => $this->getFECHA_ACTUALIZA(),
            ":fecha_oficializa" => $this->getFECHA_OFICIALIZA()
        ];
        
        $query->execute($parametros);
        
        return $query->rowCount();
    }
}
