<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel de Administrador</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/bower_components/metisMenu/dist/metisMenu.min.css') ?>" rel="stylesheet">
    <link
        href=" <?= base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') ?>"
        rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href=" <?= base_url('assets/bower_components/datatables-responsive/css/dataTables.responsive.css') ?>"
        rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="<?= base_url('assets/dist/css/timeline.css') ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/dist/css/sb-admin-2.css') ?>" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?= base_url('assets/bower_components/morrisjs/morris.css') ?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet"
        type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- LIBRERIA HIGHCHARTS -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- Variable Pie Module -->
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
    <link rel="shortcut icon" href="<?= base_url("assets/static/images/favicon/favicon.png") ?>" type="image/x-icon">

</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">GESTAMOS</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?= base_url('admin')?>"><i class="fa fa-dashboard fa-fw"></i> Estadisticas</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building"></i>
                                Sedes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url('form_registrar_sede')?>"> Registrar Sede</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('sedes')?>"> Lista Sedes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cogs"></i> Estados<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url('estados')?>">Lista Estados</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user"></i> Tipos de Usuario<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url('tipos')?>"> Lista Tipos de Usuario</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user"></i> Medicos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url('medicos')?>"> Lista de Medicos</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('form_registrar_medico')?>"> Registrar Medico</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>