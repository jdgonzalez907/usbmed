<?php  

$persona = $buzon->getPersonas();
$tipoMensaje = $buzon->getTipoMensajes();
$seccional = $buzon->getSeccionales();
$contactos = $buzon->getConfiguracionDependencia();

?>

<form method="post" id="frm-buzon">

    <h2 class="page-header text-primary text-center">
        Buzón Vosavoz 
        <small>
            Consultas, quejas, reclamos, sugerencias y felicitaciones
        </small>
    </h2>

    <div class="well well-sm">
        <p class="lead text-center">
            ¡Importante!
        </p>
        <p class="text-justify">
            Es primordial que el correo esté digitado correctamente para responder a todas sus inquietudes de 
            forma directa y personalizada. Para ingresar los datos, no olvide presionar el botón <b>Enviar</b>.
        </p>
        <p class="text-justify text-danger">
            En caso de no haber recibido respuesta y/o tener sugerencias para mejorar el Buzón Vosavoz, 
            por favor enviar el mensaje al <i>Administrador del Buzón Vosavoz</i>.
        </p>
    </div>

    <p>Los campos con <span class="text-danger">*</span> son requeridos.</p>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="NombreCompleto">Nombre completo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="NombreCompleto" name="NombreCompleto" placeholder="Nombre completo" value="<?= $buzon->getNOMBRECOMPLETO() ?>" data-validation="required">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="Correo">Email donde desea recibir respuesta <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="Correo" name="Correo" placeholder="Email donde desea recibir respuesta" value="<?= $buzon->getCORREO() ?>" data-validation="required, email">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="Direccion">Dirección <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="Direccion" name="Direccion" placeholder="Dirección" value="<?= $buzon->getDIRECCION() ?>" data-validation="required">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="Telefono">Teléfono <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="Teléfono" value="<?= $buzon->getTELEFONO() ?>" data-validation="required, number">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="TipoDeUsuario">¿Usted es? <span class="text-danger">*</span></label>
                <select class="form-control" id="TipoDeUsuario" name="TipoDeUsuario" data-validation="required">
                    <option value="">Seleccione una opción...</option>
                    <?php foreach($persona as $clave => $p ): ?>
                    <option value="<?= $clave ?>"><?= $p ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="Pertenece">¿Usted pertenece a? <span class="text-danger">*</span></label>
                <select type="text" class="form-control" id="Pertenece" name="Pertenece" data-validation="required">
                    <option value="">Seleccione por favor...</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="TipoMensaje">¿Su petición es? <span class="text-danger">*</span></label>
                <select class="form-control" id="TipoMensaje" name="TipoMensaje" data-validation="required">
                    <option value="">Seleccione una opción...</option>
                    <?php foreach($tipoMensaje as $clave => $m ): ?>
                    <?php $checked = ($m == $buzon->getTIPOMENSAJE()) ? 'selected="selected"' : ""; ?>
                    <option <?= $checked ?> value="<?= $clave ?>"><?= $m ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="Contacto">¿Desea contactar con? <span class="text-danger">*</span></label>
                <select type="text" class="form-control" id="Contacto" name="Contacto" data-validation="required">
                    <option value="">Seleccione por favor...</option>
                    <?php foreach($contactos as $clave => $con ): ?>
                    <?php $checked = ($con["nombre"] == $buzon->getCONTACTO()["nombre"]) ? 'selected="selected"' : ""; ?>
                    <option <?= $checked ?> value="<?= $clave ?>"><?= $con["nombre"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="Seccional">Seccional del contacto <span class="text-danger">*</span></label>
                <select class="form-control" id="Seccional" name="Seccional" data-validation="required">
                    <option value="">Seleccione una opción...</option>
                    <?php foreach($seccional as $clave => $s ): ?>
                    <?php $checked = ($s == $buzon->getSECCIONAL()) ? 'selected="selected"' : ""; ?>
                    <option <?= $checked ?> value="<?= $clave ?>"><?= $s ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="Comentario">Describe la petición <span class="text-danger">*</span></label>
        <textarea class="form-control" rows="5" id="Comentario" name="Comentario" placeholder="Por favor brinda toda la información necesaria para que podamos ayudarte..." data-validation="required"><?= nl2br($buzon->getCOMENTARIO()) ?></textarea>
    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
                <label for="Captcha">Por favor ingrese el código que aparece en la siguiente imagen <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-5">
                        <img class="img-circle img-responsive center-block" id="ImagenCaptcha" name="ImagenCaptcha" src="<?= URL ?>buzon/generarCaptcha">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control col-sm-7 text-center" id="Captcha" name="Captcha" data-validation="required">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br />
    <input type="submit" value="Enviar" id="Enviar" name="Enviar" class="btn btn-primary btn-lg center-block"/>
</form>

<?php 

self::registerJs("

    $.validate({
        language: myLanguage,
        form: '#frm-buzon'
    });

    $(document).ready(function(event){
        $('#TipoDeUsuario').change(function(event){
            $.ajax({
                'url' : '".URL."buzon/ajaxDetalle/' + $(this).val(),
                'type' : 'get',
                'dataType': 'json',
                success : function(data)
                {
                    var selectHtml = '<option value=\"\">Seleccione por favor...</option>';

                    for(i = 0; i < data.length; i++)
                    {
                        selectHtml += '<option value=\"'+data[i]+'\">'+data[i]+'</option>';
                    }

                    $('#Pertenece').html(selectHtml);
                }
            })
        })
    })

");

?>