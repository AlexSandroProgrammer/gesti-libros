<?= require_once('components/sidebar.php') ?>
<?php
// recibimos los props requeridos de la vista
$medicos = isset($medicos) ? (int)$medicos : 0;
$estados = isset($estados) ? (int)$estados : 0;
$sedes = isset($sedes) ? (int)$sedes : 0;
$tipos = isset($tipos) ? (int)$tipos : 0;

// Datos simulados desde PHP (pueden venir de una base de datos)
$datos_y = [
    ['name' => 'Medicos', 'y' => $medicos],
    ['name' => 'Estados', 'y' => $estados],
    ['name' => 'Sedes', 'y' => $sedes],
    ['name' => 'Tipos', 'y' => $tipos]
];

// Convertir datos a JSON para pasarlos a JavaScript
$datos_chart = json_encode($datos_y);
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $medicos ?></div>
                            <div>Medicos</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('medicos') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver medicos</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-building fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $sedes ?></div>
                            <div>Sedes</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('sedes') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver Sedes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cogs fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $estados ?></div>
                            <div>Estados</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('estados') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver Estados</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $tipos ?></div>
                            <div>Tipos de Usuario</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('tipos') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver tipos de Usuario</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-xl-6 col-md-12 mb-4" style="margin-top: 20px;">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Estadisticas Registros Por Tablas</h4>
                </div>
                <div class="card-body">
                    <div id="container_chart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4" style="margin-top: 20px;">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Estadisticas Cantidad de Medicos Por Sede</h4>
                </div>
                <div class="card-body">
                    <div id="container_radius_pie" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4" style="margin-top: 20px;">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Estadisticas Cantidad de Medicos Por Sede y Estado</h4>
                </div>
                <div class="card-body">
                    <div id="container_basic_bar" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>


</div>

<?= require_once('components/footer.php') ?>