<?php if (isset($alerta)): ?>
    <?php if (!is_null($alerta)): ?>
        <?= \Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
            <script>
                setTimeout(function(){location.reload()}, 500);
            </script>
        <?php exit(); ?>
    <?php endif; ?>
<?php endif; ?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <form method="post" action="<?= URL ?>representante/actualizarPlancha/<?= $id ?>" id="frmActualizarPlancha">
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
                                    <img id="previewFoto" src="<?= URL. str_replace('\\', '/', $model->getFOTO()) ?>" class="img-responsive img-thumbnail center-block"/>
                                    <p><strong>Fecha postulación:</strong> <i><?= date('d/m/Y H:i:s', strtotime($model->getFECHA_POSTULACION())) ?></i></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="Postulacion_GRUPO_INTERES" class="control-label"><strong>Grupo de interés</strong></label>
                                    <p><?= Mini\Model\ListaGlobal::getGrupoInteres($model->getGRUPO_INTERES()) ?></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>                                
                                <div class="form-group">
                                    <label for="Postulacion_FACULTAD" class="control-label"><strong>Facultad</strong></label>
                                    <p><?= Mini\Model\ListaGlobal::getFacultades($model->getFACULTAD()) ?></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="Postulacion_CORREO" class="control-label"><strong>Correo</strong></label>
                                    <p><?= $model->getCORREO() ?></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="Postulacion_TELEFONO" class="control-label"><strong>Teléfono</strong></label>
                                    <p><?= $model->getTELEFONO() ?></p>
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

                                            foreach ($estados as $llave => $estado)
                                            {
                                                echo '<option value="'.$llave.'" '.( $llave == $model->getESTADO() ? 'selected' : '').'>'.$estado.'</option>';
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
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('#modal_usbmed_title').html('Actualizar plancha <span class="badge">#<?= $id ?></span>')
    
    $.validate({
        language: myLanguage,
        form: '#frmActualizarPlancha',
        modules : 'logic'
    });
    
    $('#Postulacion_OBSERVACIONES').restrictLength($('#pres-max-length'));
    
    $('#frmActualizarPlancha').submit(function(event){
        event.preventDefault();
        
        $.post(
            $(this).attr('action'),
            $(this).serialize(),
            function(data){
                $('#modal_usbmed_body').html(data);
            }
        )
    })
    
    $('#btnCancelar').on('click', function(event){
        $('#modal_usbmed').modal('toggle');
    })
</script>