<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Libs;

/**
 * Description of Alerta
 *
 * @author ingeniero.analista1
 */
class Alerta {
    
    /**
     * Mostrar alerta bootstrap
     * @param string $tipo
     * @param string $mensaje
     * @return string
     */
    public static function crear(string $tipo, string $mensaje): string
    {
        $html = '<div class="alert alert-' . $tipo . '" role="alert">';
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        $html .= '<strong>';
        switch ($tipo) {
            case 'info':
                $html .= 'Información:';
                break;
            case 'success':
                $html .= 'Éxito:';
                break;
            case 'warning':
                $html .= 'Peligro:';
                break;
            case 'danger':
                $html .= 'Error:';
                break;
            default:
                break;
        }
        $html .= '</strong>';
        $html .= '<br>';
        $html .= $mensaje;
        $html .= '</div>';
        
        return $html;
    }
    
}
