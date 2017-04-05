<div class="row bienvenida">
    <div class="col-sm-6 col-sm-offset-3 text-center">
        <h1>¡Bienvenido!</h1>
        <p>
            La <i><strong>Unidad de Tecnología</strong></i> en un constante trabajo por mejorar sus servicios con la 
            comunidad bonaventuriana, <strong>ha decidido migrar algunas aplicaciones a la web</strong>, de modo que 
            todos podamos acceder a ellas <i><strong>desde cualquier parte</strong></i>.
        </p>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="well well-bienvenida">
            <h4 class="text-center">Universidad San Buenaventura de Medellín <small>Calidad humana y profesional</small></h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
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

            
        </div>
    </div>
    <div class="col-sm-4">
        <legend>Sus aplicativos:</legend>
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