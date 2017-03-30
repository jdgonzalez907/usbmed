<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Core;

/**
 * Description of View
 *
 * @author ingeniero.analista1
 */
class View {
    
    /** @var string Título de la página*/
    public static $titulo = "Aplicaciones - Universidad San Buenaventura de Medellín";
    
    private static $js = null;
    
    
    /**
     * Función para renderizar las vistas en los controladores
     * @param string $view    Vista a renderizar
     * @param array  $vars    Array con las variables a renderizar, por defecto 'null'
     * @param string $layout  Layout a utilizar, por defecto 'default'
     */
    public static function render($view, $vars = null, $layout = 'default')
    {
        if (!is_null($vars) && is_array($vars))
        {
            extract($vars);
        }
        if ($layout)
            require APP . 'View/_templates/'.$layout.'/header.php';
        
        require APP . 'View/'.$view.'.php';
        
        if ($layout)
            require APP . 'View/_templates/'.$layout.'/footer.php';
    }
    
    /**
     * Función para redirijar dentro de la página
     * @param string $url Url a redireccionar
     */
    public static function redirect($url, $absolute = false)
    {
        header('location: ' . (($absolute) ? '' : URL) . $url);
    }
    
    public static function registerJs($js)
    {
        self::$js = $js;
    }
    
    public static function getJs()
    {
        return self::$js;
    }
}
