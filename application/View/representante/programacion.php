<h1>Programación</h1>

<?php if (!is_null($error)): ?>
    <div class="alert alert-<?= $error['tipo'] ?>" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $error['mensaje'] ?>
    </div>
<?php endif; ?>

<p>Por favor llenar el formulario con los respectivos campos.</p>

<form class="form-horizontal" method="post">
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <h3 class="text-center text-primary">Inscripciones</h3>
            <div class="form-group">
                <label class="control-label col-md-5" for="txtFechaInicioInscripcion">Fecha inicio</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="txtFechaInicioInscripcion" name="txtFechaInicioInscripcion" placeholder="aaaa/mm/dd hh:mm:ss" data-validation="custom" data-validation-regexp="(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})" data-validation-help="El formato es: aaaa/mm/dd hh:mm:ss" value="<?= (isset($programacion->FECHA_INICIO_INSCRIPCION) ? $programacion->FECHA_INICIO_INSCRIPCION : '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-5" for="txtFechaFinInscripcion">Fecha fin</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="txtFechaFinInscripcion" name="txtFechaFinInscripcion"  placeholder="aaaa/mm/dd hh:mm:ss" data-validation="custom" data-validation-regexp="(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})" data-validation-help="El formato es: aaaa/mm/dd hh:mm:ss" value="<?= (isset($programacion->FECHA_INICIO_INSCRIPCION) ? $programacion->FECHA_FIN_INSCRIPCION : '') ?>">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h3 class="text-center text-primary">Votaciones</h3>
            <div class="form-group">
                <label class="control-label col-md-5" for="txtFechaInicioVotacion">Fecha inicio</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="txtFechaInicioVotacion" name="txtFechaInicioVotacion"  placeholder="aaaa/mm/dd hh:mm:ss" data-validation="custom" data-validation-regexp="(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})" data-validation-help="El formato es: aaaa/mm/dd hh:mm:ss" value="<?= (isset($programacion->FECHA_INICIO_INSCRIPCION) ? $programacion->FECHA_INICIO_VOTACION : '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-5" for="txtFechaFinVotacion">Fecha fin</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="txtFechaFinVotacion" name="txtFechaFinVotacion"  placeholder="aaaa/mm/dd hh:mm:ss" data-validation="custom" data-validation-regexp="(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})" data-validation-help="El formato es: aaaa/mm/dd hh:mm:ss" value="<?= (isset($programacion->FECHA_INICIO_INSCRIPCION) ? $programacion->FECHA_FIN_VOTACION : '') ?>">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar</button>
        </div>
    </div>
</form>