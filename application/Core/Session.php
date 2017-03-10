<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Core;

/**
 * Description of Session
 *
 * @author ingeniero.analista1
 */
class Session {

    public static function init() 
    {
        if (!isset($_SESSION))
        {
            session_start();
            if ( !isset($_SESSION["isGuest"]) )
            {
                self::set('isGuest', true);
            }
        }
    }

    public static function set($key, $var) 
    {
        $_SESSION[$key] = $var;
    }

    public static function get($key) 
    {
        if ( isset($_SESSION[$key]) )
        {
            return $_SESSION[$key];
        }
    }
    
    public static function isGuest()
    {
        return self::get("isGuest");

    }
    
    public static function destroy()
    {
        session_destroy();
    }
}
