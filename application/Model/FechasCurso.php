<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;

/**
 * Description of FechasCurso
 *
 * @author ingeniero.analista1
 */
class FechasCurso extends Model {
    
    protected $conexion = "con00";

    const _CURSO_ASCENSO_REUBICACION_ = [803, 804];

    private $COD_CURSO;
    private $CONSECUTIVO;
    private $FECH_INI_CURSO;
    private $FECH_FIN_CURSO;
    private $GRUPO;
    private $TOPE_MIN;
    private $TOPE_MAX;
    private $CEDULA_PROFESOR;
    private $FECHA_FACTURA;
    private $ESTADO;
    private $MOTIVO;
    private $TIPO;
    private $GRUPO_ICE;
    private $PERIODO_ICE;
    private $MESES_ICE;

    public function getCOD_CURSO() {
        return $this->COD_CURSO;
    }

    public function getCONSECUTIVO() {
        return $this->CONSECUTIVO;
    }

    public function getFECH_INI_CURSO() {
        return $this->FECH_INI_CURSO;
    }

    public function getFECH_FIN_CURSO() {
        return $this->FECH_FIN_CURSO;
    }

    public function getGRUPO() {
        return $this->GRUPO;
    }

    public function getTOPE_MIN() {
        return $this->TOPE_MIN;
    }

    public function getTOPE_MAX() {
        return $this->TOPE_MAX;
    }

    public function getCEDULA_PROFESOR() {
        return $this->CEDULA_PROFESOR;
    }

    public function getFECHA_FACTURA() {
        return $this->FECHA_FACTURA;
    }

    public function getESTADO() {
        return $this->ESTADO;
    }

    public function getMOTIVO() {
        return $this->MOTIVO;
    }

    public function getTIPO() {
        return $this->TIPO;
    }

    public function getGRUPO_ICE() {
        return $this->GRUPO_ICE;
    }

    public function getPERIODO_ICE() {
        return $this->PERIODO_ICE;
    }

    public function getMESES_ICE() {
        return $this->MESES_ICE;
    }

    public function setCOD_CURSO($COD_CURSO) {
        $this->COD_CURSO = $COD_CURSO;
    }

    public function setCONSECUTIVO($CONSECUTIVO) {
        $this->CONSECUTIVO = $CONSECUTIVO;
    }

    public function setFECH_INI_CURSO($FECH_INI_CURSO) {
        $this->FECH_INI_CURSO = $FECH_INI_CURSO;
    }

    public function setFECH_FIN_CURSO($FECH_FIN_CURSO) {
        $this->FECH_FIN_CURSO = $FECH_FIN_CURSO;
    }

    public function setGRUPO($GRUPO) {
        $this->GRUPO = $GRUPO;
    }

    public function setTOPE_MIN($TOPE_MIN) {
        $this->TOPE_MIN = $TOPE_MIN;
    }

    public function setTOPE_MAX($TOPE_MAX) {
        $this->TOPE_MAX = $TOPE_MAX;
    }

    public function setCEDULA_PROFESOR($CEDULA_PROFESOR) {
        $this->CEDULA_PROFESOR = $CEDULA_PROFESOR;
    }

    public function setFECHA_FACTURA($FECHA_FACTURA) {
        $this->FECHA_FACTURA = $FECHA_FACTURA;
    }

    public function setESTADO($ESTADO) {
        $this->ESTADO = $ESTADO;
    }

    public function setMOTIVO($MOTIVO) {
        $this->MOTIVO = $MOTIVO;
    }

    public function setTIPO($TIPO) {
        $this->TIPO = $TIPO;
    }

    public function setGRUPO_ICE($GRUPO_ICE) {
        $this->GRUPO_ICE = $GRUPO_ICE;
    }

    public function setPERIODO_ICE($PERIODO_ICE) {
        $this->PERIODO_ICE = $PERIODO_ICE;
    }

    public function setMESES_ICE($MESES_ICE) {
        $this->MESES_ICE = $MESES_ICE;
    }

    public function consecutivosAsociados() {
        $sql = "select "
                . "* "
                . "from "
                . "TER_FECHAS_CURSO "
                . "where COD_CURSO in (" . implode(',', self::_CURSO_ASCENSO_REUBICACION_) . ") "
                . "and CEDULA_PROFESOR = :cedula_profesor "
        ;

        $query = $this->db->prepare($sql);
        $parametros = [
            ':cedula_profesor' => $this->getCEDULA_PROFESOR()
        ];

        $query->execute($parametros);

        return $query->fetchAll();
    }

    public function consultarFechas() {
        $sql = "select "
                . "distinct asisC.CONSECUTIVO CONSECUTIVO, "
                . "TO_CHAR(asisC.FECHA_ASISTENCIA, 'DD/MM/YYYY') FECHA_ASISTENCIA, "
                . "TO_CHAR(asisC.FECHA_OFICIALIZA, 'DD/MM/YYYY') FECHA_OFICIALIZA "
                . "from "
                . "TER_FECHAS_CURSO fechaC "
                . "inner join TEM_ASISTENCIA_CURSO asisC "
                . "on fechaC.CONSECUTIVO = asisC.CONSECUTIVO "
                . "where fechaC.COD_CURSO in (" . implode(',', self::_CURSO_ASCENSO_REUBICACION_) . ") "
                . "and fechaC.CEDULA_PROFESOR = :cedula_profesor "
                . "and fechaC.CONSECUTIVO = :consecutivo "
                . "order by FECHA_ASISTENCIA desc"
        ;

        $query = $this->db->prepare($sql);
        $parametros = [
            ':cedula_profesor' => $this->getCEDULA_PROFESOR(),
            ':consecutivo' => $this->getCONSECUTIVO()
        ];

        $query->execute($parametros);

        return $query->fetchAll();
    }

}
