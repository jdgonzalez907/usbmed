<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Model;

use Mini\Core\Model;

/**
 * Description of Buzon
 *
 * @author ingeniero.analista1
 */
class Buzon extends Model{

    private $NOMBRECOMPLETO;
    private $CORREO;
    private $DIRECCION;
    private $TELEFONO;
    private $TIPODEUSUARIO;
    private $PERTENECE;
    private $TIPOMENSAJE;
    private $IMAGENCAPTCHA;
    private $CAPTCHA;
    private $FECHA;
    private $CONSECUTIVO;
    private $COMENTARIO;
    private $SECCIONAL;
    private $CONTACTO;

    public function setNOMBRECOMPLETO($NOMBRECOMPLETO){
        $this->NOMBRECOMPLETO = $NOMBRECOMPLETO;
    }
    public function setCORREO($CORREO){
        $this->CORREO = $CORREO;
    }
    public function setDIRECCION($DIRECCION){
        $this->DIRECCION = $DIRECCION;
    }
    public function setTELEFONO($TELEFONO){
        $this->TELEFONO = $TELEFONO;
    }
    public function setTIPODEUSUARIO($TIPODEUSUARIO){
        $this->TIPODEUSUARIO = $TIPODEUSUARIO;
    }
    public function setPERTENECE($PERTENECE){
        $this->PERTENECE = $PERTENECE;
    }
    public function setTIPOMENSAJE($TIPOMENSAJE){
        $this->TIPOMENSAJE = $TIPOMENSAJE;
    }
    public function setIMAGENCAPTCHA($IMAGENCAPTCHA){
        $this->IMAGENCAPTCHA = $IMAGENCAPTCHA;
    }
    public function setCAPTCHA($CAPTCHA){
        $this->CAPTCHA = $CAPTCHA;
    }
    public function setFECHA($FECHA){
        $this->FECHA = $FECHA;
    }
    public function setCONSECUTIVO($CONSECUTIVO){
        $this->CONSECUTIVO = $CONSECUTIVO;
    }
    public function setCOMENTARIO($COMENTARIO){
        $this->COMENTARIO = $COMENTARIO;
    }
    public function setSECCIONAL($SECCIONAL){
        $this->SECCIONAL = $SECCIONAL;
    }
    public function setCONTACTO($CONTACTO){
        $this->CONTACTO = $CONTACTO;
    }

    public function getNOMBRECOMPLETO()
    {
        return $this->NOMBRECOMPLETO;
    }
    public function getCORREO()
    {
        return $this->CORREO;
    }
    public function getDIRECCION()
    {
        return $this->DIRECCION;
    }
    public function getTELEFONO()
    {
        return $this->TELEFONO;
    }
    public function getTIPODEUSUARIO()
    {
        return $this->TIPODEUSUARIO;
    }
    public function getPERTENECE()
    {
        return $this->PERTENECE;
    }
    public function getTIPOMENSAJE()
    {
        return $this->TIPOMENSAJE;
    }
    public function getIMAGENCAPTCHA()
    {
        return $this->IMAGENCAPTCHA;
    }
    public function getCAPTCHA()
    {
        return $this->CAPTCHA;
    }
    public function getFECHA()
    {
        return $this->FECHA;
    }
    public function getCONSECUTIVO()
    {
        return $this->CONSECUTIVO;
    }
    public function getCOMENTARIO()
    {
        return $this->COMENTARIO;
    }
    public function getSECCIONAL()
    {
        return $this->SECCIONAL;
    }
    public function getCONTACTO()
    {
        return $this->CONTACTO;
    }

