<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="login">
            <legend class="text-center text-primary">
                <h1>
                    Postulación 
                    <small class="text-muted">
                        Elección de representantes <?= date('Y') ?>
                    </small>
                </h1>
            </legend>
            <p class="text-justify">
                Para crear una postulación a las elecciones de representantes (<?= date('Y') ?>), es necesario diligenciar el siguiente formulario,
                debe tener en cuenta, que la información se lista de acuerdo a las bases de datos PEOPLE SOFT y ICEBERG.
            </p>
            <p class="text-right">
                <a href="<?= URL ?>usuario/cerrarSesion/representante/postularme" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            </p>
            <?php if (!is_null($alerta)): ?>
                <?= Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
            <?php else: ?>
                <form method="post" enctype="multipart/form-data" id="frmPostulacion">
                    <br/>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center"><p><strong><?= strtoupper($model->getNOMBRES()) ?></strong></p></td>
                            </tr>
                            <tr>
                                <td><strong>Identificación</strong><br/><?= $model->getIDENTIFICACION() ?> (<?= $model->getTIPO_IDENTIFICACION() ?>)</td>
                                <td rowspan="5" class="text-center">
                                    <div class="form-group" style="margin-top: 70px">
                                        <label for="Postulacion_FOTO" class="control-label"><strong>Foto</strong></label>
                                        <img id="previewFoto" src="#" class="img-responsive img-thumbnail center-block"/>
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
                                        <label for="Postulacion_PROPUESTA" class="control-label"><strong>Propuesta</strong> (<span id="pres-max-length">500</span> cracteres restantes)</label>
                                        <textarea class="form-control" data-validation="required, length" data-validation-length="max500" rows="7" id="Postulacion_PROPUESTA" name="Postulacion[PROPUESTA]"><?= $model->getPROPUESTA() ?></textarea>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Enviar</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php 
self::registerJs("
    
    $.validate({
        language: myLanguage,
        form: '#frmPostulacion'
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

    $('#Postulacion_PROPUESTA').restrictLength($('#pres-max-length'));

    var facultad = ".json_encode($facultad)."

    $('#Postulacion_GRUPO_INTERES').change(function () {
        var sel1 = $(this).val();
        $('#Postulacion_FACULTAD').html('<option valuue=\"\">Seleccione por favor</option>');
        $.each(facultad[sel1], function (a, b) {
            $('#Postulacion_FACULTAD').append('<option value=\"' + a + '\">' + b + '</option>');
        });
    });
") 
?>