<?php
$titlePage = "Editar de Prestamo";
require_once("../components/sidebar.php");

if (!isset($_GET['documento']) || !isset($_GET['id_prestamo'])) {
     // Redireccionamos al usuario si no se obtienen los parametros
    showErrorOrSuccessAndRedirect("error", "Error de redireccionamiento", "No tienes autorizacion para ingresar en esta pagina.", "prestamos_pendientes.php");
    exit();
}

$id_prestamo = $_GET['id_prestamo'];
$documento = $_GET['documento'];

//* CONSUMIMOS LOS DATOS EN CONSULTAS DIFERENTES PARA TEMAS DE RENDIMIENTO

$general = $connection->prepare("SELECT g.*, u.nombres, u.apellidos, u.documento, u.tipo_documento, gr.grado, u.celular FROM general_prestamos AS g INNER JOIN usuarios AS u ON (g.id_usuario = u.documento) INNER JOIN grados AS gr ON gr.id_grado = u.id_grado WHERE g.id_prestamo = :id_prestamo AND u.documento = :documento;");
$general->bindParam(':id_prestamo', $id_prestamo);
$general->bindParam(':documento', $documento);
$general->execute();
$encabezado = $general->fetch(PDO::FETCH_ASSOC);



$libros_prestados = $connection->prepare("SELECT l.nombre_libro, l.codigo_libro, d.* FROM d_general_prestamo AS d INNER JOIN libros AS l ON d.id_libro = l.id_libro WHERE d.id_general = :id_general;");
$libros_prestados->bindParam(':id_general', $id_prestamo);
$libros_prestados->execute();
$libros = $libros_prestados->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3 class="fw-bold pb-1">Detalle Prestamo de Libros Nro.
                            <?php echo $encabezado['id_prestamo'] ?></h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="fw-bold"> <i class="bx bx-library"></i> DATOS DEL ESTUDIANTE</h6>
                            </div>
                            <!-- tipo de documento -->
                            <div class="mb-3 col-12 col-xl-6">
                                <label class="form-label" for="documento_encontrado">Tipo de
                                    Documento</label>
                                <div class="input-group input-group-merge">
                                    <span id="tipo_docu_encontrado-icon" class="input-group-text"><i
                                            class="fas fa-address-card"></i></span>
                                    <input type="text" class="form-control" id="tipo_docu_encontrado"
                                        name="tipo_docu_encontrado" value="<?php echo $encabezado['tipo_documento'] ?>"
                                        readonly />
                                </div>
                            </div>
                            <!-- numero de documento -->
                            <div class="mb-3 col-12 col-xl-6">
                                <label class="form-label" for="documento_encontrado">Numero de
                                    Documento</label>
                                <div class="input-group input-group-merge">
                                    <span id="documento_encontrado-icon" class="input-group-text"><i
                                            class="fas fa-address-card"></i></span>

                                    <input type="text" class="form-control documento_encontrado"
                                        id="documento_encontrado" name="documento_encontrado"
                                        value="<?php echo $encabezado['documento'] ?>" readonly />

                                    <input type="hidden" class="form-control documento_encontrado" id="documento_oculto"
                                        name="documento_oculto" value="<?php echo $encabezado['documento'] ?>" />
                                </div>
                            </div>
                            <!-- nombres -->
                            <div class="mb-3 col-12 col-xl-6">
                                <label class="form-label" for="nombres">Nombre Completo</label>
                                <div class="input-group input-group-merge">
                                    <span id="nombres_span" class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="nombre_encontrado"
                                        id="nombre_encontrado"
                                        value="<?php echo $encabezado['nombres'] ?> <?php echo $encabezado['apellidos'] ?>"
                                        readonly />
                                </div>
                            </div>

                            <!-- numero de celular -->
                            <div class="mb-3 col-12 col-xl-6">
                                <label class="form-label" for="celular_encontrado">Numero de Celular</label>
                                <div class="input-group input-group-merge">
                                    <span id="celular_encontrado_span" class="input-group-text"><i
                                            class="fas fa-mobile-alt "></i></span>
                                    <input type="text" class="form-control" name="celular_encontrado"
                                        id="celular_encontrado" value="<?php echo $encabezado['celular'] ?>" readonly />
                                </div>
                            </div>

                            <!-- numero de celular -->
                            <div class="mb-3 col-12 col-xl-6">
                                <label class="form-label" for="grado_encontrado">Grado Asignado</label>
                                <div class="input-group input-group-merge">
                                    <span id="grado_encontrado_span" class="input-group-text"><i
                                            class="fas fa-mobile-alt "></i></span>
                                    <input type="text" class="form-control" name="grado_encontrado"
                                        value="<?php echo $encabezado['grado'] ?>" id="grado_encontrado" readonly />
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de libros seleccionados -->
                        <div class="row mt-3">

                            <?php
                        if(!empty($libros)){
                            // filtramos los libros penndientes
                            $libros_pendientes = array_filter($libros, function($libro) {
                                return isset($libro['estado']) && strtolower($libro['estado']) === 'pendiente';
                            });

                            // filtramos los libros entregados
                            $libros_entregados = array_filter($libros, function($libro) {
                                return isset($libro['estado']) && strtolower($libro['estado']) === 'entregado';
                            });

                            if(count($libros_pendientes) > 0){
                        ?>
                            <div class="col-lg-12">
                                <h6 class="fw-bold"> <i class="bx bx-library"></i> LIBROS LIBROS PENDIENTES
                                    POR ENTREGAR
                                </h6>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped text-left">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Datos del Libro</th>
                                                <th>Cantidad Prestada</th>
                                                <th>Datos del Prestamo</th>
                                                <th>Datos de Entrega</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($libros_pendientes as $libroPendiente): ?>
                                            <tr>
                                                <td>
                                                    <a href="editar_prestamo.php?documento=<?= $libroPrestado['documento'] ?>&id_prestamo=<?= $libroPrestado['id_prestamo'] ?>"
                                                        class="btn btn-danger mb-2">
                                                        <i class="fas fa-check-circle"></i> Entregar
                                                    </a>
                                                </td>
                                                <td>
                                                    <ul class="mb-0">
                                                        <li><strong>Código:</strong>
                                                            <?= htmlspecialchars($libroPendiente['codigo_libro']) ?>
                                                        </li>
                                                        <li><strong>Nombre:</strong>
                                                            <?= htmlspecialchars($libroPendiente['nombre_libro']) ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($libroPendiente['cantidad_prestamo']) ?>
                                                </td>
                                                <td>
                                                    <ul class="mb-0">
                                                        <li><strong>Fecha:</strong>
                                                            <?= date('d/m/Y', strtotime($libroPendiente['fecha_prestamo'])) ?>
                                                        </li>
                                                        <li><strong>Hora:</strong>
                                                            <?= date('H:i', strtotime($libroPendiente['hora_prestamo'])) ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="mb-0">
                                                        <li><strong>Fecha:</strong>
                                                            <?= date('d/m/Y', strtotime($libroPendiente['fecha_entrega'])) ?>
                                                        </li>
                                                        <li><strong>Hora:</strong>
                                                            <?= date('H:i', strtotime($libroPendiente['hora_entrega'])) ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                            }

                            if(count($libros_entregados) > 0){
                        ?>
                            <div class="col-lg-12">
                                <h6 class="fw-bold"> <i class="bx bx-library"></i> LIBROS ENTREGADOS
                                </h6>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped text-left">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Datos del Libro</th>
                                                <th>Cantidad Prestada</th>
                                                <th>Datos del Prestamo</th>
                                                <th>Datos de Entrega</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($libros_entregados as $libroEntregado): ?>
                                            <tr>
                                                <td>
                                                    <a href="#" class="btn btn-success mb-2">
                                                        <i class="fas fa-check-circle"></i> Entregado
                                                    </a>
                                                </td>
                                                <td>
                                                    <ul class="mb-0">
                                                        <li><strong>Código:</strong>
                                                            <?= htmlspecialchars($libroEntregado['codigo_libro']) ?>
                                                        </li>
                                                        <li><strong>Nombre:</strong>
                                                            <?= htmlspecialchars($libroEntregado['nombre_libro']) ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($libroEntregado['cantidad_prestamo']) ?>
                                                </td>
                                                <td>
                                                    <ul class="mb-0">
                                                        <li><strong>Fecha:</strong>
                                                            <?= date('d/m/Y', strtotime($libroEntregado['fecha_prestamo'])) ?>
                                                        </li>
                                                        <li><strong>Hora:</strong>
                                                            <?= date('H:i', strtotime($libroEntregado['hora_prestamo'])) ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="mb-0">
                                                        <li><strong>Fecha:</strong>
                                                            <?= date('d/m/Y', strtotime($libroEntregado['fecha_entrega'])) ?>
                                                        </li>
                                                        <li><strong>Hora:</strong>
                                                            <?= date('H:i', strtotime($libroEntregado['hora_entrega'])) ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>




                            <?php
                            }
                        }
                        ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once("../components/footer.php") ?>