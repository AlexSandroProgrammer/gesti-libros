<?php
$titlePage = "Lista de Libros";
require_once("../components/sidebar.php");

//*  CONSULTA PARA CONSUMIR LOS DATOS DEL GRADO

$listaGrados = $connection->prepare("SELECT * FROM grados AS g");
$listaGrados->execute();
$grados = $listaGrados->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h2 class="card-header font-bold">Listar Libros</h2>
            <div class="card-body">
                <div class="row gy-3 mb-3">
                    <!-- Default Modal -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#formGrado">
                            <i class="fas fa-clipboard-list"></i> Registrar Grado
                        </button>
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
                                        <th>Nombre del Grado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($grados as $grado): ?>
                                    <tr>
                                        <td>
                                            <form method="GET" action="">
                                                <input type="hidden" name="id_employee-delete"
                                                    value="<?= $grado['id_grado'] ?>">
                                                <input type="hidden" name="ruta" value="grados_activos.php">
                                                <button class="btn btn-danger mt-2"
                                                    onclick="return confirm('¿Desea eliminar el registro?');"
                                                    type="submit">
                                                    <i class="bx bx-trash" title="Eliminar"></i>
                                                </button>
                                            </form>
                                            <form method="GET" class="mt-2" action="editar_grado.php">
                                                <input type="hidden" name="id_employee-edit"
                                                    value="<?= $grado['id_grado'] ?>">
                                                <input type="hidden" name="ruta" value="grados_activos.php">
                                                <button class="btn btn-success"
                                                    onclick="return confirm('¿Desea actualizar el registro?');"
                                                    type="submit">
                                                    <i class="bx bx-refresh" title="Actualizar"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td><?= $grado['grado'] ?></td>
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
    <!-- Modal -->
    <div class="modal fade" id="formGrado" tabindex="-1" aria-hidden="true">
        <form class="modal-dialog" action="" method="POST" autocomplete="off" name="formRegisterGrade">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Registro de Grado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="grado">Nombre del Grado</label>
                        <div class="input-group input-group-merge">
                            <span id="nombre_area-span" class="input-group-text"><i class="fas fa-layer-group"></i>
                            </span>
                            <input type="text" required minlength="2" maxlength="100" autofocus class="form-control"
                                name="grado" id="grado" placeholder="Ingresa el nombre del grado" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <input type="submit" class="btn btn-primary" value="Registrar"></input>
                    <input type="hidden" class="btn btn-info" value="formRegisterGrade"
                        name="MM_formRegisterGrade"></input>
                </div>
            </div>
        </form>
    </div>

    <?php
    require_once("../components/footer.php")
    ?>