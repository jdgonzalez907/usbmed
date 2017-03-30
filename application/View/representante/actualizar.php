<?php

use Mini\Model\ListaGlobal;
?>
<h1 class="text-primary">Actualizar planchas</h1>

<p>A continuación podrá listar las planchas para activarlas y/o inactivarlas, dependiendo sea su caso.</p>

<?php if($valido): ?>
<div class="row">
    <div class="col-md-6">
        <form class="form-horizontal" method="get" id="frmBuscarPlancha">
            <div class="form-group">
                <label for="Postulacion_GRUPO_INTERES" class="col-sm-5 control-label">Grupo de interés</label>
                <div class="col-sm-7">
                    <select class="form-control" id="Postulacion_GRUPO_INTERES" name="Postulacion[GRUPO_INTERES]" data-validation="required">
                        <option value="">Seleccione por favor...</option>
                        <?php
                        $grupoInteres = ListaGlobal::getGrupoInteres();
                        unset($grupoInteres['ADM']);

                        foreach ($grupoInteres as $llave => $grupo) {
                            echo '<option value="' . $llave . '" ' . (($llave == $model->getGRUPO_INTERES()) ? 'selected' : '') . '>' . $grupo . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="Postulacion_FACULTAD" class="col-sm-5 control-label">Facultad</label>
                <div class="col-sm-7">
                    <select class="form-control" id="Postulacion_FACULTAD" name="Postulacion[FACULTAD]" data-validation="required">
                        <option value="">Seleccione por favor...</option>
                        <?php
                        $facultades = ListaGlobal::getFacultades();

                        foreach ($facultades as $llave => $facultad) {
                            echo '<option value="' . $llave . '" ' . (($llave == $model->getFACULTAD()) ? 'selected' : '') . '>' . $facultad . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-7">
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-5">
    </div>
</div>
<br/>
<div class="table-responsive">
    <table id="tblPlanchas" class="table table-striped table-bordered table-condensed table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Facultad</th>
                <th>Identificación</th>
                <th>Nombre</th>
                <th>Postulación</th>
                <th>Estado</th>
                <th>Actualización</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProviderPosutlacion as $plancha): ?>
                <tr>
                    <td><button class="btn btn-link" type="button" data-toggle="modal" data-target="#modal_usbmed" data-tipomodal="modal-lg" data-url="<?= URL ?>representante/actualizarPlancha/<?= $plancha->POSTULACION_ID ?>"><?= $plancha->POSTULACION_ID ?></button></td>
                    <td><?= ListaGlobal::getFacultades($plancha->FACULTAD) ?></td>
                    <td><?= $plancha->IDENTIFICACION . ' (' . $plancha->TIPO_IDENTIFICACION . ')' ?></td>
                    <td><?= $plancha->NOMBRES ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($plancha->FECHA_POSTULACION)) ?></td>
                    <td <?= ($plancha->ESTADO === 'I' ? 'class="danger text-danger"' : 'class="success text-success"') ?>><?= ListaGlobal::getEstados($plancha->ESTADO) ?></td>
                    <td><?= ($plancha->FECHA_ACTUALIZA && $plancha->USUARIO_ACTUALIZA) ? date('d/m/Y H:i:s', strtotime($plancha->FECHA_ACTUALIZA)) . '<br>(por ' . $plancha->USUARIO_ACTUALIZA . ')' : '<small class="text-muted"><i>Vacío</i></small>' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
self::registerJS("
    $.validate({
        language: myLanguage,
        form: '#frmBuscarPlancha'
    });

    $(document).ready(function() {
        $('#tblPlanchas').DataTable(myLanguageTable);
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
