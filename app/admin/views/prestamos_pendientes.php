<?php
$titlePage = "Listado de Prestamos Pendientes";
require_once("../components/sidebar.php");

//* CONSULTA PARA CONSUMIR LOS DATOS DE LOS PRESTAMOS REALIZADOS
$listaPrestamosLibros = $connection->prepare("SELECT g.*, u.nombres, u.apellidos, u.documento, u.tipo_documento FROM general_prestamos AS g INNER JOIN usuarios AS u ON (g.id_usuario = u.documento);");
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
                                <th>Horario del Prestamo</th>
                                <th>Horario de Entrega</th>
                                <th>Datos Estudiante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prestarLibros as $libroPrestado): ?>
                            <tr>
                                <td>
                                    <!-- <button class="btn btn-primary mb-2"
                                        onclick="verDetalleLibro('<?= htmlspecialchars(addslashes($libroPrestado['nombre_libro'])) ?>', '../assets/img/<?= htmlspecialchars(addslashes($libroPrestado['imagen'])) ?>', '<?= htmlspecialchars(addslashes($libroPrestado['detalle'])) ?>')">
                                        <i class="bx bx-show"></i>
                                    </button> -->
                                    <form method="GET" action="" class="d-inline">
                                        <input type="hidden" name="id_employee-delete"
                                            value="<?= $libroPrestado['id_prestamo'] ?>">
                                        <input type="hidden" name="ruta" value="libros_activos.php">
                                        <button class="btn btn-danger mb-2"
                                            onclick="return confirm('¿Desea eliminar el registro?');" type="submit">
                                            <i class="bx bx-trash" title="Eliminar"></i>
                                        </button>
                                    </form>
                                    <form method="GET" action="editar_libro.php" class="d-inline">
                                        <input type="hidden" name="id_employee-edit"
                                            value="<?= $libroPrestado['id_prestamo'] ?>">
                                        <input type="hidden" name="ruta" value="libros_activos.php">
                                        <button class="btn btn-success mb-2"
                                            onclick="return confirm('¿Desea actualizar el registro?');" type="submit">
                                            <i class="bx bx-refresh" title="Actualizar"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <ul>
                                        <li><strong>Fecha:</strong>
                                            <?= htmlspecialchars($libroPrestado['fecha_prestamo']) ?></li>
                                        <li><strong>Hora:</strong>
                                            <?= htmlspecialchars($libroPrestado['hora_prestamo']) ?>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li><strong>Fecha:</strong>
                                            <?= htmlspecialchars($libroPrestado['fecha_entrega']) ?></li>
                                        <li><strong>Hora:</strong>
                                            <?= htmlspecialchars($libroPrestado['hora_entrega']) ?>
                                        </li>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                        <li><strong>Fecha:</strong>
                                            <?= htmlspecialchars($libroPrestado['fecha_entrega']) ?></li>
                                        <li><strong>Hora:</strong>
                                            <?= htmlspecialchars($libroPrestado['hora_entrega']) ?>
                                        </li>
                                    </ul>
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