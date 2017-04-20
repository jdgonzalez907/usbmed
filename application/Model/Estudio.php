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
 * @author ingeniero.analista4
 */
class Estudio extends Model{
    
    private $ID_ESTUDIO=null;
    private $DESCRIPCION=null;
    private $TIPO=null;
    
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
        return $this;
    }

    function setDESCRIPCION($DESCRIPCION) {
        $this->DESCRIPCION = $DESCRIPCION;
        return $this;
    }

    function setTIPO($TIPO) {
        $this->TIPO = $TIPO;
        return $this;
    }

    function consultarPrograma(){
        
        $sql="select * from MU_GRA_ESTUDIO where TIPO=:tipo";
        
        $query= $this->db->prepare($sql);
        
        $parametros=[':tipo'=> $this->getTIPO()];
        
        $query->execute($parametros);
        
        return $query->fetchAll();
        
    }
}
