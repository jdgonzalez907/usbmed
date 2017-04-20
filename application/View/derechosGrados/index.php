<h1 class="text-primary text-center">Documentos solicitados para derecho de grados</h1><br>

<form method="post" enctype="multipart/form-data" class="form-horizontal" id="frmDatos">
    <!--Panel de Información personal del usuario -->
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Información Personal</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="sltTipoID" class="col-sm-4 control-label">Tipo de identificación</label>
                        <div class="col-sm-5">
                            <select name="sltTipoID" id="sltTipoID" class="form-control" data-validation="required">
                                <option value="">Seleccione</option>
                                <option value="CC">Cédula de ciudadanía</option>
                                <option value="CE">Cédula de extranjería</option>
                                <option value="TI">Tarjeta de identidad</option>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtID" class="col-sm-4 control-label">Identificación</label>
                        <div class="col-sm-5">
                            <input type="text" name="txtID" class="form-control" id="txtID" placeholder="Identificación" data-validation="required, number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtNombre" class="col-sm-4 control-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" name="txtNombre" class="form-control" id="txtNombre" placeholder="Nombre" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtApellido" class="col-sm-4 control-label">Apellido</label>
                        <div class="col-sm-8">
                            <input type="text" name="txtApellido" class="form-control" id="txtApellido" placeholder="Apellido" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtCorreo" class="col-sm-4 control-label">Correo</label>
                        <div class="col-sm-8">
                            <input type="text" name="txtCorreo" class="form-control" id="txtCorreo" placeholder="Correo" data-validation="required, email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtTelefono" class="col-sm-4 control-label">Teléfono / Celular</label>
                        <div class="col-sm-5">
                            <input type="text" name="txtTelefono" class="form-control" id="txtTelefono" placeholder="Teléfono / Celular" data-validation="required, number">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Panel de Información académica del usuario -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Información Académica</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="txtCodigo" class="col-sm-4 control-label">N. Código o ID</label>
                                <div class="col-sm-5">
                                    <input type="text" name="txtCodigo" class="form-control" id="txtCodigo" placeholder="Identificación" data-validation="required, number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">¿Usted recibe grado de?</label>
                                <div class="radio">
                                    <label form="rdbPregrado">
                                        <input type="radio" name="rdbGrado" id="rdbPregrado" value="PRE" data-validation="required" onclick="consultarPrograma($(this).val())">
                                        <strong>Pregrado</strong>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="rdbGrado" id="rdbPosgrado" value="POS" data-validation="required" onclick="consultarPrograma($(this).val())">
                                        <strong>Posgrado</strong>
                                        
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sltPrograma" class="col-sm-4 control-label"></label>
                                <div class="col-sm-5">
                                    <select name="sltPrograma" id="sltPrograma" class="form-control" data-validation="required">
                                        <option value="">Seleccione</option>                            
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Por favor cargar los siguientes documentos</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="achFoto" class="col-sm-4 control-label">Foto</label>
                                <div class="col-sm-8">
                                    <input type="file" name="achFoto" class="form-control" id="achFoto" data-validation="required, mime"  data-validation-allowing="jpg, png">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="achID" class="col-sm-4 control-label">Documento de Identificación (150%)</label>
                                <div class="col-sm-8">
                                    <input type="file" name="achID" class="form-control" id="achID" data-validation="required, mime"  data-validation-allowing="jpg, png">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="achPruebas" class="col-sm-4 control-label">Resultado pruebas Saber-Pro</label>
                                <div class="col-sm-8">
                                    <input type="file" name="achPruebas" class="form-control" id="achPruebas" data-validation="required, mime"  data-validation-allowing="jpg, png">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-primary center-block" name="btnEnviar">Enviar &nbsp;&nbsp;
    <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>
    </button>
    

</form>

<?php

self::registerJs(" 
     
     $.validate({
     language:myLanguage,
     form:'#frmDatos',
     modules : 'file'
     })
     
     function consultarPrograma(rdbTipo){
        $.post(
            '".URL."derechosGrados/consultarPorgrama',
            {
                Tipo:rdbTipo
            },
            function(data){
                var html = '<option value=\"\">Seleccione</option>';
                var data = JSON.parse(data);
                
                for (var i = 0; i < data.length; i++) {
                    html += '<option value=\"'+data[i].ID_ESTUDIO+'\">'+data[i].DESCRIPCION+'</option>';
                }
                
                $('#sltPrograma').html(html);
            }
        )
   }
     
 ");

?>