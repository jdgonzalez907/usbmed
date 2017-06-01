<h1 class="text-primary">Calificar asistencia</h1>

<p>
    Para calificar la asistencia, seleccione el consecutivo que tiene asignado (solo aplica a cursos 
    <i>803 y 804 - Ascenso y reubicación salarial de docentes</i>).
</p>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <form action="<?= URL ?>ascensoReubicacionDocente/consultarFechas" method="post" id="consultarFechas">
            <div class="form-group">
                <label for="consecutivo" class="control-label">Consecutivos asociados:</label>
                <select class="form-control" id="consecutivo" name="consecutivo"></select>
            </div>
        </form>
    </div>
</div>

<div class="row hidden" id="tabla-fechas-consecutivo">
    <div class="col-sm-12">
        <hr>
        <h2>Fechas para el consecutivo: <b><span id="consecutivo-descripcion"></span></b></h2>
        <form class="form-inline" action="<?= URL ?>ascensoReubicacionDocente/crearFecha" method="post" id="crearFecha">
            <input type="hidden" name="consecutivo_seleccionado" id="consecutivo_seleccionado" value="">
            <div class="form-group">
                <label for="fecha" class="control-label">Fecha</label>
                <input type="text" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy">
            </div>
            <button type="submit" class="btn btn-default" id="crear-fecha">Crear fecha</button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered">
                <caption>Listado de fechas para el consecutivo seleccionado.</caption>
                <thead>
                    <tr>
                        <th style="width: 85%">Fecha</th>
                        <th style="width: 5%">Modificar</th>
                        <th style="width: 5%">Eliminar</th>
                        <th style="width: 5%">Oficializar</th>
                    </tr>
                </thead>
                <tbody id="tablaBody-fechas-consecutivo">
                    <tr><td colspan="4">Sin resultados...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-asistencia" tabindex="-1" role="dialog" aria-labelledby="modal-asistenciaLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-asistenciaLabel">Mensaje del sistema</h4>
            </div>
            <div class="modal-body" id="modal-asistenciaBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary hidden" id="modal-asistencia-boton-guardar">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
