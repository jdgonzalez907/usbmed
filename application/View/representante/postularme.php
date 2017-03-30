<h1 class="text-primary">
    Postulación 
    <small class="text-muted">
        Elección de representantes <?= date('Y') ?>
    </small>
</h1>
<p class="text-justify">
    Para crear una postulación a las elecciones de representantes (<?= date('Y') ?>), es necesario diligenciar el siguiente formulario,
    debe tener en cuenta, que la información se lista de acuerdo a las bases de datos PEOPLE SOFT y ICEBERG.
</p>
<?php if (is_null($alerta)): ?>
    <form method="post" enctype="multipart/form-data" id="frmPostulacion">
        <br/>
        <table class="table ">
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
                            <p class="text-info">Es importante que la foto sea fondo blanco y sea tipo carnet (4:3).</p>
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
                        <div class="form-group text-justify small well-sm hidden" id="paneles">
                            <p class="lead text-primary text-center">Requisitos</p>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="panel panel-default hidden" id="panel-estudiante">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Estudiante</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>Tener matrícula vigente en programa de pregrado.</li>
                                                <li>Haber cursado como mínimo el 40% de los Créditos del programa académico.</li>
                                                <li>Tener promedio académico no inferior a cuatro punto cero (4.0).</li>
                                                <li>No tener vínculo laboral con la institución o familiar con alguno de los directivos, empleados o docentes.</li>
                                                <li>No haber sido objeto de sanción disciplinaria ni académica ni disciplinariamente de acuerdo con el reglamento estudiantil, ni tampoco haber presentado problemas de desorden contemplados en la Constitución Nacional.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel panel-default hidden" id="panel-egresado">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Egresado</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>Ser egresado graduado de algún programa de pregrado o posgrado que se ofrecen en la Universidad de San Buenaventura.</li>
                                                <li>No haber sido objeto de sanción disciplinaria ni académica ni disciplinariamente de acuerdo con el reglamento estudiantil.</li>
                                                <li>No tener vínculo laboral con la institución o familiar con alguno de los directivos, empleados, docentes o estudiantes.</li>
                                                <li>No tener deudas pendientes con la universidad.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel panel-default hidden" id="panel-docente">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Docente</h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>Estar vinculado como docente de tiempo completo o medio tiempo.</li>
                                                <li>No haber sido objeto de sanción disciplinaria de acuerdo con el estatuto docente.</li>
                                                <li>No tener vínculo familiar con alguno de los directivos, empleados o estudiantes.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="checkbox" data-validation="required" id="Postulacion_ACEPTO" name="Postulacion_ACEPTO"/> <label class="control-label" for="Postulacion_ACEPTO">Certifico que cumplo con los requisitos.</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Postularme</button>
        </div>
    </form>
<?php endif; ?>

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

    var facultad = " . json_encode($facultad) . "

    $('#Postulacion_GRUPO_INTERES').change(function () {
        var sel1 = $(this).val();
        $('#Postulacion_FACULTAD').html('<option value=\"\">Seleccione por favor</option>');
        $.each(facultad[sel1], function (a, b) {
            $('#Postulacion_FACULTAD').append('<option value=\"' + a + '\">' + b + '</option>');
        });
    });
    
    $('#Postulacion_GRUPO_INTERES').on('change', function(event){
        var tipo = $(this).val();
        switch (tipo) {
            case 'EGR':
                $('#Postulacion_ACEPTO').prop('checked', false);
                $('#paneles').removeClass('hidden');
                $('#panel-egresado').removeClass('hidden');
                $('#panel-estudiante').addClass('hidden');
                $('#panel-docente').addClass('hidden');
                break;
            case 'EST':
                $('#Postulacion_ACEPTO').prop('checked', false);
                $('#paneles').removeClass('hidden');
                $('#panel-egresado').addClass('hidden');
                $('#panel-estudiante').removeClass('hidden');
                $('#panel-docente').addClass('hidden');
                break;
            case 'DOC':
                $('#Postulacion_ACEPTO').prop('checked', false);
                $('#paneles').removeClass('hidden');
                $('#panel-egresado').addClass('hidden');
                $('#panel-estudiante').addClass('hidden');
                $('#panel-docente').removeClass('hidden');
                break;
            default:
                $('#Postulacion_ACEPTO').prop('checked', false);
                $('#paneles').addClass('hidden');
                $('#panel-egresado').addClass('hidden');
                $('#panel-estudiante').addClass('hidden');
                $('#panel-docente').addClass('hidden');
                break;
        }
    })
")
?>