<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\View;
use Mini\Model\FechasCurso;

/**
 * Description of ascensoReubicacionDocente
 *
 * @author ingeniero.analista1
 */
class AscensoReubicacionDocenteController extends Controller{
    
    public $loginUrl = 'usuario/iniciarSesion/ascensoReubicacionDocente';
    
    public function index()
    {
        $this->verificarPermisos();
        View::render('ascensoReubicacionDocente/index');
    }
    
    public function asistencia()
    {
        $this->verificarPermisos();
        
        $alerta = null;
        $consecutivosAsociados = [];
        
        $fechasCurso = new FechasCurso();
        $fechasCurso->setCEDULA_PROFESOR('1036663207');
        $fechasCurso->consecutivosAsociados();
                
        View::render(
            'ascensoReubicacionDocente/asistencia', 
            [
                'alerta' => $alerta,
                'consecutivosAsociados' => $consecutivosAsociados,
                'fechasCurso' => $fechasCurso
            ]
        );
    }
    
}