self::registerJs("
    $(document).ready(function(){

        consultarConsecutivos();
        
        $('#modal-asistencia').on('hidden.bs.modal', function (e) {
            $('#modal-asistenciaBody').html('');
            $('#modal-asistencia-boton-guardar').unbind('click');
            $('#modal-asistencia-boton-guardar').addClass('hidden');
            $('#modal-asistencia-boton-guardar').text('');
            $('#modal-asistencia-boton-guardar').attr('disabled', false);
        })
        
        $('#consecutivo').on('change', function(event){
            $('#consultarFechas').submit();
        })
        
        $('#consultarFechas').on('submit', function(event){
            event.preventDefault();
            consultarFechas($(this));
        });
        
        $('#crearFecha').on('submit', function(event){
            event.preventDefault();
            crearFecha($(this));
        });
        
        $(document).on('submit', '.form-consultar-asistencia', function(event){
            event.preventDefault();
            consultarAsistencia($(this));
        })
        
        $(document).on('submit', '#modificarAsistencia', function(event){
            event.preventDefault();
            modificarAsistencia($(this));
        })
        
        $(document).on('submit', '.form-eliminar-asistencia', function(event){
            event.preventDefault();
            if (confirm('¿Está seguro que desea eliminar las asistencias de los estudiantes con la fecha seleccionada?')) {
                eliminarAsistencia($(this));
            }
        })
        
        $(document).on('submit', '.form-oficializar-asistencia', function(event){
            event.preventDefault();
            if (confirm('¿Está seguro que desea oficializar las asistencias de los estudiantes con la fecha seleccionada?, recuerde que no podrá realizar modificaciones después.')) {
                oficializarAsistencia($(this));
            }
        })
    })
    
    function consultarConsecutivos(){
        $.ajax({
            url: '" . URL . "ascensoReubicacionDocente/consultarConsecutivos',
            type: 'post',
            dataType: 'json',
            success: function(response){
                var alerta = response.alerta;
                var data = response.data;
                
                if (alerta == null){
                    var selectHtml = '<option value=\"\">Seleccione por favor...</option>';
                    
                    for (var i = 0; i < data.length; i++) {
                        selectHtml += '<option value=\"' + data[i].CONSECUTIVO + '\">' + data[i].CONSECUTIVO + ' - ' + data[i].MOTIVO +'</option>';
                    }
                    
                    $('#consecutivo').html(selectHtml);
                }else{
                    crearAlerta(alerta);
                }
            },
            error: function(response){
                alert('Error');
            }
        })
    }
    
    function consultarFechas(form){
        if ($('#consecutivo').val()){
            var url = form.attr('action');
            var data = form.serialize();

            $.ajax({
                url: url,
                data: data,
                type: 'post',
                dataType: 'json',
                success: function(response){
                    var alerta = response.alerta;
                    var data = response.data;

                    if (alerta == null){
                        var tablaHtml = null;

                        for (var i = 0; i < data.length; i++) {
                            tablaHtml += '<tr>';
                            tablaHtml += '<td>' + data[i].FECHA_ASISTENCIA + ((data[i].FECHA_OFICIALIZA) ? ' - <small class=\"text-danger\"><i>Se oficializó el '+data[i].FECHA_OFICIALIZA+'</i></small>' : '') + '</td>';
                            tablaHtml += '<td class=\"text-center\">';
                            if (!data[i].FECHA_OFICIALIZA) {
                                tablaHtml += '<form action=\"".URL."ascensoReubicacionDocente/consultarAsistencia\" method=\"post\" class=\"form-consultar-asistencia\">';
                                tablaHtml += '<input type=\"hidden\" value=\"'+data[i].FECHA_ASISTENCIA+'\" name=\"fecha_consultar_asistencia\">';
                                tablaHtml += '<input type=\"hidden\" value=\"'+data[i].CONSECUTIVO+'\" name=\"consecutivo_consultar_asistencia\">';
                                tablaHtml += '<button class=\"btn btn-warning btn-sm\" type=\"submit\"><span class=\"glyphicon glyphicon-refresh\"></span></button>';
                                tablaHtml += '</form>';  
                            }else{
                                tablaHtml += '<button class=\"btn btn-warning btn-sm\" type=\"button\" disabled><span class=\"glyphicon glyphicon-refresh\"></span></button>';
                            }                          
                            tablaHtml += '</td>';
                            tablaHtml += '<td class=\"text-center\">';
                            if (!data[i].FECHA_OFICIALIZA) {
                                tablaHtml += '<form action=\"".URL."ascensoReubicacionDocente/eliminarAsistencia\" method=\"post\" class=\"form-eliminar-asistencia\">';
                                tablaHtml += '<input type=\"hidden\" value=\"'+data[i].FECHA_ASISTENCIA+'\" name=\"fecha_eliminar_asistencia\">';
                                tablaHtml += '<input type=\"hidden\" value=\"'+data[i].CONSECUTIVO+'\" name=\"consecutivo_eliminar_asistencia\">';
                                tablaHtml += '<button class=\"btn btn-danger btn-sm\" type=\"submit\"><span class=\"glyphicon glyphicon-remove\"></span></button>';
                                tablaHtml += '</form>';
                            }else{
                                tablaHtml += '<button class=\"btn btn-danger btn-sm\" type=\"button\" disabled><span class=\"glyphicon glyphicon-remove\"></span></button>';
                            }  
                            tablaHtml += '</td>';
                            tablaHtml += '<td class=\"text-center\">';
                            if (!data[i].FECHA_OFICIALIZA) {
                                tablaHtml += '<form action=\"".URL."ascensoReubicacionDocente/oficializarAsistencia\" method=\"post\" class=\"form-oficializar-asistencia\">';
                                tablaHtml += '<input type=\"hidden\" value=\"'+data[i].FECHA_ASISTENCIA+'\" name=\"fecha_oficializar_asistencia\">';
                                tablaHtml += '<input type=\"hidden\" value=\"'+data[i].CONSECUTIVO+'\" name=\"consecutivo_oficializar_asistencia\">';
                                tablaHtml += '<button class=\"btn btn-success btn-sm\" type=\"submit\"><span class=\"glyphicon glyphicon-ok\"></span></button>';
                                tablaHtml += '</form>';
                            }else{
                                tablaHtml += '<button class=\"btn btn-success btn-sm\" type=\"button\" disabled><span class=\"glyphicon glyphicon-ok\"></span></button>';
                            }
                            tablaHtml += '</td>';
                            tablaHtml += '</tr>';
                        }

                        $('#tablaBody-fechas-consecutivo').html(tablaHtml);
                    }else{
                        crearAlerta(alerta);
                        $('#tablaBody-fechas-consecutivo').html('');
                    }

                    $('#consecutivo_seleccionado').val($('#consecutivo').val());
                    $('#consecutivo-descripcion').text($('#consecutivo option:selected').text());
                    $('#tabla-fechas-consecutivo').removeClass('hidden');
                },
                error: function(response){
                    alert('Error');
                }
            });
        }else{
            $('#consecutivo_seleccionado').val('');
            $('#consecutivo-descripcion').text('');
            $('#tabla-fechas-consecutivo').addClass('hidden');
            $('#tablaBody-fechas-consecutivo').html('');
        }
    }
    
    function crearFecha(form){
        var url = form.attr('action');
        var data = form.serialize();
        $('#crear-fecha').attr('disabled', true);
        $('#crear-fecha').text('Creando...');
        $('#fecha').attr('disabled', true);
        
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(response){
                var alerta = response.alerta;
                var data = response.data;
                
                if (alerta.tipo == 'success'){
                    $('#consultarFechas').submit();
                    $('#fecha').val('');
                }
                
                crearAlerta(alerta);
                
                $('#crear-fecha').attr('disabled', false);
                $('#crear-fecha').text('Crear fecha');
                $('#fecha').attr('disabled', false);
                $('#consecutivo-descripcion').text($('#consecutivo option:selected').text());
                $('#tabla-fechas-consecutivo').removeClass('hidden');
            },
            error: function(response){
                alert('Error');
            }
        });
    }
    
    function consultarAsistencia(form){
        var url = form.attr('action');
        var data = form.serialize();
        var consecutivo = form[0][1]['value'];
        
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(response){
                var alerta = response.alerta;
                var data = response.data;
                
                if (alerta == null) {
                    var tablaHtml = '<form action=\"".URL."ascensoReubicacionDocente/modificarAsistencia\" method=\"post\" id=\"modificarAsistencia\">';
                    tablaHtml += '<input type=\"hidden\" name=\"consecutivo\" value=\"' + consecutivo + '\">';
                    tablaHtml += '<div class=\"table-responsive\">';
                    tablaHtml += '<table class=\"table table-bordered\">';
                    tablaHtml += '<thead>';
                    tablaHtml += '<tr>';
                    tablaHtml += '<th>Identificación</th>';
                    tablaHtml += '<th>Nombre Completo</th>';
                    tablaHtml += '<th>Asistió</th>';
                    tablaHtml += '</tr>';
                    tablaHtml += '</thead>';
                    tablaHtml += '<tbody>';
                    
                    for(i = 0; i < data.length; i++){
                        tablaHtml += '<tr>';
                        tablaHtml += '<td>' + data[i].IDENTIFICACION + '</td>';
                        tablaHtml += '<td>' + data[i].NOMBRES + ' ' + data[i].APELLIDOS + '</td>';
                        var asistio_estudiante = (data[i].ASISTIO == 'S') ? 'checked' : '';
                        tablaHtml += '<td><input ' + asistio_estudiante + ' type=\"checkbox\" name=\"asistio[]\" value=\"'+data[i].SECUENCIA+'\"></td>';
                        tablaHtml += '</tr>';
                    }
                    
                    tablaHtml += '</tbody>';
                    tablaHtml += '</table>';
                    tablaHtml += '</div>';
                    tablaHtml += '</form>';
                    
                    $('#modal-asistencia-boton-guardar').removeClass('hidden');
                    $('#modal-asistencia-boton-guardar').text('Guardar datos');
                    $('#modal-asistencia-boton-guardar').on('click', function(event){
                        $('#modificarAsistencia').submit();
                    })
                    $('#modal-asistenciaBody').html(tablaHtml);
                    $('#modal-asistencia').modal('show');
                }else{
                    crearAlerta(alerta);
                }
            },
            error: function(response){
                alert('Error');
            }
        });
    }
    
    function modificarAsistencia(form){
        var url = form.attr('action');
        var data = form.serialize();
        $('#modal-asistencia-boton-guardar').text('Guardando...');
        $('#modal-asistencia-boton-guardar').attr('disabled', true);

        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(response){
                var alerta = response.alerta;
                
                crearAlerta(alerta);
                $('#modal-asistencia-boton-guardar').addClass('hidden');
                
            },
            error: function(response){
                alert('Error');
            }
        });
    }
    
    function eliminarAsistencia(form){
        var url = form.attr('action');
        var data = form.serialize();
        
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(response){
                var alerta = response.alerta;
                
                if (alerta.tipo == 'success'){
                    $('#consultarFechas').submit();
                }
                
                crearAlerta(alerta);
                
            },
            error: function(response){
                alert('Error');
            }
        });
    }
    
    function oficializarAsistencia(form){
        var url = form.attr('action');
        var data = form.serialize();
        
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(response){
                var alerta = response.alerta;
                
                if (alerta.tipo == 'success'){
                    $('#consultarFechas').submit();
                }
                
                crearAlerta(alerta);
                
            },
            error: function(response){
                alert('Error');
            }
        });
    }
    
    function crearAlerta(alerta){
        var alertHtml = '<div class=\"alert alert-' + alerta.tipo + ' alert-dismissible\" role=\"alert\">';
        alertHtml += '<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>'
        alertHtml += alerta.mensaje + '</div>';
        
        $('#modal-asistenciaBody').html(alertHtml);
        $('#modal-asistencia').modal('show');
    }
");
?>
<script>

</script>