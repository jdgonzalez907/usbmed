<?php if (isset($alerta)): ?>
    <?php if (!is_null($alerta)): ?>
        <?= \Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
        <?php exit(); ?>
    <?php endif; ?>
<?php endif; ?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <form method="post" action="<?= URL ?>representante/crearPlancha/<?= $id ?>" id="frmCrearPlancha" enctype="multipart/form-data">
            <p>A continuación se detalla la plancha:</p>
            <div class="table-responsive">
                <table class="table table-condensed table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-center <?= ($model->getESTADO() === 'I' ? 'danger text-danger' : 'success text-success') ?>">
                                <p class="lead"><strong><?= $model->getNOMBRES() ?></strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><strong>Identificación</strong></label>
                                <p><?= $model->getIDENTIFICACION() ?> (<?= $model->getTIPO_IDENTIFICACION() ?>)</p>
                            </td>
                            <td rowspan="5" class="text-center">
                                <div class="form-group" style="margin-top: 35px">
                                    <label for="Postulacion_FOTO" class="control-label"><strong>Foto</strong></label>
                                    <img id="previewFoto" src="" class="img-responsive img-thumbnail center-block"/>
                                    <input type="file" data-validation="required" id="Postulacion_FOTO" name="Postulacion[FOTO]" accept="image/gif, image/jpeg, image/png" class="center-block"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="Postulacion_GRUPO_INTERES" class="control-label"><strong>Grupo de interés</strong></label>
                                    <select class="form-control" data-validation="required" id="Postulacion_GRUPO_INTERES" name="Postulacion[GRUPO_INTERES]">
                                        <option value="">Seleccione por favor...</option>
                                        <?php
                                        foreach ($grupoInteres as $llave => $grupo) {
                                            echo '<option value="' . $llave . '">' . $grupo . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>                                
                                <div class="form-group">
                                    <label for="Postulacion_FACULTAD" class="control-label"><strong>Facultad</strong></label>
                                    <select class="form-control" data-validation="required" id="Postulacion_FACULTAD" name="Postulacion[FACULTAD]">
                                        <option value="">Seleccione por favor...</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="Postulacion_CORREO" class="control-label"><strong>Correo</strong></label>
                                    <input type="text" class="form-control" data-validation="required, email" id="Postulacion_CORREO" name="Postulacion[CORREO]" value="<?= $model->getCORREO() ?>"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="Postulacion_TELEFONO" class="control-label"><strong>Teléfono</strong></label>
                                    <input type="text" class="form-control" data-validation="required, number" id="Postulacion_TELEFONO" name="Postulacion[TELEFONO]" value="<?= $model->getTELEFONO() ?>"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="Postulacion_ESTADO" class="control-label"><strong>Estado</strong></label>
                                        <select class="form-control" id="Postulacion_ESTADO" name="Postulacion[ESTADO]" data-validation="required">
                                            <option value="">Seleccione por favor...</option>
                                            <?php
                                            $estados = Mini\Model\ListaGlobal::getEstados();

                                            foreach ($estados as $llave => $estado) {
                                                echo '<option value="' . $llave . '" ' . ( $llave == $model->getESTADO() ? 'selected' : '') . '>' . $estado . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label for="Postulacion_OBSERVACIONES" class="control-label"><strong>Observaciones</strong> (<span id="pres-max-length">500</span> cracteres restantes)</label>
                                    <textarea class="form-control" id="Postulacion_OBSERVACIONES" name="Postulacion[OBSERVACIONES]" data-validation="required" data-validation-depends-on="Postulacion[ESTADO]" data-validation-depends-on-value="I"><?= $model->getOBSERVACIONES() ?></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default" id="btnCancelar"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Crear</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('#modal_usbmed_title').html('Crear plancha con Identificación <span class="badge">#<?= $id ?></span>')

    $.validate({
        language: myLanguage,
        form: '#frmCrearPlancha',
        modules: 'logic'
    });

    $('#Postulacion_OBSERVACIONES').restrictLength($('#pres-max-length'));

    $('#frmCrearPlancha').submit(function (event) {
        event.preventDefault();
        var formData = new FormData($(this).get(0));
        
        $.ajax({
            url:$(this).attr('action'),
            data:formData,
            type:'post',
            contentType: false,
            processData: false,
            success:function(data){
                $('#modal_usbmed_body').html(data);
            }
        });
    })

    $('#btnCancelar').on('click', function (event) {
        $('#modal_usbmed').modal('toggle');
    })

    var facultad = <?=json_encode($facultad)?>;

    $('#Postulacion_GRUPO_INTERES').change(function () {
        var sel1 = $(this).val();
        $('#Postulacion_FACULTAD').html('<option value=\"\">Seleccione por favor</option>');
        $.each(facultad[sel1], function (a, b) {
            $('#Postulacion_FACULTAD').append('<option value=\"' + a + '\">' + b + '</option>');
        });
    });

    $('#Postulacion_FOTO').change(function () {
        readURL(this);
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previewFoto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>