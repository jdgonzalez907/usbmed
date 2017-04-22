<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;

/**
 * Description of Estudio
 *
 * @author ingeniero.analista1
 */
class Estudio extends Model {

    private $ID_ESTUDIO;
    private $DESCRIPCION;
    private $TIPO;

    function getID_ESTUDIO() {
        return $this->ID_ESTUDIO;
    }

    function getDESCRIPCION() {
        return $this->DESCRIPCION;
    }

    function getTIPO() {
        return $this->TIPO;
    }

    function setID_ESTUDIO($ID_ESTUDIO) {
        $this->ID_ESTUDIO = $ID_ESTUDIO;
    }

    function setDESCRIPCION($DESCRIPCION) {
        $this->DESCRIPCION = $DESCRIPCION;
    }

    function setTIPO($TIPO) {
        $this->TIPO = $TIPO;
    }

    public function consultarTodos() {
        $sql = "select * from MU_GRA_ESTUDIO order by DESCRIPCION asc, TIPO asc";

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function consultarPorTipo() {
        $sql = "select * from MU_GRA_ESTUDIO where TIPO = :tipo order by DESCRIPCION asc, TIPO asc";
        
        $query = $this->db->prepare($sql);
        
        $parametros = [
            ':tipo' => $this->getTIPO()
        ];
        
        $query->execute($parametros);
        
        return $query->fetchAll();
    }

}
