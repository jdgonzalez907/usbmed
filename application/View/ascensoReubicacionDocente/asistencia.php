<h1 class="text-primary">Calificar asistencia</h1>

<p>
    Para calificar la asistencia, seleccione el consecutivo que tiene asignado (solo aplica a cursos 
    <i>803 y 804 - Ascenso y reubicación salarial de docentes</i>).
</p>

<div class="row" id="consultar">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="form-group">
            <label class="control-label" for="FechasCurso_CONSECUTIVO">Consecutivo</label>
            <select class="form-control" id="FechasCurso_CONSECUTIVO" name="FechasCurso[CONSECUTIVO]">
                <option value="">Seleccione por favor...</option>
                <?php foreach ($consecutivosAsociados as $consecutivo): ?>
                    <option value="<?= $consecutivo->CONSECUTIVO ?>"><?= $consecutivo->CONSECUTIVO . ' - ' . $consecutivo->MOTIVO ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div id="resultConsultaFechas" class="hidden">
    <hr>
    <h2 id="tituloConsecutivo" class="text-center"></h2>
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

    <h3 class="text-center">Crear fecha</h3>

    <div class="row text-center">
        <div class="col-sm-offset-2 col-sm-8">
            <form method="post" action="<?= URL ?>ascensoReubicacionDocente/crearFecha" class="form-inline" id="frmCrearFecha">
                <div class="form-group">
                    <label for="fechaAsistencia">Fecha asistencia</label>
                    <input type="text" class="form-control" id="fechaAsistencia" name="fechaAsistencia" placeholder="dd/mm/aaaa" data-validation="date" data-validation-format="dd/mm/yyyy">
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Crear</button>
            </form>
        </div>
    </div>
</div>    

<div id="resultAsistencia" class="hidden">
    <hr>

    <h3>Tabla de asistencia</h3>

    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="<?= URL ?>ascensoReubicacionDocente/guardarFecha" id="frmGuardarAsistencia">
                <div class="table-responsive">
                    <table id="asistencia" class="table table-striped table-bordered table-condensed table-hover" width="100%" cellspacing="0">
                        <caption class="text-justify">A continuación se listan las fechas que usted ha creado y las opciones que tiene sobre ellas.</caption>
                        <p class="text-right"><input type="checkbox" id="select-all"> Seleccionar todos</p>
                        <thead>
                            <tr>
                                <th width="50%">Persona</th>
                                <th width="30%">Observaciones</th>
                                <th width="15%">Asistió</th>
                            </tr>
                        </thead>
                        <tbody id="asistenciaBody">

                        </tbody>
                    </table>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" data-tipo="guardar">Guardar</button>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-lg" data-tipo="oficializar">Oficializar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
self::registerJs("
    
    $('#select-all').click(function(event) {
        var chequear = this.checked;
        $(':checkbox').each(function() {
            this.checked = chequear;
        });
    });

    $.validate({
        language: myLanguage,
        form: '#frmCrearFecha'
    });
    
    $('#FechasCurso_CONSECUTIVO').on('change', function (event){
        $('#resultAsistencia').addClass('hidden');
        if ( $(this).val() === '' ) {
            $('#resultConsultaFechas').addClass('hidden');
            $('#resultAsistencia').addClass('hidden');
        }else{
            $.post(
                '" . URL . "ascensoReubicacionDocente/consultarFechas',
                {
                    consecutivo : $(this).val()
                },
                function(data){
                    try {
                        var fechas = JSON.parse(data);

                        $('#resultConsultaFechas').removeClass('hidden');
                        $('#fechaAsistencia').val('');
                        $('#tituloConsecutivo').text($('#FechasCurso_CONSECUTIVO option:selected').text());
                    }catch(e){
                        $('#modal_usbmed_title').text('Mensaje del sistema.');
                        $('#modal_usbmed_body').html(data);
                        $('#modal_usbmed').modal('show');
                    }
                }
            )
        }
    })
    
    $('#frmCrearFecha').submit(function(event){
        event.preventDefault();
        
        $.post(
            $(this).attr('action'),
            {
                fechaAsistencia : $('#fechaAsistencia').val(),
                consecutivo : $('#FechasCurso_CONSECUTIVO').val()
            },
            function(data){
                try {
                    var data = JSON.parse(data);
                    
                    if (data.error){
                        $('#resultAsistencia').addClass('hidden');
                        $('#modal_usbmed_title').text('Mensaje del sistema.');
                        $('#modal_usbmed_body').html(data.resultado);
                        $('#modal_usbmed').modal('show');
                    } else {
                        var tableAsistencia = $('#asistencia').DataTable();
                        tableAsistencia.destroy();
                        
                        $('#resultAsistencia').removeClass('hidden');
                        var tableHtml = '';
                        for (var i = 0; i < data.resultado.length; i++) {
                            tableHtml += '<tr>';
                            tableHtml += '<td><input type=\"hidden\" id=\"id_'+data.resultado[i].persona+'\" name=\"persona['+i+'][persona]\" value=\"'+data.resultado[i].persona+'\">'+data.resultado[i].persona+'</td>';
                            tableHtml += '<td><input type=\"text\" id=\"obs_'+data.resultado[i].persona+'\" name=\"persona['+i+'][observaciones]\" value=\"'+data.resultado[i].observaciones+'\" class=\"form-control\" style=\"width:100%\"></td>';
                            tableHtml += '<td><input type=\"checkbox\" id=\"asi_'+data.resultado[i].persona+'\" name=\"persona['+i+'][asistio]\"></td>';
                            tableHtml += '</tr>';
                        }
                        
                        $('#asistenciaBody').html(tableHtml);

                        $('#asistencia').DataTable({
                            paging: false,
                            language: myLanguageTable.language,
                            info: false
                        });
                    }
                }catch(e){
                    $('#modal_usbmed_title').text('Mensaje del sistema.');
                    $('#modal_usbmed_body').html(data);
                    $('#modal_usbmed').modal('show');
                }
            }
        )
    })
    
    $('#frmGuardarAsistencia').submit(function(event){
        event.preventDefault();
        var data = $(this).serialize();
        $.post(
            $(this).attr('action'),
            data,
            function(data){
            }
        )
    })

")
?>
<script>

</script>