    private static $dependencia = [
        "AdministradorBuzon" => [
             "nombre" => "Administrador del Buzon Vosavoz",
             "email" => "Erika.Valencia@usbmed.edu.co"
        ],
        "AseoUniversidad" => [
             "nombre" => "Aseo de la Universidad",
             "email" => "magdalena.trujillo@usbmed.edu.co"
        ],
        "AulasClase" => [
             "nombre" => "Aulas de clase",
             "email" => "magdalena.trujillo@usbmed.edu.co"
        ],
        "Cafeterias" => [
             "nombre" => "Cafeterias",
             "email" => "francisco.suarez@usbmed.edu.co"
        ],
        "ServiciosMedicos" => [
             "nombre" => "Servicios Medicos",
             "email" => "catalina.tobon@usbmed.edu.co"
        ],
        "ServiciosPsicologicos" => [
             "nombre" => "Servicios Psicologicos",
             "email" => "catalina.tobon@usbmed.edu.co"
        ],
        "EscenariosDeportivos" => [
             "nombre" => "Escenarios Deportivos",
             "email" => "francisco.suarez@usbmed.edu.co"
        ],
        "EscenariosActividadesArtisticas" => [
             "nombre" => "Escenarios para actividades artisticas",
             "email" => "francisco.suarez@usbmed.edu.co"
        ],
        "EventosCulturales " => [
             "nombre" => "Eventos Culturales",
             "email" => "francisco.suarez@usbmed.edu.co"
        ],
        "FinanciacionEducativa" => [
             "nombre" => "Financiacion Educativa",
             "email" => "adriana.naranjo@usbmed.edu.co"
        ],
        "ForosTalleresSeminarios" => [
             "nombre" => "Foros, talleres y seminarios",
             "email" => "diana.valencia@usbmed.edu.co"
        ],
        "programasCentroEducacionContinua" => [
             "nombre" => "Inconformidades y sugerencias sobre los programas del Centro de Educacion Continua",
             "email" => "diana.valencia@usbmed.edu.co"
        ],
        "Inscripciones" => [
             "nombre" => "Inscripciones",
             "email" => "eroelia.vergara@usbmed.edu.co"
        ],
        "Internet" => [
             "nombre" => "Internet",
             "email" => "carlos.cortes@usbmed.edu.co"
        ],
        "Eventos" => [
             "nombre" => "Eventos",
             "email" => "dairon.sanchez@usbmed.edu.co"
        ],
        "Parqueadero" => [
             "nombre" => "Parqueadero",
             "email" => "magdalena.trujillo@usbmed.edu.co"
        ],
        "SeguridadInstitucional" => [
             "nombre" => "Seguridad Institucional",
             "email" => "magdalena.trujillo@usbmed.edu.co"
        ],
        "ServicioApoyoAcademico " => [
             "nombre" => "Servicio de apoyo academico",
             "email" => "francisco.suarez@usbmed.edu.co"
        ],
        "FacultadCienciasEmpresariales" => [
             "nombre" => "Facultad de Ciencias Empresariales",
             "email" => "alvaro.torrenegra@usbmed.edu.co"
        ],
        "FacultadEducacion" => [
             "nombre" => "Facultad de Educacion",
             "email" => "sandra.posadah@usbmed.edu.co"
        ],
        "FacultadDerecho" => [
             "nombre" => "Facultad de Derecho",
             "email" => "julia.montano@usbmed.edu.co"
        ],
        "FacultadArtesIntegradas" => [
             "nombre" => "Facultad de Artes Integradas",
             "email" => "marlon.builes@usbmed.edu.co"
        ],
        "FacultadPsicologia" => [
             "nombre" => "Facultad de Psicologia",
             "email" => "henry.castillo@usbmed.edu.co"
        ],
        "FacultadIngenierias" => [
             "nombre" => "Facultad de Ingenieria",
             "email" => "giovani.orozco@usbmed.edu.co"
        ],
        "MediosAudiovisuales" => [
             "nombre" => "Medios Audiovisuales",
             "email" => "yony.guerra@usbmed.edu.co"
        ],
        "MantenimientoYEspaciosFisicos" => [
             "nombre" => "Mantenimiento y Espacios Fisicos",
             "email" => "magdalena.trujillo@usbmed.edu.co"
        ],
        "DepartamentoPublicaciones" => [
             "nombre" => "Departamento de Publicaciones",
             "email" => "jorge.alvarez@usbmed.edu.co"
        ],
        "DepartamentoFinanciero" => [
             "nombre" => "Departamento Financiero",
             "email" => "adriana.naranjo@usbmed.edu.co"
        ],
        "RegistroAcademico" => [
             "nombre" => "Registro Academico",
             "email" => "eroelia.vergara@usbmed.edu.co"
        ],
        "Biblioteca" => [
             "nombre" => "Biblioteca",
             "email" => "angela.restrepo@usbmed.edu.co"
        ],
        "UnidadTecnologia" => [
             "nombre" => "Unidad de Tecnologia",
             "email" => "ingeniero.analista1@usbmed.edu.co"
        ],
        "LaboratoriosPsicologia" => [
             "nombre" => "Laboratorios de Psicologia",
             "email" => "arturo.ramirez@usbmed.edu.co"
        ],
        "CentroAdministracionDocumental" => [
             "nombre" => "Centro Administracion Documental",
             "email" => "liliana.hoyos@usbmed.edu.co"
        ],
        "Deportes" => [
             "nombre" => "Deportes",
             "email" => "helder.acevedo@usbmed.edu.co"
        ],
        "Egresados" => [
             "nombre" => "Egresados",
             "email" => "john.piedrahita@usbmed.edu.co"
        ],
        "Comunicaciones" => [
             "nombre" => "Comunicaciones",
             "email" => "alejandro.roman@usbmed.edu.co"
        ],
        "Mercadeo" => [
             "nombre" => "Mercadeo",
             "email" => "dairon.sanchez@usbmed.edu.co"
        ],
        "EducacionContinua" => [
             "nombre" => "Educacion Continua",
             "email" => "diana.correa@usbmed.edu.co"
        ],
        "GestionHumana" => [
             "nombre" => "Gestion Humana",
             "email" => "diego.arenas@usbmed.edu.co"
        ],
        "CentroApoyoSecretarial" => [
             "nombre" => "Centro de Apoyo Secretarial",
             "email" => "paola.hoyos@usbmed.edu.co"
        ],
        "DireccionAcademica" => [
             "nombre" => "Vicerrectoria Academica",
             "email" => "giovani.orozco@usbmed.edu.co"
        ],
        "DireccionAdministrativa" => [
             "nombre" => "Vicerrectoria Administrativa y Financiera",
             "email" => "francisco.suarez@usbmed.edu.co"
        ],
        "DirecciondeInvestigaciones" => [
             "nombre" => "Direccion de Investigaciones",
             "email" => "carlos.garciar@usbmed.edu.co"
        ],
        "GestiónCalidad" => [
             "nombre" => "Gestion de la Calidad",
             "email" => "sic@usbmed.edu.co"
        ],
        "BienestarUniversitario" => [
             "nombre" => "Bienestar Universitario",
             "email" => "catalina.tobon@usbmed.edu.co"
        ],
        "Formacionhumana" => [
             "nombre" => "Formacion Humana y Bioetica",
             "email" => "carlos.cardona@usbmed.edu.co"
        ],
        "Sitioweb" => [
             "nombre" => "Sitio Web",
             "email" => "web.master@usbmed.edu.co"
        ]
    ];

