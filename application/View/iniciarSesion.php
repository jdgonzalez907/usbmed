<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login">
            <form method="post" id="frmIniciarSesion">
                <legend class="text-center text-primary">Iniciar sesión</legend>
                <img class="img-thumbnail img-responsive center-block" src="<?= URL ?>img/logo_usb.png"/>
                <br>
                <?php if (!is_null($alerta)): ?>
                    <?= \Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
                <?php endif; ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="Usuario_CEDULA" name="Usuario[CEDULA]" placeholder="Ingrese su identificación" data-validation="required" value="<?= $model->getCedula() ?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="Usuario_CLAVE" name="Usuario[CLAVE]" placeholder="Ingrese su clave" data-validation="required">
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Entrar</button>
                <a href="<?= URL ?>usuario/recordarClave<?= (isset($controlador) ? '/'.$controlador : '').(isset($accion) ? '/'.$accion : '') ?>" class="btn btn-default pull-right"><span class="glyphicon glyphicon-question-sign"></span> ¿Olvidó su clave?</a>
                <p class="text-justify">
                    <br>
                    <strong>Nota:</strong>
                    <br>
                    Este sistema utiliza la misma clave asginada para el inicio de sesión en los siguientes aplicativos:
                    <i>
                        Tesorería, Contratos, Sare, Sic, Centro de idiomas, Espacios físicos, Evaluación del desempeño, etc.
                    </i>
                </p>
            </form>
        </div>
    </div>
</div>

<?php

self::registerJs("
    $.validate({
        language: myLanguage,
        form: '#frmIniciarSesion'
    });
")

?>