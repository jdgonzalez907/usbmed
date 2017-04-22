<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= self::$titulo ?></title>

        <!-- Bootstrap -->
        <link href="<?= URL ?>css/usbmed-tema.min.css" rel="stylesheet">
        <link href="<?= URL ?>css/sitio.css" rel="stylesheet">

        <link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">

        <!-- Icono -->
        <link href="<?= URL ?>favicon.ico" rel="shortcut icon">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse" style="height: 150px; border-bottom: 5px solid orange">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="<?= URL ?>img/logo_usb_sin_fondo.png" class="img-responsive" style="max-height: 130px"></a>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
        
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="body">
                        <?php if (isset($alerta)): ?>
                            <?php if (!is_null($alerta)): ?>
                                <?= \Mini\Libs\Alerta::crear($alerta['tipo'], $alerta['mensaje']) ?>
                            <?php endif; ?>
                        <?php endif; ?>
                