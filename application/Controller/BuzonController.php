<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\View;
use Mini\Core\Session;
use Mini\Model\Buzon;

/**
 * Description of BuzonController
 *
 * @author ingeniero.analista1
 */
class BuzonController extends Controller {

    public function pqr()
    {
        $alerta= null;
        $buzon = new Buzon();
        $buzon->setCONTACTO(['nombre' => null, 'email' => null]);

        if (isset($_POST["Enviar"]))
        {
            // Asignar propiedades
            $buzon->setNOMBRECOMPLETO($_POST["NombreCompleto"]);
            $buzon->setCORREO($_POST["Correo"]);
            $buzon->setDIRECCION($_POST["Direccion"]);
            $buzon->setTELEFONO($_POST["Telefono"]);
            $buzon->setTIPODEUSUARIO($_POST["TipoDeUsuario"]);
            $buzon->setPERTENECE($_POST["Pertenece"]);
            $buzon->setTIPOMENSAJE($_POST["TipoMensaje"]);
            $buzon->setFECHA(date('Y-m-d'));
            $buzon->setCOMENTARIO($_POST["Comentario"]);
            $buzon->setSECCIONAL($_POST["Seccional"]);
            $buzon->setCONTACTO($buzon->getConfiguracionDependencia($_POST["Contacto"]));

            if (Session::get("textoTemp") === $_POST["Captcha"]) 
            {
                //Generar consecutivo
                $buzon->obtenerConsecutivo();

                $buzon->enviarEmail();

                $buzon->crearRegistro();

                $alerta = [
                    "tipo" => "success",
                    "mensaje" => "
                        La información se envío correctamente, le atenderemos lo más pronto posible.
                    "
                ];
				
				$buzon = new Buzon();
            }else{
                $alerta = [
                    'tipo' => 'danger',
                    'mensaje' => 'El código de la imagen no coincide con el ingresado, por favor intentelo nuevamente.'
                ];
            }
        }


        View::render("buzon/pqr", ['buzon' => $buzon, 'alerta' => $alerta], "buzon");
    }

    public function ajaxDetalle($tipoUsuario)
    {
        if ($this->isAjax()) {
            $detalle = null;
            $tempDetalle = null;

            $buzon = new Buzon();

            switch ($tipoUsuario) {
                case 1:
                    $tempDetalle = $buzon->cargarFacultades();
                    break;
                case 2:
                    $tempDetalle = $buzon->cargarPlanesAcademicos();
                    break;
                case 3:
                    $tempDetalle = $buzon->cargarDependencias();
                    break;
                case 4:
                    $tempDetalle = $buzon->cargarFacultades();
                    break;
                case 5:
                    $obj = new \stdClass();
                    $obj->DETALLE = "EXTERNO";
                    $tempDetalle[] = $obj;
                    break;
                
                default:
                    $tempDetalle = null;
                    break;
            }

            foreach ($tempDetalle as $value) {
                $detalle[] = $value->DETALLE;
            }

            echo json_encode($detalle);
        }
    }

    public function generarCaptcha()
    {
        Session::set("textoTemp", $this->generarTexto());

        $imagen = imagecreate(100, 47.5);
        $fondo = imagecolorallocate($imagen, 250, 104, 0);
        $colorTexto = imagecolorallocate($imagen, 254, 254, 254);
        imagestring($imagen, 5, 30, 15, Session::get("textoTemp"), $colorTexto);

        header('Content-type: image/png');

        imagepng($imagen);
        //imagedestroy($imagen);
    }

    private function generarTexto()
    {
        $texto = "";

        $numeros = [0,1,2,3,4,5,6,7,8,9];
        $letrasMinusculas = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
        $letrasMayusculas = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

        $patron = array_merge($numeros, $letrasMinusculas, $letrasMayusculas);

        $maximo = 4;

        for ($i=0; $i < $maximo; $i++) { 
            $texto .= $patron[rand(0, 62)];
        }

        return $texto;
    }
}