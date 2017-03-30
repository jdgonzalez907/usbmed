<h1 class="text-primary">Programación</h1>

<p>Por favor llenar el formulario con los respectivos campos.</p>

<form class="form-horizontal" method="post" id="frmProgramacion">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="text-center text-primary">Inscripciones</h3>
            <div class="form-group">
                <label class="control-label col-md-5" for="txtFechaInicioInscripcion">Fecha inicio</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="Programacion_FECHA_INICIO_INSCRIPCION" name="Programacion[FECHA_INICIO_INSCRIPCION]" placeholder="aaaa/mm/dd hh:mm:ss" data-validation="custom" data-validation-regexp="(\d{4}/\d{2}/\d{2} \d{2}:\d{2}:\d{2})" data-validation-help="El formato es: aaaa/mm/dd hh:mm:ss" value="<?= $model->getFECHA_INICIO_INSCRIPCION() ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-5" for="txtFechaFinInscripcion">Fecha fin</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="Programacion_FECHA_FIN_INSCRIPCION" name="Programacion[FECHA_FIN_INSCRIPCION]"  placeholder="aaaa/mm/dd hh:mm:ss" data-validation="custom" data-validation-regexp="(\d{4}/\d{2}/\d{2} \d{2}:\d{2}:\d{2})" data-validation-help="El formato es: aaaa/mm/dd hh:mm:ss" value="<?= $model->getFECHA_FIN_INSCRIPCION() ?>">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h3 class="text-center text-primary">Votaciones</h3>
            <div class="form-group">
                <label class="control-label col-md-5" for="txtFechaInicioVotacion">Fecha inicio</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="Programacion_FECHA_INICIO_VOTACION" name="Programacion[FECHA_INICIO_VOTACION]"  placeholder="aaaa/mm/dd hh:mm:ss" data-validation="custom" data-validation-regexp="(\d{4}/\d{2}/\d{2} \d{2}:\d{2}:\d{2})" data-validation-help="El formato es: aaaa/mm/dd hh:mm:ss" value="<?= $model->getFECHA_INICIO_VOTACION() ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-5" for="txtFechaFinVotacion">Fecha fin</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="Programacion_FECHA_FIN_VOTACION" name="Programacion[FECHA_FIN_VOTACION]"  placeholder="aaaa/mm/dd hh:mm:ss" data-validation="custom" data-validation-regexp="(\d{4}/\d{2}/\d{2} \d{2}:\d{2}:\d{2})" data-validation-help="El formato es: aaaa/mm/dd hh:mm:ss" value="<?= $model->getFECHA_FIN_VOTACION() ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
        </div>
    </div>
</form>

<?php 
self::registerJs("
    
    $.validate({
        language: myLanguage,
        form: '#frmProgramacion'
    });
") 
?>