<div class="row">
    <div class="col-sm-9">
        <h1 class="text-primary">Votar</h1>
        <p>
            A continuación se lista una tabla con los votos disponibles de acuerdo a su relación con la universidad. 
            De acuerdo a esto se le habilitarán las votaciones.
        </p>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title">
                    Votos disponibles
                </h3>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge"><small><?= $votosValidos['DOC'] ?></small></span>
                    Docente
                </li>
                <li class="list-group-item">
                    <span class="badge"><small><?= $votosValidos['EST'] ?></small></span>
                    Estudiante
                </li>
                <li class="list-group-item">
                    <span class="badge"><small><?= $votosValidos['EGR'] ?></small></span>
                    Egresado(a)
                </li>
            </ul>
        </div>
    </div>
</div>
<hr
<?php if ($valido): ?>
        <h3>Para votar siga los siguientes pasos:</h3>
    <div class="row" id="consultar-grupo-interes">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
                <label class="control-label" for="selectGrupoInteres">Grupo de interés</label>
                <select class="form-control" id="selectGrupoInteres" name="selectGrupoInteres">
                    <option value="">Seleccione por favor...</option>
                    <?php
                    foreach ($grupoInteres as $llave => $grupo) {
                        echo '<option value="' . $llave . '">' . $grupo . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="consultar-facultad">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <label class="control-label" for="selectFacultad">Facultad</label>
                <select class="form-control" id="selectFacultad" name="selectFacultad">
                    <option value="">Seleccione por favor...</option>
                </select>
            </div>
        </div>
    </div>
    <div class="hidden" id="cargando">
        <img src="<?= URL ?>img/cargando.gif" class="img-responsive center-block" width="125px" height="125px">
    </div>
    <div class="row" id="consultar-candidatos">
        <div class="col-sm-10 col-sm-offset-1">
            <label class="control-label" for="selectFacultad">Candidatos</label>
            <div id="listar-candidatos" class="well">
                Por favor elija el grupo y la facultad.
            </div>
        </div>
    </div>
    <?php
    self::registerJs("
        var facultad = " . json_encode($facultad) . "

        $('#selectGrupoInteres').change(function () {
            var sel1 = $(this).val();
            $('#selectFacultad').html('<option value=\"\">Seleccione por favor</option>');
            $.each(facultad[sel1], function (a, b) {
                $('#selectFacultad').append('<option value=\"' + a + '\">' + b + '</option>');
            });
            
            $('#listar-candidatos').removeClass();
            $('#listar-candidatos').addClass('well');
            $('#listar-candidatos').html('Por favor elija el grupo y la facultad.');
        });
        
        $('#selectFacultad').change(function () {
            if (!$(this).val()) {
                $('#listar-candidatos').removeClass();
                $('#listar-candidatos').addClass('well');
                $('#listar-candidatos').html('Por favor elija el grupo y la facultad.');
            } else {
                $('#cargando').removeClass('hidden');
                $.post(
                    '".URL."representante/consultarCandidatos',
                    {
                        grupoInteres : $('#selectGrupoInteres').val(),
                        facultad : $('#selectFacultad').val()
                    },
                    function (data) {
                        try {
                            var data = JSON.parse(data);

                            if (data.length > 0 ) {
                                var html = '<div class=\"col-sm-12\"><div class=\"alert alert-success\">Selecciona la foto para votar.</div></div>';
                                
                                $('#listar-candidatos').removeClass();
                                $('#listar-candidatos').addClass('row');
                                $('#listar-candidatos').html('');
                                
                                for (var i = 0; i < data.length; i++) {
                                    var urlFOTO = data[i].FOTO;
                                    urlFOTO = urlFOTO.substring(1);
                                    
                                    html += '<div class=\"col-sm-4\">';
                                    html += '<button type=\"button\" class=\"thumbnail center-block\" onclick=\"votar('+data[i].POSTULACION_ID+')\">';
                                    html += '<p class=\"text-center\">'+data[i].POSTULACION_ID+'</p>';
                                    html += '<img class=\"img-responsive center-block previewFoto\" src=\"".URL."'+ urlFOTO +'\" alt=\"'+ data[i].NOMBRES +'\">';
                                    html += '<p class=\"text-center\">'+data[i].NOMBRES+'</p>';
                                    html += '</button>';
                                    html += '</div>';
                                }
                                
                                html += '<div class=\"col-sm-4 text-center\">';
                                html += '<button type=\"button center-block\" class=\"thumbnail\" onclick=\"votar(0)\">';
                                html += '<p></p>';
                                html += '<p class=\"previewFoto\"></p>';
                                html += '<p class=\"text-center\">VOTO EN BLANCO</p>';
                                html += '</button>';
                                html += '</div>';
                                
                                $('#listar-candidatos').html(html);
                                
                                $('html,body').animate({scrollTop: $('#consultar-candidatos').offset().top},'slow');
                            }else{
                                $('#listar-candidatos').removeClass();
                                $('#listar-candidatos').addClass('alert alert-info');
                                $('#listar-candidatos').html('Para los parámetros seleccionados, no se encuentran planchas disponibles en el momento.<br>Por favor inténtelo más tarde.');
                            }
                        }catch(e){
                            $('#modal_usbmed_title').text('Mensaje del sistema.');
                            $('#modal_usbmed_body').html(data);
                            $('#modal_usbmed').modal('show');
                        }
                        $('#cargando').addClass('hidden');
                    }
                )
            }
        });
        
        function votar(id) {
            if(confirm('¿Está seguro que desea votar por esta plancha? Recuerde que no podrá deshacer el voto.')){
                $.post(
                    '".URL."representante/generarVoto',
                    {
                        grupoInteres : $('#selectGrupoInteres').val(),
                        plancha : id
                    },
                    function(data) {
                        try {
                            var data = JSON.parse(data);
                            if (data===1){
                                setTimeout(
                                    function(){
                                        $('#modal_usbmed_title').text('Mensaje del sistema.');
                                        $('#modal_usbmed_body').html('<div class=\"alert alert-success\">Su voto fue registrado correctamente.</div>');
                                        $('#modal_usbmed').modal('show');
                                        location.reload();
                                    }, 
                                    500
                                );
                            }
                        }catch(e){
                            $('#modal_usbmed_title').text('Mensaje del sistema.');
                            $('#modal_usbmed_body').html(data);
                            $('#modal_usbmed').modal('show');
                        }
                    }
                );
            }
        }
    ");
    ?>
<?php endif; ?>