<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;

/**
 * Description of Voto
 *
 * @author ingeniero.analista1
 */
class Voto extends Model {

    private $ANNIO_ID;
    private $VOTANTE;
    private $ESTADO;
    private $USUAIO_HABILITA;
    private $FECHA_HABILITA;
    private $LUGAR_HABILITA;
    private $POSTULACION_ID;
    private $VOTO_FECHA;
    private $GRUPO_INTERES;

    public function getANNIO_ID() {
        return $this->ANNIO_ID;
    }

    public function getVOTANTE() {
        return $this->VOTANTE;
    }

    public function getESTADO() {
        return $this->ESTADO;
    }

    public function getUSUAIO_HABILITA() {
        return $this->USUAIO_HABILITA;
    }

    public function getFECHA_HABILITA() {
        return $this->FECHA_HABILITA;
    }

    public function getLUGAR_HABILITA() {
        return $this->LUGAR_HABILITA;
    }

    public function getPOSTULACION_ID() {
        return $this->POSTULACION_ID;
    }

    public function getVOTO_FECHA() {
        return $this->VOTO_FECHA;
    }

    public function getGRUPO_INTERES() {
        return $this->GRUPO_INTERES;
    }

    public function setANNIO_ID($ANNIO_ID) {
        $this->ANNIO_ID = $ANNIO_ID;
    }

    public function setVOTANTE($VOTANTE) {
        $this->VOTANTE = $VOTANTE;
    }

    public function setESTADO($ESTADO) {
        $this->ESTADO = $ESTADO;
    }

    public function setUSUAIO_HABILITA($USUAIO_HABILITA) {
        $this->USUAIO_HABILITA = $USUAIO_HABILITA;
    }

    public function setFECHA_HABILITA($FECHA_HABILITA) {
        $this->FECHA_HABILITA = $FECHA_HABILITA;
    }

    public function setLUGAR_HABILITA($LUGAR_HABILITA) {
        $this->LUGAR_HABILITA = $LUGAR_HABILITA;
    }

    public function setPOSTULACION_ID($POSTULACION_ID) {
        $this->POSTULACION_ID = $POSTULACION_ID;
    }

    public function setVOTO_FECHA($VOTO_FECHA) {
        $this->VOTO_FECHA = $VOTO_FECHA;
    }

    public function setGRUPO_INTERES($GRUPO_INTERES) {
        $this->GRUPO_INTERES = $GRUPO_INTERES;
    }

    public function insert() {
        $sql = "INSERT INTO mu_rep_voto "
                . "VALUES ("
                . ":annio_id, "
                . ":votante, "
                . ":estado, "
                . ":usuaio_habilita, "
                . ":fecha_habilita, "
                . ":lugar_habilita, "
                . ":postulacion_id, "
                . ":voto_fecha, "
                . ":grupo_interes"
                . ")";

        $query = $this->db->prepare($sql);
        $parametros = [
            ":annio_id" => $this->getANNIO_ID(),
            ":votante" => $this->getVOTANTE(),
            ":estado" => $this->getESTADO(),
            ":usuaio_habilita" => $this->getUSUAIO_HABILITA(),
            ":fecha_habilita" => $this->getFECHA_HABILITA(),
            ":lugar_habilita" => $this->getLUGAR_HABILITA(),
            ":postulacion_id" => $this->getPOSTULACION_ID(),
            ":voto_fecha" => $this->getVOTO_FECHA(),
            ":grupo_interes" => $this->getGRUPO_INTERES(),
        ];

        $query->execute($parametros);

        return $query->rowCount();
    }

    public function getUnico() {
        $sql = "select "
                . "ANNIO_ID, "
                . "VOTANTE, "
                . "ESTADO, "
                . "USUAIO_HABILITA, "
                . "TO_CHAR(FECHA_HABILITA , 'YYYY/MM/DD HH24:MI:SS') FECHA_HABILITA, "
                . "LUGAR_HABILITA, "
                . "POSTULACION_ID, "
                . "TO_CHAR(VOTO_FECHA , 'YYYY/MM/DD HH24:MI:SS') FECHA_HABILITA, "
                . "GRUPO_INTERES "
                . "from MU_REP_VOTO "
                . "where ANNIO_ID = :annio_id "
                . "and VOTANTE = :votante "
                . "and GRUPO_INTERES = :grupo_interes";

        $query = $this->db->prepare($sql);
        $parametros = [
            ":annio_id" => $this->getANNIO_ID(),
            ":votante" => $this->getVOTANTE(),
            ":grupo_interes" => $this->getGRUPO_INTERES()
        ];

        $query->execute($parametros);

        return $query->fetch();
    }

    public function consultarVotosDisponibles() {
        $sql = "select "
                . "*"
                . "from MU_REP_VOTO "
                . "where ANNIO_ID = :annio_id "
                . "and VOTANTE = :votante";

        $query = $this->db->prepare($sql);
        $parametros = [
            ":annio_id" => $this->getANNIO_ID(),
            ":votante" => $this->getVOTANTE()
        ];

        $query->execute($parametros);

        return $query->fetchAll();
    }
    
    public function votar() {
        $sql = "update MU_REP_VOTO set "
                . "POSTULACION_ID = :postulacion_id, "
                . "VOTO_FECHA = TO_DATE(:voto_fecha , 'YYYY/MM/DD HH24:MI:SS') "
                . "where "
                . "ANNIO_ID = :annio_id "
                . "and VOTANTE = :votante "
                . "and GRUPO_INTERES = :grupo_interes";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':annio_id' => $this->getANNIO_ID(),
            ':votante' =>$this->getVOTANTE(),
            ':postulacion_id' => $this->getPOSTULACION_ID(),
            ':voto_fecha' => $this->getVOTO_FECHA(),
            ':grupo_interes' => $this->getGRUPO_INTERES()
        ];
        $query->execute($parametros);

        return $query->rowCount();
    }

}
