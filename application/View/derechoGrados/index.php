<h1 class="text-primary">Formulario para derecho de grados</h1>

<p>Por favor diligenciar los siguientes campos.</p>

<form class="form-horizontal" method="post" enctype="multipart/form-data" id="frmDerechoGrados">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Información personal</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="sltTIPO" class="col-sm-4 control-label">Tipo de identificación</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="sltTIPO" name="sltTIPO" data-validation="required">
                                <option value="">Seleccione</option>
                                <option value="CC">Cédula de ciudadanía</option>
                                <option value="CE">Cédula de extranjería</option>
                                <option value="TI">Tarjeta de identidad</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtID" class="col-sm-4 control-label">Identificación</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="txtID" name="txtID" data-validation="required, number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtNOMBRE" class="col-sm-4 control-label">Nombre(s)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="txtNOMBRE" name="txtNOMBRE" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtAPELLIDO" class="col-sm-4 control-label">Apellido(s)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="txtAPELLIDO" name="txtAPELLIDO" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtCORREO" class="col-sm-4 control-label">Correo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtCORREO" name="txtCORREO" data-validation="required, email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtTELEFONO" class="col-sm-4 control-label">Teléfono ó Celular</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="txtTELEFONO" name="txtTELEFONO" data-validation="required, number">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Información académica</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="txtCODIGO" class="col-sm-4 control-label">Código (ASIS)</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="txtCODIGO" name="txtCODIGO" data-validation="required, number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Programa</label>
                                <div class="col-sm-8">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="rdbGRADO" id="rdbPREGRADO" value="PRE" data-validation="required">
                                            Pregrado
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="rdbGRADO" id="rdbPOSGRADO" value="POS" data-validation="required">
                                            Posgrado
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-5">
                                    <select class="form-control" id="sltPROGRAMA" name="sltPROGRAMA" data-validation="required">
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="flPRUEBA" class="col-sm-4 control-label">Prueba saber</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="flPRUEBA" name="flPRUEBA" data-validation="required, mime, size" data-validation-allowing="jpg, png" data-validation-max-size="5M">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="flFOTO" class="col-sm-4 control-label">Foto fondo azul</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="flFOTO" name="flFOTO" data-validation="required, mime, size" data-validation-allowing="jpg, png" data-validation-max-size="5M">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="flDOCUMENTO" class="col-sm-4 control-label">Documento al 150%</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="flDOCUMENTO" name="flDOCUMENTO" data-validation="required, mime, size" data-validation-allowing="jpg, png" data-validation-max-size="5M">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary center-block" id="btnEnviar" name="btnEnviar">Enviar</button>
</form>

<?php
self::registerJs("
    $.validate({
        language : myLanguage,
        form: '#frmDerechoGrados',
        modules : 'file'
    });
    
    $('#rdbPREGRADO').on('click', function(event){
        ajaxConsultarPrograma($(this).val());
    });
    
    $('#rdbPOSGRADO').on('click', function(event){
        ajaxConsultarPrograma($(this).val());
    });
    
    function ajaxConsultarPrograma(txtGRADO){
        $.post(
            '" . URL . "derechoGrados/ajaxConsultarPrograma',
            {
                txtGRADO : txtGRADO
            },
            function(data) {
                var html = '<option value>Seleccione</option>';
                var data = JSON.parse(data);
                
                for (var i = 0; i < data.length; i++) {
                    html += '<option value=\"'+data[i].ID_ESTUDIO+'\">'+data[i].DESCRIPCION+'</option>';
                }
                
                $('#sltPROGRAMA').html(html);
            }
        )
    }
 ");
?>