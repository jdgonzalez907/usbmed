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
                <li data-target="#carousel-usbmed" data-slide-to="2"></li>
                <li data-target="#carousel-usbmed" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?= URL ?>img/carousel/campus1.jpg" class="img-responsive img-thumbnail img-carousel center-block" alt="Campus">
                    <div class="carousel-caption">

                    </div>
                </div>
                <div class="item">
                    <img src="<?= URL ?>img/carousel/san_benito1.jpg" class="img-responsive img-thumbnail img-carousel center-block" alt="San Benito">
                    <div class="carousel-caption">

                    </div>
                </div>
                <div class="item">
                    <img src="<?= URL ?>img/carousel/armenia1.jpg" class="img-responsive img-thumbnail img-carousel center-block" alt="Armenia">
                    <div class="carousel-caption">

                    </div>
                </div>
                <div class="item">
                    <img src="<?= URL ?>img/carousel/ibague1.jpg" class="img-responsive img-thumbnail img-carousel center-block" alt="Ibague">
                    <div class="carousel-caption">

                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="col-sm-4">
        <legend class="text-primary">Sus aplicativos:</legend>
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
<div class="row presentacion">
    <div class="col-sm-4">
        <h3 class="text-center">Seguridad</h3>
        <img class="img-responsive center-block img-presentacion" src="<?= URL ?>img/computer.png" alt="">        
        <p class="text-justify">
            La protección de datos es algo sumamente importante, por lo cuál se optó por tecnologías que brinden la seguridad necesaria para mantener la inforamción segura.
        </p>
    </div>
    <div class="col-sm-4">
        <h3 class="text-center">Adaptación</h3>
        <img class="img-responsive center-block img-presentacion" src="<?= URL ?>img/smartphone.png" alt="">        
        <p class="text-justify">
            Estamos en un mundo donde los smartphone's se usan cada vez más... teniendo en cuenta esto, se diseñó un sistema que se acomode a la pantalla de cualquier dispositivo.
        </p>
    </div>
    <div class="col-sm-4">
        <h3 class="text-center">Sencillez</h3>
        <img class="img-responsive center-block img-presentacion" src="<?= URL ?>img/browser.png" alt="">        
        <p class="text-justify">
            A nosotros también nos gustan las cosas que nos faciliten la vida, por ello el diseño se basa en un sistema práctico, seguro y amigable.
        </p>
    </div>
</div>