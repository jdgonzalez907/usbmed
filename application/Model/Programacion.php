<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;

/**
 * Description of Programacion
 *
 * @author ingeniero.analista1
 */
class Programacion extends Model {

    private $ANNIO;
    private $FECHA_INICIO_INSCRIPCION;
    private $FECHA_FIN_INSCRIPCION;
    private $FECHA_INICIO_VOTACION;
    private $FECHA_FIN_VOTACION;
    private $USUARIO_CREA;
    private $FECHA_CREA;
    private $USUARIO_ACTUALIZA;
    private $FECHA_ACTUALIZA;

    public function getANNIO() {
        return $this->ANNIO;
    }

    public function getFECHA_INICIO_INSCRIPCION() {
        return $this->FECHA_INICIO_INSCRIPCION;
    }

    public function getFECHA_FIN_INSCRIPCION() {
        return $this->FECHA_FIN_INSCRIPCION;
    }

    public function getFECHA_INICIO_VOTACION() {
        return $this->FECHA_INICIO_VOTACION;
    }

    public function getFECHA_FIN_VOTACION() {
        return $this->FECHA_FIN_VOTACION;
    }

    public function getUSUARIO_CREA() {
        return $this->USUARIO_CREA;
    }

    public function getFECHA_CREA() {
        return $this->FECHA_CREA;
    }

    public function getUSUARIO_ACTUALIZA() {
        return $this->USUARIO_ACTUALIZA;
    }

    public function getFECHA_ACTUALIZA() {
        return $this->FECHA_ACTUALIZA;
    }

    public function setANNIO($ANNIO) {
        $this->ANNIO = $ANNIO;
    }

    public function setFECHA_INICIO_INSCRIPCION($FECHA_INICIO_INSCRIPCION) {
        $this->FECHA_INICIO_INSCRIPCION = $FECHA_INICIO_INSCRIPCION;
    }

    public function setFECHA_FIN_INSCRIPCION($FECHA_FIN_INSCRIPCION) {
        $this->FECHA_FIN_INSCRIPCION = $FECHA_FIN_INSCRIPCION;
    }

    public function setFECHA_INICIO_VOTACION($FECHA_INICIO_VOTACION) {
        $this->FECHA_INICIO_VOTACION = $FECHA_INICIO_VOTACION;
    }

    public function setFECHA_FIN_VOTACION($FECHA_FIN_VOTACION) {
        $this->FECHA_FIN_VOTACION = $FECHA_FIN_VOTACION;
    }

    public function setUSUARIO_CREA($USUARIO_CREA) {
        $this->USUARIO_CREA = $USUARIO_CREA;
    }

    public function setFECHA_CREA($FECHA_CREA) {
        $this->FECHA_CREA = $FECHA_CREA;
    }

    public function setUSUARIO_ACTUALIZA($USUARIO_ACTUALIZA) {
        $this->USUARIO_ACTUALIZA = $USUARIO_ACTUALIZA;
    }

    public function setFECHA_ACTUALIZA($FECHA_ACTUALIZA) {
        $this->FECHA_ACTUALIZA = $FECHA_ACTUALIZA;
    }

    public function getProgramacionActual()
    {
        $annio = date('Y');

        $sql = "select "
                . "ANNIO, "
                . "TO_CHAR(FECHA_INICIO_INSCRIPCION , 'YYYY/MM/DD HH24:MI:SS') FECHA_INICIO_INSCRIPCION, "
                . "TO_CHAR(FECHA_FIN_INSCRIPCION , 'YYYY/MM/DD HH24:MI:SS') FECHA_FIN_INSCRIPCION, "
                . "TO_CHAR(FECHA_INICIO_VOTACION , 'YYYY/MM/DD HH24:MI:SS') FECHA_INICIO_VOTACION, "
                . "TO_CHAR(FECHA_FIN_VOTACION , 'YYYY/MM/DD HH24:MI:SS') FECHA_FIN_VOTACION, "
                . "USUARIO_CREA, "
                . "TO_CHAR(FECHA_CREA , 'YYYY/MM/DD HH24:MI:SS') FECHA_CREA, "
                . "USUARIO_ACTUALIZA, "
                . "TO_CHAR(FECHA_ACTUALIZA , 'YYYY/MM/DD HH24:MI:SS') FECHA_ACTUALIZA "
                . "from MU_REP_PROGRAMACION "
                . "where ANNIO = :annio";

        $query = $this->db->prepare($sql);
        $parametros = [':annio' => $annio];

        $query->execute($parametros);

        $resultado = $query->fetch();

        if (!empty($resultado)) {
            $this->setANNIO($resultado->ANNIO);
            $this->setFECHA_INICIO_INSCRIPCION($resultado->FECHA_INICIO_INSCRIPCION);
            $this->setFECHA_FIN_INSCRIPCION($resultado->FECHA_FIN_INSCRIPCION);
            $this->setFECHA_INICIO_VOTACION($resultado->FECHA_INICIO_VOTACION);
            $this->setFECHA_FIN_VOTACION($resultado->FECHA_FIN_VOTACION);
            $this->setUSUARIO_CREA($resultado->USUARIO_CREA);
            $this->setFECHA_CREA($resultado->FECHA_CREA);
            $this->setUSUARIO_ACTUALIZA($resultado->USUARIO_ACTUALIZA);
            $this->setFECHA_ACTUALIZA($resultado->FECHA_ACTUALIZA);
            
            return true;
        }else{
            return false;
        }
    }

