<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;

/**
 * Description of Estudiante
 *
 * @author ingeniero.analista1
 */
class Estudiante extends Model {

    private $TIPO_IDENTIFICACION;
    private $IDENTIFICACION;
    private $NOMBRES;
    private $APELLIDOS;
    private $CORREO;
    private $CELULAR;
    private $CODIGO;
    private $ID_ESTUDIO;
    private $ARCHIVO_FOTO;
    private $ARCHIVO_PRUEBA;
    private $ARCHIVO_DOCUMENTO;
    private $FECHA_REGISTRO;

    function getTIPO_IDENTIFICACION() {
        return $this->TIPO_IDENTIFICACION;
    }

    function getIDENTIFICACION() {
        return $this->IDENTIFICACION;
    }

    function getNOMBRES() {
        return $this->NOMBRES;
    }

    function getAPELLIDOS() {
        return $this->APELLIDOS;
    }

    function getCORREO() {
        return $this->CORREO;
    }

    function getCELULAR() {
        return $this->CELULAR;
    }

    function getCODIGO() {
        return $this->CODIGO;
    }

    function getID_ESTUDIO() {
        return $this->ID_ESTUDIO;
    }

    function getARCHIVO_FOTO() {
        return $this->ARCHIVO_FOTO;
    }

    function getARCHIVO_PRUEBA() {
        return $this->ARCHIVO_PRUEBA;
    }

    function getARCHIVO_DOCUMENTO() {
        return $this->ARCHIVO_DOCUMENTO;
    }

    function getFECHA_REGISTRO() {
        return $this->FECHA_REGISTRO;
    }

    function setTIPO_IDENTIFICACION($TIPO_IDENTIFICACION) {
        $this->TIPO_IDENTIFICACION = $TIPO_IDENTIFICACION;
    }

    function setIDENTIFICACION($IDENTIFICACION) {
        $this->IDENTIFICACION = $IDENTIFICACION;
    }

    function setNOMBRES($NOMBRES) {
        $this->NOMBRES = $NOMBRES;
    }

    function setAPELLIDOS($APELLIDOS) {
        $this->APELLIDOS = $APELLIDOS;
    }

    function setCORREO($CORREO) {
        $this->CORREO = $CORREO;
    }

    function setCELULAR($CELULAR) {
        $this->CELULAR = $CELULAR;
    }

    function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
    }

    function setID_ESTUDIO($ID_ESTUDIO) {
        $this->ID_ESTUDIO = $ID_ESTUDIO;
    }

    function setARCHIVO_FOTO($ARCHIVO_FOTO) {
        $this->ARCHIVO_FOTO = $ARCHIVO_FOTO;
    }

    function setARCHIVO_PRUEBA($ARCHIVO_PRUEBA) {
        $this->ARCHIVO_PRUEBA = $ARCHIVO_PRUEBA;
    }

    function setARCHIVO_DOCUMENTO($ARCHIVO_DOCUMENTO) {
        $this->ARCHIVO_DOCUMENTO = $ARCHIVO_DOCUMENTO;
    }

    function setFECHA_REGISTRO($FECHA_REGISTRO) {
        $this->FECHA_REGISTRO = $FECHA_REGISTRO;
    }

    public function insert() {
        $sql = "insert into MU_GRA_ESTUDIANTE ( "
                . "TIPO_IDENTIFICACION, "
                . "IDENTIFICACION, "
                . "NOMBRES, "
                . "APELLIDOS, "
                . "CORREO, "
                . "CELULAR, "
                . "CODIGO, "
                . "ID_ESTUDIO, "
                . "ARCHIVO_FOTO, "
                . "ARCHIVO_PRUEBA, "
                . "ARCHIVO_DOCUMENTO, "
                . "FECHA_REGISTRO "
                . ") values ( "
                . ":tipo_identificacion, "
                . ":identificacion, "
                . ":nombres, "
                . ":apellidos, "
                . ":correo, "
                . ":celular, "
                . ":codigo, "
                . ":id_estudio, "
                . ":archivo_foto, "
                . ":archivo_prueba, "
                . ":archivo_documento, "
                . "TO_DATE(:fecha_registro, 'YYYY/MM/DD HH24:MI:SS') "
                . ") ";

        $query = $this->db->prepare($sql);

        $parametros = [
            ':tipo_identificacion' => $this->getTIPO_IDENTIFICACION(),
            ':identificacion' => $this->getIDENTIFICACION(),
            ':nombres' => $this->getNOMBRES(),
            ':apellidos' => $this->getAPELLIDOS(),
            ':correo' => $this->getCORREO(),
            ':celular' => $this->getCELULAR(),
            ':codigo' => $this->getCODIGO(),
            ':id_estudio' => $this->getID_ESTUDIO(),
            ':archivo_foto' => $this->getARCHIVO_FOTO(),
            ':archivo_prueba' => $this->getARCHIVO_PRUEBA(),
            ':archivo_documento' => $this->getARCHIVO_DOCUMENTO(),
            ':fecha_registro' => $this->getFECHA_REGISTRO()
        ];

        $query->execute($parametros);
        
        return $query->rowCount();
    }
    
    public function consultarLlavePrimaria()
    {
        $sql = "select * from MU_GRA_ESTUDIANTE "
                . "where TIPO_IDENTIFICACION = :tipo_identificacion "
                . "and IDENTIFICACION = :identificacion "
                . "and ID_ESTUDIO = :id_estudio";
        
        $query = $this->db->prepare($sql);
        
        $parametros = [
            ':tipo_identificacion' => $this->getTIPO_IDENTIFICACION(),
            ':identificacion' => $this->getIDENTIFICACION(),
            ':id_estudio' => $this->getID_ESTUDIO()
        ];
        
        $query->execute($parametros);
        
        return $query->fetch();
    }

}
