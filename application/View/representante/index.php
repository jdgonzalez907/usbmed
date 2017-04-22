<h1 class="text-primary">Elección de representantes</h1>

<div class="row">
    <div class="col-sm-7 text-justify">
        <p>
            Bienvenido, usted se encuentra en el aplicativo de <strong>elección de representantes</strong>, en el cuál podrá realizar 
            operaciones como la programación de fechas, creación de planchas, la actualización de planchas, postularse, votar, ver reportes, etc.
        </p>
        <hr>
        <p>
            <i><small>Al lado izquierdo de su pantalla, encuentra los permisos que tiene habilitados sobre este módulo.</small></i>
        </p>
    </div>
    <div class="col-sm-5">
        <p><img src="<?= URL ?>img/representante.jpg" class="img-responsive img-thumbnail"/></p>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Fecha de inicio</th>
            <th>Fecha de finalización</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Inscripción</td>
            <td><?= $programacion->getFECHA_INICIO_INSCRIPCION() ?></td>
            <td><?= $programacion->getFECHA_FIN_INSCRIPCION() ?></td>
        </tr>
        <tr>
            <td>Votación</td>
            <td><?= $programacion->getFECHA_INICIO_VOTACION() ?></td>
            <td><?= $programacion->getFECHA_FIN_VOTACION() ?></td>
        </tr>
    </tbody>
</table>