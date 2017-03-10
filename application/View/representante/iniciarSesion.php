<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login">
            <form method="post">
                <legend class="text-center text-primary">Iniciar sesión</legend>
                <img class="img-thumbnail img-responsive center-block" src="<?= URL ?>img/logo_usb.png"/>
                <br>
                <?php if (!is_null($error)): ?>
                    <div class="alert alert-<?= $error['tipo'] ?>" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?= $error['mensaje'] ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" placeholder="Ingrese su identificación" data-validation="server" data-validation-url="<?= URL ?>representante/validarIdentificacion">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Ingrese su clave" data-validation="required">
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
                <a href="<?= URL ?>usuario/recordarClave" class="btn btn-link pull-right">¿Olvidó su clave?</a>
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