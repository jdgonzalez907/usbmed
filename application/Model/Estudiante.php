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
 * @author ingeniero.analista4
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

    function setTIPO_IDENTIFICACION($TIPO_IDENTIFICACION) {
        $this->TIPO_IDENTIFICACION = $TIPO_IDENTIFICACION;
        return $this;
    }

    function setIDENTIFICACION($IDENTIFICACION) {
        $this->IDENTIFICACION = $IDENTIFICACION;
        return $this;
    }

    function setNOMBRES($NOMBRES) {
        $this->NOMBRES = $NOMBRES;
        return $this;
    }

    function setAPELLIDOS($APELLIDOS) {
        $this->APELLIDOS = $APELLIDOS;
        return $this;
    }

    function setCORREO($CORREO) {
        $this->CORREO = $CORREO;
        return $this;
    }

    function setCELULAR($CELULAR) {
        $this->CELULAR = $CELULAR;
        return $this;
    }

    function setCODIGO($CODIGO) {
        $this->CODIGO = $CODIGO;
        return $this;
    }

    function setID_ESTUDIO($ID_ESTUDIO) {
        $this->ID_ESTUDIO = $ID_ESTUDIO;
        return $this;
    }

    function setARCHIVO_FOTO($ARCHIVO_FOTO) {
        $this->ARCHIVO_FOTO = $ARCHIVO_FOTO;
        return $this;
    }

    function setARCHIVO_PRUEBA($ARCHIVO_PRUEBA) {
        $this->ARCHIVO_PRUEBA = $ARCHIVO_PRUEBA;
        return $this;
    }

    function setARCHIVO_DOCUMENTO($ARCHIVO_DOCUMENTO) {
        $this->ARCHIVO_DOCUMENTO = $ARCHIVO_DOCUMENTO;
        return $this;
    }

    function insertar() {
        $sql = "insert into MU_GRA_ESTUDIANTE(
                TIPO_IDENTIFICACION,
                IDENTIFICACION,
                NOMBRES,
                APELLIDOS,
                CORREO,
                CELULAR,
                CODIGO,
                ID_ESTUDIO,
                ARCHIVO_FOTO,
                ARCHIVO_PRUEBA,
                ARCHIVO_DOCUMENTO)
                values (
                :tipo_identificacion,
                :identificacion,
                :nombres,
                :apellidos,
                :correo,
                :celular,
                :codigo,
                :id_estudio,
                :archivo_foto,
                :archivo_prueba,
                :archivo_documento
                )";

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
            ':archivo_documento' => $this->getARCHIVO_DOCUMENTO()
        ];
        
        $query->execute($parametros);
        
        return $query->rowCount();
    }
    
    function consultarEstudiante()
    {
        $sql = " select * from MU_GRA_ESTUDIANTE where TIPO_IDENTIFICACION = :tipo_identificacion and IDENTIFICACION = :identificacion and ID_ESTUDIO = :id_estudio";
        
        $query = $this->db->prepare($sql);
        
        $parametros = [
            ':tipo_identificacion' => $this->getTIPO_IDENTIFICACION(),
            ':identificacion' => $this->getIDENTIFICACION(),
            ':id_estudio' => $this->getID_ESTUDIO(),
        ];
        
        $query->execute($parametros);
        
        return $query->rowCount();
    }

}
