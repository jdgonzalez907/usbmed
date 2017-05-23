<?php

use Mini\Model\ListaGlobal;

$grupoInteres = null;
$facultad = null;
$cambioGrupo = true;

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
    
    .votos {
        font-size: 22px;
        text-align: center;
    }
</style>

<?php if ($tipo !== 'excel'): ?><div class="foto"><img class="logo" src="<?= URL ?>img/logo_usb.png"></div><?php endif; ?>

<h1>Resultado final</h1>

<p>
    A continuación, se lista el resultado final de votos.
</p>

<table class="postulacion" border="0" width="98%" align="center">
    <?php foreach ($planchas as $i => $p): ?>
        <?php
            if ($p->GRUPO_INTERES === '0' && $p->FACULTAD === '0' ){
                echo '<thead>
                        <tr style="background-color:#999999;">
                            <th class="th" colspan="' . (($tipo !== 'excel') ? '7' : '6') . '"><h2>VOTO EN BLANCO</h2></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="th votos" colspan="' . (($tipo !== 'excel') ? '7' : '6') . '">'.$p->TOTAL_VOTOS.'</td>
                        </tr>
                    </tbody>';
                continue;
            }else {
                if (is_null($grupoInteres) || $grupoInteres !== $p->GRUPO_INTERES) {
                    $grupoInteres = $p->GRUPO_INTERES;
                    $cambioGrupo = true;
                    echo '<tr style="background-color:#999999;"><th class="th" colspan="' . (($tipo !== 'excel') ? '7' : '6') . '"><h2>' . ListaGlobal::getGrupoInteres($grupoInteres) . '</h2></th></td>';
                }else{
                    $cambioGrupo = false;
                }

                if (is_null($facultad) || $facultad !== $p->FACULTAD || $cambioGrupo) {
                    $facultad = $p->FACULTAD;
                    echo '<tr style="background-color:#c9c9c9;"><th class="th" colspan="' . (($tipo !== 'excel') ? '7' : '6') . '"><h3>' . ListaGlobal::getFacultades($facultad) . '</h3></th></td>';
                    echo 
                        '<thead>
                            <tr>
                                <th class="th">Plancha</th>
                                <th class="th">Identificacion</th>
                                <th class="th">Nombre</th>
                                <th class="th">Correo</th>
                                <th class="th">Telefono</th>
                                '.(($tipo !== 'excel') ? '<th class="th">Foto</th>' : '').
                                '<th class="th">Votos</th>
                            </tr>
                        </thead>';
                }
            }
        ?>
        <tbody>
            <tr>
                <td class="td"><?= $p->POSTULACION_ID ?></td>
                <td class="td"><?= $p->IDENTIFICACION . ' (' . $p->TIPO_IDENTIFICACION . ')' ?></td>
                <td class="td"><?= $p->NOMBRES ?></td>
                <td class="td"><?= $p->CORREO ?></td>
                <td class="td"><?= $p->TELEFONO ?></td>
                <?php if ($tipo !== 'excel'): ?><td class="td foto"><img class="foto-resize" src="<?= URL . $p->FOTO ?>"></td><?php endif; ?>
                <td class="td"><?= $p->TOTAL_VOTOS ?></td>
            </tr>
        </tbody>
    <?php endforeach; ?>
</table>