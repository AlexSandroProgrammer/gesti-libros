<?php
$titlePage = "Lista Empleados Activos";
require_once("../components/sidebar.php");
// arreglo con ids de la consulta
// $array_keys = [1, 3];
// //*  CONSULTA PARA CONSUMIR LOS DATOS DE LOS EMPLEADOS ACTIVOS
// $listaEmpleados = $connection->prepare("SELECT * FROM usuarios INNER JOIN tipo_usuario ON usuarios.id_tipo_usuario = tipo_usuario.id_tipo_usuario INNER JOIN estados ON usuarios.id_estado = estados.id_estado INNER JOIN ciudades ON usuarios.id_ciudad = ciudades.id_ciudad WHERE usuarios.id_tipo_usuario = :id_tipo_usuario AND usuarios.id_estado = :id_estado");
// $listaEmpleados->bindParam(":id_tipo_usuario", $array_keys[1]);
// $listaEmpleados->bindParam(":id_estado", $array_keys[0]);
// $listaEmpleados->execute();
// $empleados = $listaEmpleados->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h2 class="card-header font-bold">Listar Grados</h2>
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
                        <table id="example"
                            class="table table-striped table-bordered top-table table-responsive text-center"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Nombre del Grado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php foreach ($empleados as $empleado) {
                                    // desencriptacion de contraseña
                                    $password = bcrypt_password($empleado['password']);
                                    $fecha_inicial = $empleado['fecha_inicio'];
                                    $fecha_final = $empleado['fecha_fin'];
                                    if (isNotEmpty([$fecha_inicial, $fecha_final])) {
                                        $fecha_inicio = DateTime::createFromFormat('Y-m-d', $empleado['fecha_inicio'])->format('d/m/Y');
                                        $fecha_fin = DateTime::createFromFormat('Y-m-d', $empleado['fecha_fin'])->format('d/m/Y');
                                    }
                                ?>
                                <tr>
                                    <td>
                                        <form method="GET" actionz="">
                                            <input type="hidden" name="id_employee-delete"
                                                value="<?= $empleado['documento'] ?>">
                                            <input type="hidden" name="ruta" value="empleados_activos.php">
                                            <button class="btn btn-danger mt-2"
                                                onclick="return confirm('¿Desea eliminar el registro seleccionado?');"
                                                type="submit">
                                                <i class="bx bx-trash" title="Eliminar"></i>
                                            </button>
                                        </form>
                                        <form method="GET" class="mt-2" action="editar_empleado.php">
                                            <input type="hidden" name="id_employee-edit"
                                                value="<?= $empleado['documento'] ?>">
                                            <input type="hidden" name="ruta" value="empleados_activos.php">
                                            <button class="btn btn-success"
                                                onclick="return confirm('¿Desea actualizar el registro seleccionado?');"
                                                type="submit">
                                                <i class="bx bx-refresh" title="Actualizar"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td><?php echo $empleado['tipo_documento'] ?></td>
                                    <td><?php echo $empleado['documento'] ?></td>
                                    <td><?php echo $empleado['nombres'] ?></td>
                                    <td><?php echo $empleado['apellidos'] ?></td>
                                    <td><?php echo $empleado['celular'] ?></td>
                                    <td><?php echo $password ?></td>
                                    <td><?php echo $empleado['ciudad'] ?></td>
                                    <td><?php echo $empleado['eps'] ?></td>
                                    <td><?php echo $empleado['arl'] ?></td>
                                    <td><?php echo $empleado['rh'] ?></td>
                                    <td><?php echo $fecha_inicio ?></td>
                                    <td><?php echo $fecha_fin ?></td>
                                    <td><?php echo $empleado['nombre_familiar'] ?></td>
                                    <td><?php echo $empleado['celular_familiar'] ?></td>
                                    <td><?php echo $empleado['parentezco_familiar'] ?></td>
                                    <td><?php echo $empleado['tipo_usuario'] ?></td>
                                    <td><?php echo $empleado['estado'] ?></td>
                                    <td><?php echo $empleado['fecha_registro'] ?></td>
                                    <td><?php echo $empleado['fecha_actualizacion'] ?></td>
                                </tr>
                                <?php } ?> -->
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="formGrado" tabindex="-1" aria-hidden="true">
        <form class="modal-dialog" action="" method="POST" autocomplete="off" name="formRegisterState">
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
                    <input type="hidden" class="btn btn-info" value="formRegisterState"
                        name="MM_formRegisterState"></input>
                </div>
            </div>
        </form>
    </div>

    <?php
    require_once("../components/footer.php")
    ?>