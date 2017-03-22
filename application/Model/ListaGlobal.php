<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

/**
 * Description of ListaGlobal
 *
 * @author ingeniero.analista1
 */
class ListaGlobal {

    private static $estados = [
        'I' => 'Inactivo(a)',
        'A' => 'Activo(a)',
    ];
    private static $tipoProgramacion = [
        'I' => 'Inscripción',
        'V' => 'Votación',
    ];
    private static $tiposRutas = [
        'M' => 'Módulo',
        'C' => 'Controlador',
        'A' => 'Acción',
    ];
    private static $grupoInteres = [
        'EST' => 'ESTUDIANTES',
        'EGR' => 'EGRESADOS',
        'DOC' => 'DOCENTES',
        'ADM' => 'ADMINISTRATIVOS'
    ];
    private static $homologacionFacultadDocentes = [
        '444' => 'MFING',
        '446' => 'MFART',
        '442' => 'MFCIE',
        '443' => 'MFPSI',
        '447' => 'MFDER',
        '445' => 'MFEDU'
    ];
    private static $facultades = [
        'MFING' => 'INGENIERÍAS',
        'MFART' => 'ARTES INTEGRADAS',
        'MFCIE' => 'CIENCIAS EMPRESARIALES',
        'MFPSI' => 'PSICOLOGÍA',
        'MFDER' => 'DERECHO',
        'MFEDU' => 'EDUCACIÓN'
    ];

    public static function getEstados($keyEstado = null) {
        if ($keyEstado == null)
        {
            return self::$estados;
        }else if($keyEstado){
            if (isset(self::$estados[$keyEstado]))
            {
                return self::$estados[$keyEstado];
            }else{
                return false;
            }
        }
    }

    public static function getTipoProgramaciones($keyTipoPogramacion = null) {
        if ($keyTipoPogramacion == null)
        {
            return self::$tipoProgramacion;
        }else if($keyTipoPogramacion){
            if (isset(self::$tipoProgramacion[$keyTipoPogramacion]))
            {
                return self::$tipoProgramacion[$keyTipoPogramacion];
            }else{
                return false;
            }
        }
    }

    public static function getTipoRutas($keyTipoRuta = null) {
        if ($keyTipoRuta == null)
        {
            return self::$tiposRutas;
        }else if($keyTipoRuta){
            if (isset(self::$tiposRutas[$keyTipoRuta]))
            {
                return self::$tiposRutas[$keyTipoRuta];
            }else{
                return false;
            }
        }
    }

    public static function getGrupoInteres($keyGrupoInteres = null) {
        if ($keyGrupoInteres == null)
        {
            return self::$grupoInteres;
        }else if($keyGrupoInteres){
            if (isset(self::$grupoInteres[$keyGrupoInteres]))
            {
                return self::$grupoInteres[$keyGrupoInteres];
            }else{
                return false;
            }
        }
    }

    public static function getHomologacionFacultades($keyFacultad = null) {
        if ($keyFacultad == null)
        {
            return self::$homologacionFacultadDocentes;
        }else if($keyFacultad){
            if (isset(self::$homologacionFacultadDocentes[$keyFacultad]))
            {
                return self::$homologacionFacultadDocentes[$keyFacultad];
            }else{
                return false;
            }
        }
    }

    public static function getFacultades($keyFacultad = null) {
        if ($keyFacultad == null)
        {
            return self::$facultades;
        }else if($keyFacultad){
            if (isset(self::$facultades[$keyFacultad]))
            {
                return self::$facultades[$keyFacultad];
            }else{
                return false;
            }
        }
    }

}
