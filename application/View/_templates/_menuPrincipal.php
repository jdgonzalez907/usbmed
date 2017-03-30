<nav class="navbar navbar-inverse hidden-print">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-top" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= URL ?>">Aplicaciones</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-top">
            <!--<form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>-->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= URL ?>"><span class="glyphicon glyphicon-globe"></span> Inicio</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-tasks"></span> Aplicativos <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $menuPpal = Mini\Model\Usuario::getMenuPrincipal();

                        foreach ($menuPpal as $item) {
                            echo '<li><a href="' . URL . $item['URL'] . '"><span class="glyphicon glyphicon-' . $item['ICONO'] . '"></span> ' . $item['NOMBRE'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <!--<li><a href="<?= URL ?>home/contacto"><span class="glyphicon glyphicon-envelope"></span> Contácto</a></li>-->
                <li><a href="<?= URL ?>usuario/cambiarClave"><span class="glyphicon glyphicon-lock"></span> Cambiar clave</a></li>
                <li><a href="<?= URL ?>usuario/cerrarSesion"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión(<?= \Mini\Core\Session::get('usuario')['usuario'] ?>)</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>