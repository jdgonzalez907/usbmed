<div class="menu-sidebar hidden-print">
    <p class="text-center lead">Permisos</p>
    <ul class="nav nav-pills nav-stacked">
        <?php
        $menuPermisos = Mini\Model\Usuario::getMenuPermisos();
        
        foreach ($menuPermisos as $menu)
        {
            echo '<li><a href="'.URL.$menu['URL'].'"><span class="glyphicon glyphicon-'.$menu['ICONO'].'"></span> '.$menu['NOMBRE'].'</a></<li>';
        }
        ?>
    </ul>
</div>