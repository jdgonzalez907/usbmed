<?php

use Mini\Core\Application;

?>

<?php if (stripos(Application::$url_id, 'representante') === 0): ?>

    <li><a href="<?= URL ?>representante/index"><span class="glyphicon glyphicon-bullhorn"></span> Inicio</a></li>
    <li><a href="<?= URL ?>representante/programacion"><span class="glyphicon glyphicon-calendar"></span> Programación</a></li>
    <li><a href="<?= URL ?>representante/planchas"><span class="glyphicon glyphicon-list-alt"></span> Planchas</a></li>
    <li><a href="<?= URL ?>representante/reportes"><span class="glyphicon glyphicon-open-file"></span> Reportes</a></li>
<?php endif; ?>