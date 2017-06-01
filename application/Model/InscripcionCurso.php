<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;

/**
 * Description of InscripcionCurso
 *
 * @author ingeniero.analista1
 */
class InscripcionCurso extends Model {
    
    protected $conexion = "con00";
    
    private $CONSECUTIVO;
    private $IDENTIFICACION;
    private $FECH_INSCRIPCION;
    private $CODIGO_INSTITUCION;
    private $FACTURO;
    private $NRO_RECIBO;
    private $ESTADO;
    private $MOTIVO;
    private $IMPRIMIR;
    private $COD_PLAN;
    private $NOTA;
    private $TIPO;
    private $CODIGO;
    private $VINCULO;
    private $CEDULA_VINCULO;

    public function getCONSECUTIVO() {
        return $this->CONSECUTIVO;
    }

    public function getIDENTIFICACION() {
        return $this->IDENTIFICACION;
    }

    public function getFECH_INSCRIPCION() {
        return $this->FECH_INSCRIPCION;
    }

    public function getCODIGO_INSTITUCION() {
        return $this->CODIGO_INSTITUCION;
    }

    public function getFACTURO() {
        return $this->FACTURO;
    }

    public function getNRO_RECIBO() {
        return $this->NRO_RECIBO;
    }

    public function getESTADO() {
        return $this->ESTADO;
    }

    public function getMOTIVO() {
        return $this->MOTIVO;
    }

    public function getIMPRIMIR() {
        return $this->IMPRIMIR;
    }

    public function getCOD_PLAN() {
        return $this->COD_PLAN;
    }

    public function getNOTA() {
        return $this->NOTA;
    }

    public function getTIPO() {
        return $this->TIPO;
    }

    public function getCODIGO() {
        return $this->CODIGO;
    }

    public function getVINCULO() {
        return $this->VINCULO;
    }

    public function getCEDULA_VINCULO() {
        return $this->CEDULA_VINCULO;
    }

    public function getCOMPROMISO() {
        return $this->COMPROMISO;
    }

    public function setCONSECUTIVO($CONSECUTIVO) {
        $this->CONSECUTIVO = $CONSECUTIVO;
    }

    public function setIDENTIFICACION($IDENTIFICACION) {
        $this->IDENTIFICACION = $IDENTIFICACION;
    }

    public function setFECH_INSCRIPCION($FECH_INSCRIPCION) {
        $this->FECH_INSCRIPCION = $FECH_INSCRIPCION;
    }

    public function setCODIGO_INSTITUCION($CODIGO_INSTITUCION) {
        $this->CODIGO_INSTITUCION = $CODIGO_INSTITUCION;
    }

    public function setFACTURO($FACTURO) {
        $this->FACTURO = $FACTURO;
    }

    public function setNRO_RECIBO($NRO_RECIBO) {
        $this->NRO_RECIBO = $NRO_RECIBO;
    }

    public function setESTADO($ESTADO) {
        $this->ESTADO = $ESTADO;
    }

    public function setMOTIVO($MOTIVO) {
        $this->MOTIVO = $MOTIVO;
    }

    public function setIMPRIMIR($IMPRIMIR) {
        $this->IMPRIMIR = $IMPRIMIR;
    }

    public function setCOD_PLAN($COD_PLAN) {
        $this->COD_PLAN = $COD_PLAN;
    }

    public function setNOTA($NOTA) {
        $this->NOTA = $NOTA;
    }

    public function setTIPO($TIPO) {
        $this->TIPO = $TIPO;
    }

    public function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
    }

    public function setVINCULO($VINCULO) {
        $this->VINCULO = $VINCULO;
    }

    public function setCEDULA_VINCULO($CEDULA_VINCULO) {
        $this->CEDULA_VINCULO = $CEDULA_VINCULO;
    }

    public function setCOMPROMISO($COMPROMISO) {
        $this->COMPROMISO = $COMPROMISO;
    }

    public function consultarInscritos() {
        $sql = "select * from "
                . "TEM_INS_CURSO ins "
                . "inner join SCR_ASISTENTES asi "
                . "on asi.IDENTIFICACION = ins.IDENTIFICACION "
                . "where ins.CONSECUTIVO = :consecutivo";
        
        $query = $this->db->prepare($sql);
        $parametros = [
            ':consecutivo' => $this->getCONSECUTIVO()
        ];
        
        $query->execute($parametros);
        
        return $query->fetchAll();
    }

}
