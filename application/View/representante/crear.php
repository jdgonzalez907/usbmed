<?php 

use Mini\Model\ListaGlobal;

?>

<h1 class="text-primary">Crear plancha</h1>

<p>
    Por favor consulte a la persona llenando el siguiente formulario:
</p>

<?php if ($valido): ?>
    <div class="row">
        <div class="col-sm-4">
            <form method="get" id="frmBuscarPersona">
                <div class="form-group">
                    <label class="control-label" for="Usuario_CEDULA">Identificación</label>
                    <input type="text" class="form-control" id="Usuario_CEDULA" name="Usuario[CEDULA]" data-validation="required, number" value="<?= $usuario->getCEDULA() ?>"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                </div>
            </form>
        </div>
<!--        <div class="col-sm-7 col-sm-offset-1">
            <div class="well">
                <p class="lead">Nota</p>
                <p class="text-justify">
                    Recuerde que se le dará prioridad a los docentes, después a los egresados y por último a los estudiantes, 
                    por lo cuál cuando una persona tenga varios roles se habilitará aquel que respete lo dicho anteriormente.
                    <br><br>
                    Los egresados deben realizar su postulación vía web.
                </p>
            </div>
        </div>-->
    </div>

    <div class="table-responsive">
        <table id="personas" class="table table-striped table-bordered table-condensed table-hover" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombres</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($personas as $key => $persona): ?>
                <tr>
                    <td><?= $persona->IDENTIFICACION.' ('.$persona->TIPO_IDENTIFICACION.')' ?></td>
                    <td><?= $persona->NOMBRES ?></td>
                    <td><button class="btn btn-link" type="button" data-toggle="modal" data-target="#modal_usbmed" data-tipomodal="modal-lg" data-url="<?= URL ?>representante/crearPlancha/<?= $persona->IDENTIFICACION ?>">Crear plancha</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>    
    </div>

    <?php

    self::registerJs("
        $.validate({
            language: myLanguage,
            form: '#frmBuscarPersona'
        });

        $(document).ready(function() {
            $('#personas').DataTable({
                paging: false,
                searching: false,
                language: myLanguageTable.language,
                info: false
            });
        } );

        $('#modal_usbmed').on('show.bs.modal', function (event) {
            var button      = $(event.relatedTarget);
            var url         = button.data('url');
            $('#modal_usbmed_tipo_modal').addClass(button.data('tipomodal'));

            $.get(
                url, 
                {},
                function(data){
                    $('#modal_usbmed_body').html(data);
                }
            )
        })
    ")

    ?>
<?php endif; ?>