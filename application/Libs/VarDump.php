<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Libs;

/**
 * Description of VarDump
 *
 * @author ingeniero.analista1
 */
class VarDump {
    
    public static function dump($var){
        echo "<pre>"; 
        var_dump($var);
    }
    
}
