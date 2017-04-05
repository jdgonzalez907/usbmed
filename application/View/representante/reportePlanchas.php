<?php

use Mini\Model\ListaGlobal;

$grupoInteres = null;
$facultad = null;

?>

<style>
    body {
        background-color: transparent;
    }
    
    p {
        text-align: justify;
    }

    .postulacion {
        font-size: 10px;
        border-collapse: collapse;
        margin-bottom: 5px; 
    }

    .postulacion, .th, .td {
        border: 1px solid black;
    }
    
    .th {
        padding: 7px;
        font-size: 14px;
    }
    
    .td {
        padding: 3px;
        text-align: justify;
    }
    
    .foto {
        text-align: center;
    }
    
    .foto-resize {
        width: 50px;
        height: 50px;
    }
    
    .logo {
        width: 175px;
        height: 61.5px;
    }
    
    .clear {
        clear: both; 
        margin: 0pt; 
        padding: 0pt;
    }
</style>

<?php if($tipo!=='excel'): ?><div class="foto"><img class="logo" src="<?= URL ?>img/logo_usb.png"></div><?php endif; ?>

<h1>Planchas</h1>

<p>
    A continuación, se listarán por los grupos de interés y sus facultades, 
    las planchas inscritas hasta el momento en el sistema.
</p>

<table class="postulacion" border="0" width="98%" align="center">
    <thead>
        <tr>
            <th class="th">Plancha</th>
            <th class="th">Grupo interés</th>
            <th class="th">Facultad</th>
            <th class="th">Identificacion</th>
            <th class="th">Nombre</th>
            <th class="th">Correo</th>
            <th class="th">Telefono</th>
            <?php if($tipo!=='excel'): ?><th class="th">Foto</th><?php endif; ?>
            <th class="th">Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($planchas as $i => $p): ?>
        <tr>
            <td class="td"><?= $p->POSTULACION_ID ?></td>
            <td class="td"><?= ListaGlobal::getGrupoInteres($p->GRUPO_INTERES) ?></td>
            <td class="td"><?= ListaGlobal::getFacultades($p->FACULTAD) ?></td>
            <td class="td"><?= $p->IDENTIFICACION .' ('.$p->TIPO_IDENTIFICACION.')' ?></td>
            <td class="td"><?= $p->NOMBRES ?></td>
            <td class="td"><?= $p->CORREO ?></td>
            <td class="td"><?= $p->TELEFONO ?></td>
            <?php if($tipo!=='excel'): ?><td class="td foto"><img class="foto-resize" src="<?= URL.$p->FOTO ?>"></td><?php endif; ?>
            <td class="td" style="color:white; background-color: <?= ($p->ESTADO === 'A' ? '#16a085' : '#c0392b' ) ?>"><?= ListaGlobal::getEstados($p->ESTADO) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>