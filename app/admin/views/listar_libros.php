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
                    <?php foreach ($libros as $libro): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($libro['nombre_libro']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Detalle del Libro</h6>
                            </div>
                            <img class="img-fluid" src="../assets/img/<?= htmlspecialchars($libro['imagen']) ?>"
                                alt="Imagen del libro">
                            <div class="card-body">
                                <p class="card-text"><?= htmlspecialchars($libro['detalle']) ?></p>

                                <div class="d-flex justify-content-center gap-2">
                                    <form method="GET" action="">
                                        <input type="hidden" name="id_employee-delete"
                                            value="<?= $libro['id_libro'] ?>">
                                        <input type="hidden" name="ruta" value="libros_activos.php">
                                        <button class="btn btn-danger btn-lg"
                                            onclick="return confirm('¿Desea eliminar el registro?');" type="submit">
                                            <i class="bx bx-trash" title="Eliminar"></i>
                                        </button>
                                    </form>

                                    <form method="GET" action="editar_libro.php">
                                        <input type="hidden" name="id_employee-edit" value="<?= $libro['id_libro'] ?>">
                                        <input type="hidden" name="ruta" value="libros_activos.php">
                                        <button class="btn btn-success btn-lg"
                                            onclick="return confirm('¿Desea actualizar el registro?');" type="submit">
                                            <i class="bx bx-refresh" title="Actualizar"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
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
            width: window.innerWidth < 768 ? '90%' : '350px',
            imageWidth: '100%',
            imageHeight: 'auto'
        });
    }
    </script>

    <?php require_once("../components/footer.php") ?>