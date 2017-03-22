<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login">
            <form method="post" id="frmValidarInfo">
                <legend class="text-center text-primary">Validar información</legend>
                <img class="img-thumbnail img-responsive center-block" src="<?= URL ?>img/logo_usb.png"/>
                <br>
                <?php if (!is_null($alerta)): ?>
                    <?= \Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
                <?php endif; ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="Usuario_CEDULA" name="Usuario[CEDULA]" placeholder="Ingrese su identificación" data-validation="required" value="<?= $model->getCedula() ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="Usuario_CLAVE" name="Usuario[CLAVE]" placeholder="aaaa/mm/dd" data-validation="custom" data-validation-regexp="(\d{4}/\d{2}/\d{2})" data-validation-help="El formato es: aaaa/mm/dd">
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Validar</button>
            </form>
        </div>
    </div>
</div>

<?php

self::registerJs("
    $.validate({
        language: myLanguage,
        form: '#frmValidarInfo'
    });
")

?>