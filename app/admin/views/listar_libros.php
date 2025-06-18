<?php
$titlePage = "Lista de Libros";
require_once("../components/sidebar.php");


//*  CONSULTA PARA CONSUMIR LOS DATOS DE LOS LIBROS
$listaLibros = $connection->prepare("SELECT * FROM libros AS g");
$listaLibros->execute();
$libros = $listaLibros->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
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
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="table-responsive w-100">
                            <table id="example" class="table table-striped table-bordered top-table text-center"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Nombre del Libro</th>
                                        <th>Descripcion</th>
                                        <th>Imagen del Libro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($libros as $libro): ?>
                                    <tr>
                                        <td>
                                            <form method="GET" action="">
                                                <input type="hidden" name="id_employee-delete"
                                                    value="<?= $libro['id_libro'] ?>">
                                                <input type="hidden" name="ruta" value="libros_activos.php">
                                                <button class="btn btn-danger mt-2"
                                                    onclick="return confirm('¿Desea eliminar el registro?');"
                                                    type="submit">
                                                    <i class="bx bx-trash" title="Eliminar"></i>
                                                </button>
                                            </form>
                                            <form method="GET" class="mt-2" action="editar_libro.php">
                                                <input type="hidden" name="id_employee-edit"
                                                    value="<?= $libro['id_libro'] ?>">
                                                <input type="hidden" name="ruta" value="libros_activos.php">
                                                <button class="btn btn-success"
                                                    onclick="return confirm('¿Desea actualizar el registro?');"
                                                    type="submit">
                                                    <i class="bx bx-refresh" title="Actualizar"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td><?= $libro['nombre_libro'] ?></td>
                                        <td><?= $libro['detalle'] ?></td>
                                        <td>
                                            <button class="btn btn-primary"
                                                onclick="verImagenLibro('<?= '../assets/img/' . $libro['imagen'] ?>')">
                                                <i class="fas fa-image"></i>
                                                Ver Imagen
                                            </button>
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
    </div>

    <script>
    function verImagenLibro(imageUrl) {
        Swal.fire({
            title: 'Imagen del Libro',
            imageUrl: imageUrl,
            imageAlt: 'Imagen del Libro',
            width: '350px',
        });
    }
    </script>


    <?php
    require_once("../components/footer.php")
    ?>