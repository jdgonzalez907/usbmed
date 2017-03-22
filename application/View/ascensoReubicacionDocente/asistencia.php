<h1>Calificar asistencia</h1>

<p>
    Para calificar la asistencia, seleccione el consecutivo que tiene asignado (solo aplica a cursos 
    <i>803 - Ascenso y reubicación salarial de docentes</i>).
</p>

<form method="post" id="frmConsultarConsecutivo">
    <div class="row" id="consultar">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
                <label class="control-label" for="FechasCurso_CONSECUTIVO">Consecutivo</label>
                <select class="form-control" id="FechasCurso_CONSECUTIVO" name="FechasCurso[CONSECUTIVO]" data-validation="required">
                    <option value="">Seleccione por favor...</option>
                    <?php foreach ($consecutivosAsociados as $consecutivo): ?>
                    <option value="<?= $consecutivo->CONSECUTIVO ?>"><?= $consecutivo->CONSECUTIVO ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="form-control btn btn-primary">Consultar</button>
            </div>
        </div>
    </div>
</form>

<div id="resultConsulta" class="hidden">
    <hr>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="table-responsive">
                <table id="fechas" class="table table-striped table-bordered table-condensed table-hover" width="100%" cellspacing="0">
                    <caption class="text-justify">A continuación se listan las fechas que usted ha creado y las opciones que tiene sobre ellas.</caption>
                    <thead>
                        <tr>
                            <th>Fechas de asistencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h3>Tabla de asistencia</h3>

    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="asistencia" class="table table-striped table-bordered table-condensed table-hover" width="100%" cellspacing="0">
                    <caption class="text-justify">A continuación se listan las fechas que usted ha creado y las opciones que tiene sobre ellas.</caption>
                    <thead>
                        <tr>
                            <th width="50%">Persona</th>
                            <th width="15%">Asistió</th>
                            <th width="30%">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>    

<?php 

self::registerJs("
    
    $.validate({
        language: myLanguage,
        form: '#frmConsultarConsecutivo'
    });

    $(document).ready(function() {
    
        $('#fechas').DataTable({
            paging: false,
            searching: false,
            language: myLanguageTable.language,
            info: false
        });
        
        $('#asistencia').DataTable({
            paging: false,
            searching: false,
            language: myLanguageTable.language,
            info: false
        });
        

    } );
")

?>