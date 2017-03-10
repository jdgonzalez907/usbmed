<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Core\Session;

/**
 * Description of Usuario
 *
 * @author ingeniero.analista1
 */
class Usuario extends Model {

    public function getUsuario($cedula) {
        $sql = "
            select
            * 
            from 
                COLILLA_EMPLEADO
            inner join MU_PERSONA
             on IDENTIFICACION = CEDULA
            where CEDULA = :cedula and ESTADO = 'A'
        ";

        $query = $this->db->prepare($sql);
        $parameters = array(':cedula' => $cedula);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getUsuarioClave($cedula, $clave) {
        $sql = "
            select
            * 
            from 
                COLILLA_EMPLEADO
            inner join MU_PERSONA
             on IDENTIFICACION = CEDULA
            where CEDULA = :cedula and CLAVE = :clave and ESTADO = 'A'
        ";

        $query = $this->db->prepare($sql);
        $parameters = [
            ':cedula' => $cedula,
            ':clave' => $clave
        ];

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function iniciarSesion($usuario, $cedula)
    {
        if ($usuario){
            Session::set('usuario', $usuario);
            Session::set('isGuest', false);
            
            $sql = "
                select distinct ru.URL as PERMISO
                from COLILLA_EMPLEADO p
                inner join MU_ROL_PERSONA rp
                on p.CEDULA = rp.CEDULA
                inner join MU_ROL r
                on r.ROL = rp.ROL
                inner join MU_ROL_URL ru
                on ru.ROL = r.ROL
                where p.CEDULA = :cedula
            ";

            $query = $this->db->prepare($sql);
            $parameters = [
               ':cedula' => $cedula
            ];

            $query->execute($parameters);
            
            $permisos = [];
            
            foreach($query->fetchAll() as $permiso)
            {
                $permisos[] = $permiso->PERMISO;
            }

            Session::set('permisos', $permisos);
            
            return true;
        }
        
        return false;
    }
    
    public function cerrarSesion()
    {
        Session::destroy();
    }
}
