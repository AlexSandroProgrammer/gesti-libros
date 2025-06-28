<?php
$titlePage = "Lista de Libros";
require_once("../components/sidebar.php");

//* CONSULTA PARA CONSUMIR LOS DATOS DE LOS LIBROS
$listaLibros = $connection->prepare("SELECT * FROM libros AS g");
$listaLibros->execute();
$libros = $listaLibros->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h2 class="card-header font-bold">Listar Libros</h2>
            <div class="card-body">
                <div class="row gy-3 mb-3">
                    <div class="col-lg-4 col-md-6">
                        <a class="btn btn-primary" href="registrar_libro.php">
                            <i class="fas fa-plus-circle"></i> Registrar Libro
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Nombre del Libro</th>
                                <th>Descripcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($libros as $libro): ?>
                            <tr>
                                <td>
                                    <button class="btn btn-primary mb-2"
                                        onclick="verDetalleLibro('<?= htmlspecialchars(addslashes($libro['nombre_libro'])) ?>', '../assets/img/<?= htmlspecialchars(addslashes($libro['imagen'])) ?>', '<?= htmlspecialchars(addslashes($libro['detalle'])) ?>')">
                                        <i class="bx bx-show"></i>
                                    </button>
                                    <form method="GET" action="" class="d-inline">
                                        <input type="hidden" name="id_employee-delete"
                                            value="<?= $libro['id_libro'] ?>">
                                        <input type="hidden" name="ruta" value="libros_activos.php">
                                        <button class="btn btn-danger mb-2"
                                            onclick="return confirm('¿Desea eliminar el registro?');" type="submit">
                                            <i class="bx bx-trash" title="Eliminar"></i>
                                        </button>
                                    </form>
                                    <form method="GET" action="editar_libro.php" class="d-inline">
                                        <input type="hidden" name="id_employee-edit" value="<?= $libro['id_libro'] ?>">
                                        <input type="hidden" name="ruta" value="libros_activos.php">
                                        <button class="btn btn-success mb-2"
                                            onclick="return confirm('¿Desea actualizar el registro?');" type="submit">
                                            <i class="bx bx-refresh" title="Actualizar"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><?= htmlspecialchars($libro['nombre_libro']) ?></td>
                                <td><?= htmlspecialchars($libro['detalle']) ?></td>
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