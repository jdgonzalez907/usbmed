<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login">
            <form method="post" id="frmValidarCedula" action="<?= URL ?>usuario/validarCedula">
                <legend class="text-center text-primary">Recordar clave</legend>
                <img class="img-thumbnail img-responsive center-block" src="<?= URL ?>img/logo_usb.png"/>
                <br>
                <?php if (!is_null($alerta)): ?>
                    <?= \Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="Usuario_CEDULA">Identificación</label>
                    <input type="text" class="form-control" id="txt-cedula" placeholder="Ingrese su identificación" data-validation="required" value="<?= $model->getCedula() ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="validar-cedula"><span class="glyphicon glyphicon-ok-sign"></span> Validar</button>
                </div>
            </form>
            <form method="post" id="frmRecordarClave" class="hidden">
                <input id="Usuario_CEDULA" name="Usuario[CEDULA]" type="hidden" data-validation="required">
                <div class="form-group">
                    <label class="control-label">Correos asociados:</label>
                    <div id="lista-correos">

                    </div>
                    <p class="help-block">Seleccione uno para que le envíemos la clave.</p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Recordar</button>
                </div>
            </form>
            <a class="btn btn-default" href="<?= URL . (isset($controlador) ? $controlador : '') . (isset($accion) ? '/' . $accion : '') ?>"><span class="glyphicon glyphicon-circle-arrow-left"></span> Iniciar sesión</a>
            <p class="text-justify">
                <br>
                <strong>Nota (administrativos):</strong>
                <br>
                Este sistema utiliza la misma clave asginada para el inicio de sesión en los siguientes aplicativos:
                <i>
                    Tesorería, Contratos, Sare, Sic, Centro de idiomas, Espacios físicos, Evaluación del desempeño, etc.
                </i>
            </p>
        </div>
    </div>
</div>

<?php
self::registerJs("
    $.validate({
        language: myLanguage,
        form: '#frmValidarCedula'
    });
    
    $.validate({
        language: myLanguage,
        form: '#frmRecordarClave'
    });
    
    $('#frmValidarCedula').submit(function (event){
        event.preventDefault();
        
        $('#frmRecordarClave').addClass('hidden');
        $('#lista-correos').html('');
        
        $.post(
            $(this).attr('action'),
            {
                cedula: $('#txt-cedula').val()
            },
            function(data){
                data = JSON.parse(data);
                if(data){
                    var tipo = data.tipo;
                    var mensaje = data.mensaje;

                    if (tipo === 'success'){
                        var radioHtml = '';

                        for (var i = 0; i < mensaje.length; i++) {
                            radioHtml += '<label class=\"control-label\"><input type=\"radio\" name=\"Usuario[CLAVE]\" value=\"'+mensaje[i]+'\" data-validation=\"required\"> '+mensaje[i]+'</label>';
                        }
                        
                        $('#Usuario_CEDULA').val($('#txt-cedula').val());
                        $('#frmRecordarClave').removeClass('hidden');
                        $('#lista-correos').html(radioHtml);
                        
                    }else{
                        $('#Usuario_CEDULA').val('');
                        $('#frmRecordarClave').removeClass('hidden');
                        $('#lista-correos').html('<div class=\"alert alert-danger\">'+mensaje+'</div>');
                    }
                }else{
                    $('#Usuario_CEDULA').val('');
                    $('#frmRecordarClave').removeClass('hidden');
                    $('#lista-correos').html('<div class=\"alert alert-danger\">'+mensaje+'</div>');
                }
            }
        )
    })
")
?>