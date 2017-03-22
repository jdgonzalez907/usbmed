<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="login">
            <form method="post" id="frmCambiarClave">
                <legend class="text-center text-primary">Cambiar clave</legend>
                <img class="img-thumbnail img-responsive center-block" src="<?= URL ?>img/logo_usb.png"/>
                <br>
                <?php if (!is_null($alerta)): ?>
                    <?= \Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="Usuario_CLAVE">Clave actual</label>
                    <input type="password" class="form-control" id="Usuario_CLAVE" name="Usuario[CLAVE]" placeholder="Ingrese su clave actual" data-validation="required">
                </div>
                <div class="form-group">
                    <label for="Usuario_CLAVE_NUEVA">Clave nueva</label>
                    <input type="password" class="form-control" id="Usuario_CLAVE_NUEVA_confirmation" name="Usuario[CLAVE_NUEVA]_confirmation" placeholder="Ingrese su clave nueva" data-validation="required">
                </div>
                <div class="form-group">
                    <label for="Usuario_CLAVE_REPITA">Repita clave nueva</label>
                    <input type="password" class="form-control" id="Usuario_CLAVE_NUEVA" name="Usuario[CLAVE_NUEVA]" placeholder="Repita clave nueva" data-validation="confirmation">
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Cambiar clave</button>
                <a class="btn btn-default pull-right" href="<?= URL ?>"><span class="glyphicon glyphicon-circle-arrow-left"></span> Inicio</a>
                <p class="text-justify">
                    <br>
                    <strong>Nota (administrativos):</strong>
                    <br>
                    Este sistema utiliza la misma clave asginada para el inicio de sesión en los siguientes aplicativos:
                    <i>
                        Tesorería, Contratos, Sare, Sic, Centro de idiomas, Espacios físicos, Evaluación del desempeño, etc.
                    </i>
                    <br>
                    <strong>Por lo tanto, al cambiar la contraseña aquí, automáticamente se cambia en los anteriores aplicativos.</strong>
                </p>
            </form>
        </div>
    </div>
</div>

<?php

self::registerJs("
    $.validate({
        language: myLanguage,
        modules : 'security',
        form: '#frmCambiarClave'
    });
")

?>