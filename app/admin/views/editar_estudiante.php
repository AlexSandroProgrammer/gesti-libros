<?php
$titlePage = "Editar Estudiante";
require_once("../components/sidebar.php");
if (isNotEmpty([$_GET['id_student-edit'], $_GET['ruta']])) {
    $id_student = $_GET['id_student-edit'];
    $ruta = $_GET['ruta'];
    $getFindByIdStudent = $connection->prepare("SELECT * FROM usuarios  INNER JOIN estado ON  usuarios.id_estado = estado.id_estado  INNER JOIN grados  ON usuarios.id_grado = grados.id_grado WHERE usuarios.documento = :documento");
    $getFindByIdStudent->bindParam(":documento", $id_student);
    $getFindByIdStudent->execute();
    $studentGetId = $getFindByIdStudent->fetch(PDO::FETCH_ASSOC);
    if ($studentGetId) {
        // desencriptacion de contraseña 
       
?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header justify-content-between align-items-center">
                        <h3 class="fw-bold py-2">Editar datos de
                            <?php echo $studentGetId['nombres'] ?> - <?php echo $studentGetId['apellidos'] ?>
                        </h3>
                        <h6 class="mb-0">Edita por favor los siguientes datos necesarios.</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off"
                            name="formUpdateStudent">
                            <div class="row">
                                <input type="hidden" name="ruta" value="<?php echo $ruta ?>">
                                <h6 class="mb-3 fw-bold"> <i class="bx bx-user"></i> DATOS PERSONALES</h6>
                                <!-- tipo de documento -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                                    <div class="input-group input-group-merge">
                                        <span id="tipo_documento-2" class="input-group-text"><i
                                                class="fas fa-id-card"></i></span>
                                        <select class="form-select" autofocus name="tipo_documento" id="tipo_documento"
                                            required>
                                            <option value="<?php echo $studentGetId['tipo_documento'] ?>">
                                                <?php echo $studentGetId['tipo_documento'] ?></option>
                                            <option value="C.C.">C.C.</option>
                                            <option value="C.E.">C.E.</option>
                                            <option value="T.I.">T.I.</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- numero de documento -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="documento">Numero de Documento</label>
                                    <div class="input-group input-group-merge">
                                        <span id="documento-icon" class="input-group-text"><i
                                                class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control"
                                            onkeypress="return(multiplenumber(event));"
                                            value="<?php echo $studentGetId['documento'] ?>" readonly minlength="10"
                                            maxlength="10" oninput="maxlengthNumber(this);" id="documento"
                                            name="documento" placeholder="Ingresar numero de documento"
                                            aria-describedby="documento-icon" />
                                    </div>
                                </div>
                                <!-- nombres -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="nombres">Nombres</label>
                                    <div class="input-group input-group-merge">
                                        <span id="nombres_span" class="input-group-text"><i
                                                class="fas fa-user"></i></span>
                                        <input type="text" required minlength="2"
                                            value="<?php echo $studentGetId['nombres'] ?>" maxlength="100"
                                            class="form-control" name="nombres" id="nombres"
                                            placeholder="Ingresar nombres completos" />
                                    </div>
                                </div>
                                <!-- apellidos -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="apellidos">Apellidos</label>
                                    <div class="input-group input-group-merge">
                                        <span id="nombre_area-span" class="input-group-text"><i
                                                class="fas fa-user"></i></span>
                                        <input type="text" required minlength="2"
                                            value="<?php echo $studentGetId['apellidos'] ?>" maxlength="100"
                                            class="form-control" name="apellidos" id="apellidos"
                                            placeholder="Ingresar apellidos completos" />
                                    </div>
                                </div>
                                <!-- numero de celular -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="celular">Numero de Celular</label>
                                    <div class="input-group input-group-merge">
                                        <span id="celular_span" class="input-group-text"><i
                                                class="fas fa-mobile-alt"></i></span>
                                        <input type="text" required onkeypress="return(multiplenumber(event));"
                                            minlength="10" maxlength="10"
                                            value="<?php echo $studentGetId['celular'] ?>" class="form-control"
                                            name="celular" id="celular" placeholder="Ingresar numero de celular" />
                                    </div>
                                </div>
                                <div class="mb-3 col-12 col-lg-6">
                                    <label for="estado" class="form-label">Estado Usuario</label>
                                    <div class="input-group input-group-merge">
                                        <span id="estado-2" class="input-group-text"><i
                                                class="fas fa-user-check"></i></span>
                                        <select class="form-select" name="estado" required>
                                            <option value="<?php echo $studentGetId['id_estado'] ?>">
                                                <?php echo $studentGetId['estado'] ?>
                                            </option>
                                            <?php
                                                    // CONSUMO DE DATOS DE LOS EMPLEADOS
                                                    $listEstados = $connection->prepare("SELECT * FROM estado WHERE id_estado = 1 ||id_estado = 2   ");
                                                    $listEstados->execute();
                                                    $estados = $listEstados->fetchAll(PDO::FETCH_ASSOC);
                                                    // Verificar si no hay datos
                                                    if (empty($estados)) {
                                                        echo "<option value=''>No hay datos...</option>";
                                                    } else {
                                                        // Iterar sobre los estados
                                                        foreach ($estados as $estado) {
                                                            echo "<option value='{$estado['id_estado']}'>{$estado['estado']}</option>";
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                             
                          
                                <!-- tipo rol -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label for="grado" class="form-label">Grado</label>
                                    <div class="input-group input-group-merge">
                                        <span id="estado-2" class="input-group-text"><i
                                                class="fas fa-user-tag"></i></span>
                                        <select class="form-select" name="grado" required>
                                            <option value="<?php echo $studentGetId['id_grado'] ?>">
                                                <?php echo $studentGetId['grado'] ?></option>
                                            <?php
                                                    // CONSUMO DE DATOS DE LOS PROCESOS
                                                    $types_query = $connection->prepare("SELECT * FROM grados ");
                                                    $types_query->execute();
                                                    $types = $types_query->fetchAll(PDO::FETCH_ASSOC);
                                                    // Verificar si no hay datos
                                                    if (empty($types)) {
                                                        echo "<option value=''>No hay datos...</option>";
                                                    } else {
                                                        // Iterar sobre los types
                                                        foreach ($types as $type) {
                                                            echo "<option value='{$type['id_grado']}'>{$type['grado']}</option>";
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="estudiantes.php" class="btn btn-danger">
                                        Cancelar
                                    </a>
                                    <input type="submit" class="btn btn-primary" value="Actualizar"></input>
                                    <input type="hidden" class="btn btn-info" value="formUpdateStudent"
                                        name="MM_formUpdateStudent"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once("../components/footer.php");
    } else {
        showErrorOrSuccessAndRedirect("error", "Error de ruta", "Los datos del estudiante no fueron encontrados", "estudiantes.php");
    }
} else {
    showErrorOrSuccessAndRedirect("error", "Error de ruta", "Los datos del empleado no fueron encontrados", "estudiantes.php");
}
    ?>