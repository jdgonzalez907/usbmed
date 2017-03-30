<h1 class="text-primary">Carga votantes</h1>
<p>Por favor adjuntar archivo a subir con la identificación de la persona a la cuál se le creará el(los) voto(s).</p>
<?php if($valido): ?>
<form method="post" enctype="multipart/form-data" id="frmCargarVotantes">
    <div class="form-group">
        <label for="Voto_VOTANTE">Archivo</label>
        <input type="file" id="Voto_VOTANTE" name="Voto[VOTANTE]" data-validation="required extension" data-validation-allowing="csv">
    </div>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span> Cargar</button>
</form>
<?php endif; ?>
<?php

self::registerJs("
    $.validate({
        language: myLanguage,
        form: '#frmCargarVotantes',
        modules: 'file'
    });
");

?>