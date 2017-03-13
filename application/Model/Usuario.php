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

    private $CEDULA;
    private $CLAVE;
    private $ACCESO;
    private $FECHA_ACTUALIZA;

    public function getCEDULA() {
        return $this->CEDULA;
    }

    public function getCLAVE() {
        return $this->CLAVE;
    }

    public function getFECHA_ACTUALIZA() {
        return $this->FECHA_ACTUALIZA;
    }

    public function setCEDULA($CEDULA) {
        $this->CEDULA = $CEDULA;
    }

    public function setCLAVE($CLAVE) {
        $this->CLAVE = $CLAVE;
    }

    public function setACCESO($ACCESO) {
        $this->ACCESO = $ACCESO;
    }

    public function setFECHA_ACTUALIZA($FECHA_ACTUALIZA) {
        $this->FECHA_ACTUALIZA = $FECHA_ACTUALIZA;
    }
    
    /**
     * Consultar si existe información relacionada o no con la persona
     * @return boolean
     */
    public function existeInfo(): bool
    {
        $sql = "select "
                . "count(*) EXISTE "
                . "from COLILLA_EMPLEADO usu "
                . "inner join MU_PERSONA per on usu.CEDULA = per.IDENTIFICACION "
                . "where usu.CEDULA = :cedula";
        
        $query = $this->db->prepare($sql);
        $parametros = [':cedula' => $this->getCEDULA()];
        
        $query->execute($parametros);
        
        if ( (int)$query->fetch()->EXISTE > 0 )
        {
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Obtener información por usuario y clave
     * @return array
     */
    public function getInfoPorClave(): array
    {
        $sql = "select "
                . "per.* "
                . "from COLILLA_EMPLEADO usu "
                . "inner join MU_PERSONA per on usu.CEDULA = per.IDENTIFICACION "
                . "where usu.CEDULA = :cedula and usu.CLAVE = :clave";
        
        $query = $this->db->prepare($sql);
        $parametros = [':cedula' => $this->getCEDULA(), ':clave' => $this->getCLAVE()];
        
        $query->execute($parametros);
        
        return $query->fetchAll();
    }

    /**
     * Iniciar la sesión, consultando la información relacionada y los permisos de acuerdo al(los) rol(es)
     * @param array $info
     * @return bool
     */
    public function iniciarSesion(array $info): bool
    {
        if ( !empty($info) )
        {
            $usuario['usuario'] = $this->getCEDULA();
            $usuario['info'] = $info;
            
            Session::set('isGuest', false);
            Session::set('usuario', $usuario);
            
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
               ':cedula' => $this->getCEDULA()
            ];

            $query->execute($parameters);
            
            $permisos = [];
            
            foreach($query->fetchAll() as $permiso)
            {
                $permisos[] = $permiso->PERMISO;
            }

            Session::set('permisos', $permisos);
            
            return true;
        }else{
            return false;
        }
    }
    
}
