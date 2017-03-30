<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login">
            <form method="post" id="frmRecordarClave">
                <legend class="text-center text-primary">Recordar clave</legend>
                <img class="img-thumbnail img-responsive center-block" src="<?= URL ?>img/logo_usb.png"/>
                <br>
                <?php if (!is_null($alerta)): ?>
                    <?= \Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="Usuario_CEDULA">Identificación</label>
                    <input type="text" class="form-control" id="Usuario_CEDULA" name="Usuario[CEDULA]" placeholder="Ingrese su identificación" data-validation="required" value="<?= $model->getCedula() ?>">
                </div>
                <div class="form-group">
                    <label for="Usuario_CLAVE">Fecha de nacimiento</label>
                    <input type="text" class="form-control" id="Usuario_CLAVE" name="Usuario[CLAVE]" placeholder="aaaa/mm/dd" data-validation="custom" data-validation-regexp="(\d{4}/\d{2}/\d{2})" data-validation-help="El formato es: aaaa/mm/dd">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Recordar</button>
                    <a class="btn btn-default pull-right" href="<?= URL.(isset($controlador) ? $controlador : '').(isset($accion) ? '/'.$accion : '') ?>"><span class="glyphicon glyphicon-circle-arrow-left"></span> Iniciar sesión</a>
                </div>
                <p class="text-justify">
                    <br>
                    <strong>Nota (administrativos):</strong>
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
        form: '#frmRecordarClave'
    });
")
?>