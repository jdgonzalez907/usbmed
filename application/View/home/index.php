<h1 class="text-primary">¡Bienvenido!</h1>
<div class="row">
    <div class="col-sm-6">
        <p class="text-justify">
            La <i><strong>Unidad de Tecnología</strong></i> en un constante trabajo por mejorar sus servicios con la 
            comunidad bonaventuriana, <strong>ha decidido migrar algunas aplicaciones a la web</strong>, de modo que 
            todos podamos acceder a ellas <i><strong>desde cualquier parte</strong></i>.
        </p>
        <div id="carousel-usbmed" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-usbmed" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-usbmed" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?= URL ?>img/carousel/campus1.jpg" class="img-responsive center-block" alt="Campus">
                    <div class="carousel-caption">

                    </div>
                </div>
                <div class="item">
                    <img src="<?= URL ?>img/carousel/san_benito1.jpg" class="img-responsive center-block" alt="San Benito">
                    <div class="carousel-caption">

                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-usbmed" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-usbmed" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-sm-6">
        <p class="lead">Sus aplicativos:</p>
        <p>A continuación se listarán los aplicativos a los que tiene acceso:</p>
        <div class="list-group">
            <?php
            $menuPpal = Mini\Model\Usuario::getMenuPrincipal();

            foreach ($menuPpal as $item) {
                echo '<a href="' . URL . $item['URL'] . '" class="list-group-item"><span class="glyphicon glyphicon-' . $item['ICONO'] . '"></span> ' . $item['NOMBRE'] . '</a>';
            }
            ?>
        </div>
    </div>
</div>