    private static $personas = [
        1 => "Docente",
        2 => "Egresado",
        3 => "Empleado",
        4 => "Estudiante",
        5 => "Externo"
    ];

    private static $tipoMensaje = [
        'Queja' => "Queja",
        'Reclamo' => "Reclamo",
        'Sugerencia' => "Sugerencia",
        'Felicitacion' => "Felicitación",
        'Consulta' => "Consulta"
    ];

    private static $Seccional = [
        'Salento' => "Salento (Campus)",
        'San Benito' => "San Benito"
    ];

    public function getConfiguracionDependencia($keyDependencia = null) {
        if ($keyDependencia == null)
        {
            return self::$dependencia;
        }else if($keyDependencia){
            if (isset(self::$dependencia[$keyDependencia]))
            {
                return self::$dependencia[$keyDependencia];
            }else{
                return false;
            }
        }
    }

    public function getPersonas($keyPersona = null) {
        if ($keyPersona == null)
        {
            return self::$personas;
        }else if($keyPersona){
            if (isset(self::$personas[$keyPersona]))
            {
                return self::$personas[$keyPersona];
            }else{
                return false;
            }
        }
    }

    public function getTipoMensajes($keyTipoMensaje = null) {
        if ($keyTipoMensaje == null)
        {
            return self::$tipoMensaje;
        }else if($keyTipoMensaje){
            if (isset(self::$tipoMensaje[$keyTipoMensaje]))
            {
                return self::$tipoMensaje[$keyTipoMensaje];
            }else{
                return false;
            }
        }
    }

