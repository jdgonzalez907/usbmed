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

    public function existeInfo() {
        $sql = "select "
                . "count(*) EXISTE "
                . "from COLILLA_EMPLEADO usu "
                . "inner join MU_PERSONA per on usu.CEDULA = per.IDENTIFICACION "
                . "where usu.CEDULA = :cedula";

        $query = $this->db->prepare($sql);
        $parametros = [':cedula' => $this->getCEDULA()];

        $query->execute($parametros);

        if ((int) $query->fetch()->EXISTE > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getInfoPorClave() {
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

    public function getInfoPorFecha() {
        $sql = "select "
                . "usu.CLAVE, "
                . "per.* "
                . "from COLILLA_EMPLEADO usu "
                . "inner join MU_PERSONA per on usu.CEDULA = per.IDENTIFICACION "
                . "where usu.CEDULA = :cedula and TO_CHAR(per.FECHA_NACIMIENTO, 'YYYY/MM/DD') = :clave";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':cedula' => $this->getCEDULA(),
            ':clave' => $this->getCLAVE()
        ];

        $query->execute($parametros);

        return $query->fetchAll();
    }

    public function getInfoPorCedula() {
        $sql = "select "
                . "per.* "
                . "from COLILLA_EMPLEADO usu "
                . "inner join MU_PERSONA per on usu.CEDULA = per.IDENTIFICACION "
                . "where usu.CEDULA = :cedula";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':cedula' => $this->getCEDULA()
        ];

        $query->execute($parametros);

        return $query->fetchAll();
    }

    public function iniciarSesion($info, $cargarPermisos = true) {
        if (!empty($info)) {
            $usuario['usuario'] = $this->getCEDULA();
            $usuario['info'] = $info;

            Session::set('isGuest', false);
            Session::set('usuario', $usuario);

            if ($cargarPermisos) {
                $sql = "
                    select distinct
                    u.*
                    from COLILLA_EMPLEADO p
                    inner join MU_ROL_PERSONA rp
                    on p.CEDULA = rp.CEDULA
                    inner join MU_ROL r
                    on r.ROL = rp.ROL
                    inner join MU_ROL_URL ru
                    on ru.ROL = r.ROL
                    inner join MU_URL u
                    on u.URL = ru.URL
                    where p.CEDULA = :cedula
                    order by u.ORDEN
                ";

                $query = $this->db->prepare($sql);
                $parameters = [
                    ':cedula' => $this->getCEDULA()
                ];

                $query->execute($parameters);

                $permisos = [];

                $resultado = $query->fetchAll();

                foreach ($resultado as $permiso) {
                    $permisos[$permiso->URL] = [
                        'URL' => $permiso->URL,
                        'NOMBRE' => $permiso->NOMBRE,
                        'TIPO' => $permiso->TIPO,
                        'ICONO' => $permiso->ICONO,
                        'ORDEN' => $permiso->ORDEN
                    ];
                }

                Session::set('permisos', $permisos);
            }

            return true;
        } else {
            return false;
        }
    }

    public static function getMenuPrincipal() {
        $menuPrincipal = [];

        foreach (Session::get('permisos') as $url => $item) {
            if ($item['TIPO'] === 'C') {
                $menuPrincipal[] = $item;
            }
        }

        return $menuPrincipal;
    }

    public static function getMenuPermisos() {
        $menuPermisos = [];

        foreach (Session::get('permisos') as $url => $item) {
            $controlador = explode('/', \Mini\Core\Application::$url_id)[0];

            if (strpos($item['URL'], $controlador) === 0 && !is_null($item['ORDEN'])) {
                $menuPermisos[] = $item;
            }
        }

        return $menuPermisos;
    }

    public function claveActual() {
        $sql = "select "
                . "COUNT(*) ES_VALIDA "
                . "from COLILLA_EMPLEADO "
                . "where CEDULA = :cedula and CLAVE = :clave";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':cedula' => $this->getCEDULA(),
            ':clave' => $this->getCLAVE()
        ];

        $query->execute($parametros);

        return $query->fetch();
    }

    public function cambiarClave() {
        $sql = "update COLILLA_EMPLEADO set "
                . "CLAVE = :clave, "
                . "FECHA_ACTUALIZA = sysdate "
                . "where CEDULA = :cedula";

        $query = $this->db->prepare($sql);
        $parametros = [
            ':cedula' => $this->getCEDULA(),
            ':clave' => $this->getCLAVE()
        ];

        $query->execute($parametros);

        return $query->rowCount();
    }

}