    public function insert()
    {
        $sql = "insert into MU_REP_PROGRAMACION values ( "
                . ":annio, "
                . "TO_DATE(:fecha_inicio_inscripcion , 'YYYY/MM/DD HH24:MI:SS'), "
                . "TO_DATE(:fecha_fin_inscripcion , 'YYYY/MM/DD HH24:MI:SS'), "
                . "TO_DATE(:fecha_inicio_votacion , 'YYYY/MM/DD HH24:MI:SS'), "
                . "TO_DATE(:fecha_fin_votacion , 'YYYY/MM/DD HH24:MI:SS'), "
                . ":usuario_crea, "
                . "TO_DATE(:fecha_crea , 'YYYY/MM/DD HH24:MI:SS'), "
                . ":usuario_actualiza, "
                . "TO_DATE(:fecha_actualiza , 'YYYY/MM/DD HH24:MI:SS') "
                . ")";
        
        $query = $this->db->prepare($sql);
        $parametros = [
            ':annio' => $this->getANNIO(),
            ':fecha_inicio_inscripcion' => $this->getFECHA_INICIO_INSCRIPCION(),
            ':fecha_fin_inscripcion' => $this->getFECHA_FIN_INSCRIPCION(),
            ':fecha_inicio_votacion' => $this->getFECHA_INICIO_VOTACION(),
            ':fecha_fin_votacion' => $this->getFECHA_FIN_VOTACION(),
            ':usuario_crea' => $this->getUSUARIO_CREA(),
            ':fecha_crea' => $this->getFECHA_CREA(),
            ':usuario_actualiza' => $this->getUSUARIO_ACTUALIZA(),
            ':fecha_actualiza' => $this->getFECHA_ACTUALIZA()
        ];
        
        $query->execute($parametros);
        
        return $query->rowCount();
    }

    public function update()
    {
        $sql = "update MU_REP_PROGRAMACION SET "
                . "FECHA_INICIO_INSCRIPCION = TO_DATE(:fecha_inicio_inscripcion , 'YYYY/MM/DD HH24:MI:SS'), "
                . "FECHA_FIN_INSCRIPCION = TO_DATE(:fecha_fin_inscripcion , 'YYYY/MM/DD HH24:MI:SS'), "
                . "FECHA_INICIO_VOTACION = TO_DATE(:fecha_inicio_votacion , 'YYYY/MM/DD HH24:MI:SS'), "
                . "FECHA_FIN_VOTACION = TO_DATE(:fecha_fin_votacion , 'YYYY/MM/DD HH24:MI:SS'), "
                . "USUARIO_CREA = :usuario_crea, "
                . "FECHA_CREA = TO_DATE(:fecha_crea , 'YYYY/MM/DD HH24:MI:SS'), "
                . "USUARIO_ACTUALIZA = :usuario_actualiza, "
                . "FECHA_ACTUALIZA = TO_DATE(:fecha_actualiza , 'YYYY/MM/DD HH24:MI:SS') "
                . "where ANNIO = :annio";
        
        $query = $this->db->prepare($sql);
        $parametros = [
            ':annio' => $this->getANNIO(),
            ':fecha_inicio_inscripcion' => $this->getFECHA_INICIO_INSCRIPCION(),
            ':fecha_fin_inscripcion' => $this->getFECHA_FIN_INSCRIPCION(),
            ':fecha_inicio_votacion' => $this->getFECHA_INICIO_VOTACION(),
            ':fecha_fin_votacion' => $this->getFECHA_FIN_VOTACION(),
            ':usuario_crea' => $this->getUSUARIO_CREA(),
            ':fecha_crea' => $this->getFECHA_CREA(),
            ':usuario_actualiza' => $this->getUSUARIO_ACTUALIZA(),
            ':fecha_actualiza' => $this->getFECHA_ACTUALIZA()
        ];
        
        $query->execute($parametros);
        
        return $query->rowCount();
    }
}