    public function getSeccionales($keySeccional = null) {
        if ($keySeccional == null)
        {
            return self::$Seccional;
        }else if($keySeccional){
            if (isset(self::$Seccional[$keySeccional]))
            {
                return self::$Seccional[$keySeccional];
            }else{
                return false;
            }
        }
    }
    
    public function obtenerConsecutivo()
    {
        $sql = "
            select MAX(GCALIDAD.SIC_BUZON.CONSECUTIVO) + 1 as Consecutivo
            from GCALIDAD.SIC_BUZON
        ";

        $query = $this->db->prepare($sql);

        $query->execute();

        $this->setCONSECUTIVO($query->fetch()->CONSECUTIVO);
    }

    public function cargarPlanesAcademicos()
    {
        $sql = "
            select distinct upper(p.nombre_plan) Detalle
            from   rar_planes_estudios p
            where  exists
                (select t.codigo_plan
                from   rar_titulos_expedidos t,
                rap_graduado g
                where  t.codigo_plan   = p.codigo_plan
                and    t.codigo_titulo = g.codigo_titulo)
            order by 1
        ";

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function cargarFacultades()
    {
        $sql = "
            select upper(nombre_facultad) Detalle
            from   rar_facultades
            where  codigo_facultad not in (8,5,11,50,99,9,10)
            order by 1 
        ";

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function cargarDependencias()
    {
        $sql = "
            select upper(nombre_dependencia) Detalle
            from   dependencia
            where  nombre_dependencia <> 'DEFAULT'
            order by 1
        ";

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function enviarEmail()
    {
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $cabeceras .= 'From: Universidad San Buenaventura de Medellin<usbmed@usbmed.edu.co>';

        $titulo = "Buzón vosavoz - USB Medellín";
        $para = 'Erika.Valencia@usbmed.edu.co';

        $mensaje = "".
            "<br> -------------------------".
            "<br> DATOS USUARIO".
            "<br> -------------------------".
            "<br> Nombre Completo: ".$this->getNOMBRECOMPLETO().
            "<br> Email: ".$this->getCORREO().
            "<br> Dirección: ".$this->getDIRECCION().
            "<br> Teléfono: ".$this->getTELEFONO().
            "<br> Fecha (día, mes, año): ".$this->getFECHA().
            "<br>-------------------------".
            "<br>TIPO DE MENSAJE<br> DESTINO Y COMENTARIO".
            "<br>--------------------------".
            "<br> Tipo de mensaje: ".$this->getTIPOMENSAJE().
            "<br> Destino: ".$this->getCONTACTO()["nombre"].
            "<br> Comentario: ".$this->getCOMENTARIO();

        $enviado = mail($para, $titulo, $mensaje, $cabeceras);

        return $enviado;        
    }

    public function crearRegistro()
    {
        $sql = "begin 
                gcalidad.Crear_registro (
                    '".$this->getNOMBRECOMPLETO()."',
                    '".$this->getCORREO()."',
                    '".$this->getTELEFONO()."',
                    '".$this->getTIPOMENSAJE()."',
                    '".$this->getCONTACTO()['nombre']."',
                    '".$this->getCOMENTARIO()."',
                    '"."V"."',
                    '".$this->getDIRECCION()."',
                    ".$this->getTIPODEUSUARIO().",
                    '".$this->getSECCIONAL()."',
                    '".$this->getPERTENECE()."',
                    ".$this->getCONSECUTIVO()."
                ); 
                end;";

        $query = $this->db->prepare($sql);

        $query->execute();
    }

}
