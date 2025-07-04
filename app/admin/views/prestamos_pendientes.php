<?php
$titlePage = "Listado de Prestamos Pendientes";
require_once("../components/sidebar.php");

//* CONSULTA PARA CONSUMIR LOS DATOS DE LOS PRESTAMOS REALIZADOS
$listaPrestamosLibros = $connection->prepare("SELECT g.*, u.nombres, u.apellidos, u.documento, u.tipo_documento FROM general_prestamos AS g INNER JOIN usuarios AS u ON (g.id_usuario = u.documento) WHERE g.id_estado = 'pendiente';");
$listaPrestamosLibros->execute();
$prestarLibros = $listaPrestamosLibros->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h2 class="card-header font-bold">Prestamos Pendientes</h2>
            <div class="card-body">
                <div class="row gy-3 mb-3">
                    <div class="col-lg-4 col-md-6">
                        <a class="btn btn-primary" href="registrar_prestamo.php">
                            <i class="fas fa-plus-circle"></i> Prestar Libro
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>ID Factura</th>
                                <th>Datos Estudiante</th>
                                <th>Fecha Registro</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prestarLibros as $libroPrestado): ?>
                            <tr>
                                <td>
                                    <a href="editar_prestamo.php?documento=<?= $libroPrestado['documento'] ?>&id_prestamo=<?= $libroPrestado['id_prestamo'] ?>"
                                        class="btn btn-primary mb-2">
                                        <i class="fas fa-eye"></i> Ver Prestamo
                                    </a>
                                </td>
                                <td>
                                    <?= htmlspecialchars($libroPrestado['id_prestamo']) ?>
                                </td>
                                <td>
                                    <ul style="text-align: left !important;">
                                        <li><strong>Documento:</strong>
                                            <?= htmlspecialchars($libroPrestado['documento']) ?></li>

                                        <li><strong>Nombre Completo:</strong>
                                            <?= htmlspecialchars($libroPrestado['nombres']) ?>
                                            <?= htmlspecialchars($libroPrestado['apellidos']) ?></li>
                                    </ul>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($libroPrestado['fecha_registro'])) ?>
                                </td>
                                <td>
                                    <?php if (strtolower($libroPrestado['id_estado']) === 'pendiente'): ?>
                                    <span style="color: red; font-weight: bold;">
                                        <?= strtoupper(htmlspecialchars($libroPrestado['id_estado'])) ?>
                                    </span>
                                    <?php else: ?>
                                    <?= htmlspecialchars($libroPrestado['id_estado']) ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function verDetalleLibro(nombre, imagen, detalle) {
    Swal.fire({
        title: nombre,
        html: `<img src="${imagen}" alt="Imagen del libro" class="img-fluid mb-3"/><p>${detalle}</p>`,
        width: window.innerWidth < 768 ? '100%' : '350px',
    });
}
</script>

<?php require_once("../components/footer.php"); ?>