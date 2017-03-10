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
class Programacion extends Model{
    
    public function getProgramacionActual()
    {
        $annio = date('Y');
        
        $sql = "
            select
                ANNIO,
                to_char(FECHA_INICIO_INSCRIPCION, 'YYYY-MM-DD HH24:MI:SS') FECHA_INICIO_INSCRIPCION,
                to_char(FECHA_FIN_INSCRIPCION, 'YYYY-MM-DD HH24:MI:SS') FECHA_FIN_INSCRIPCION,
                to_char(FECHA_INICIO_VOTACION, 'YYYY-MM-DD HH24:MI:SS') FECHA_INICIO_VOTACION,
                to_char(FECHA_FIN_VOTACION, 'YYYY-MM-DD HH24:MI:SS') FECHA_FIN_VOTACION,
                USUARIO_CREA,
                FECHA_CREA,
                USUARIO_ACTUALIZA,
                FECHA_ACTUALIZA
            from
            MU_REP_PROGRAMACION
            where
            ANNIO = :annio
        ";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':annio' => $annio);

        $query->execute($parameters);

        return $query->fetch();
    }
    
    public function update($annio, $fecha_inicio_inscripcion, $fecha_fin_inscripcion, $fecha_inicio_votacion, $fecha_fin_votacion, $usuario_crea, $fecha_crea, $usuario_actualiza, $fecha_actualiza)
    {
        $sql = "
            update 
                MU_REP_PROGRAMACION
            set 
                FECHA_INICIO_INSCRIPCION = to_date(:fecha_inicio_inscripcion, 'YYYY-MM-DD HH24:MI:SS'),
                FECHA_FIN_INSCRIPCION = to_date(:fecha_fin_inscripcion, 'YYYY-MM-DD HH24:MI:SS'),
                FECHA_INICIO_VOTACION = to_date(:fecha_inicio_votacion, 'YYYY-MM-DD HH24:MI:SS'),
                FECHA_FIN_VOTACION = to_date(:fecha_fin_votacion, 'YYYY-MM-DD HH24:MI:SS'),
                USUARIO_CREA = :usuario_crea,
                FECHA_CREA = to_date(:fecha_crea, 'YYYY-MM-DD HH24:MI:SS'),
                USUARIO_ACTUALIZA = :usuario_actualiza,
                FECHA_ACTUALIZA = to_date(:fecha_actualiza, 'YYYY-MM-DD HH24:MI:SS')
            where
                ANNIO = :annio
        ";
        
        $query = $this->db->prepare($sql);
        $parameters = [
            ':fecha_inicio_inscripcion' => $fecha_inicio_inscripcion,
            ':fecha_fin_inscripcion' 	=> $fecha_fin_inscripcion,
            ':fecha_inicio_votacion' 	=> $fecha_inicio_votacion,
            ':fecha_fin_votacion'       => $fecha_fin_votacion,
            ':usuario_crea' 		=> $usuario_crea,
            ':fecha_crea' 		=> $fecha_crea,
            ':usuario_actualiza' 	=> $usuario_actualiza,
            ':fecha_actualiza' 		=> $fecha_actualiza,
            ':annio'                    => $annio
        ];
        
        $query->execute($parameters);
        
        return $query->rowCount();
    }
    
    public function insert($annio, $fecha_inicio_inscripcion, $fecha_fin_inscripcion, $fecha_inicio_votacion, $fecha_fin_votacion, $usuario_crea, $fecha_crea, $usuario_actualiza, $fecha_actualiza)
    {
        $sql = "
            insert into 
                MU_REP_PROGRAMACION
            values(
                :annio,
                to_date(:fecha_inicio_inscripcion, 'YYYY-MM-DD HH24:MI:SS'),
                to_date(:fecha_fin_inscripcion, 'YYYY-MM-DD HH24:MI:SS'),
                to_date(:fecha_inicio_votacion, 'YYYY-MM-DD HH24:MI:SS'),
                to_date(:fecha_fin_votacion, 'YYYY-MM-DD HH24:MI:SS'),
                :usuario_crea,
                to_date(:fecha_crea, 'YYYY-MM-DD HH24:MI:SS'),
                :usuario_actualiza,
                to_date(:fecha_actualiza, 'YYYY-MM-DD HH24:MI:SS')
            )
        ";
        
        $query = $this->db->prepare($sql);
        $parameters = [
            ':annio'                    => $annio,
            ':fecha_inicio_inscripcion' => $fecha_inicio_inscripcion,
            ':fecha_fin_inscripcion' 	=> $fecha_fin_inscripcion,
            ':fecha_inicio_votacion' 	=> $fecha_inicio_votacion,
            ':fecha_fin_votacion'       => $fecha_fin_votacion,
            ':usuario_crea' 		=> $usuario_crea,
            ':fecha_crea' 		=> $fecha_crea,
            ':usuario_actualiza' 	=> $usuario_actualiza,
            ':fecha_actualiza' 		=> $fecha_actualiza
        ];

        $query->execute($parameters);
        
        return $query->rowCount();
    }
}
