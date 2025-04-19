<?php
$titlePage = "Registro de Grado";
require_once("../components/sidebar.php");
?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header justify-content-between align-items-center text-center">
                        <h3 class="fw-bold pb-1">Registro de Estudiante</h3>
                        <h6 class="mb-0">Ingresa por favor los siguientes datos.</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off"
                            name="formRegisterStudent">
                            <div class="row">
                                <h6 class="mb-3 fw-bold"> <i class="bx bx-user"></i> DATOS DEL ESTUDIANTE</h6>

                                <!-- tipo de documento -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                                    <div class="input-group input-group-merge">
                                        <span id="tipo_documento-2" class="input-group-text"><i
                                                class="fas fa-id-card"></i></span>
                                        <select class="form-select" autofocus name="tipo_documento" id="tipo_documento"
                                            required>
                                            <option value="">Seleccionar tipo de documento...</option>
                                            <option value="C.C.">C.C.</option>
                                            <option value="C.E.">C.E.</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- numero de documento -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="documento">Numero de Documento</label>
                                    <div class="input-group input-group-merge">
                                        <span id="documento-icon" class="input-group-text"><i
                                                class="fas fa-address-card"></i></span>
                                        <input type="text" minlength="6" maxlength="10" oninput="maxlengthNumber(this);"
                                            onkeypress="return(multiplenumber(event));" class="form-control" required
                                            id="documento" name="documento" placeholder="Ingresa tu numero de documento"
                                            autofocus />
                                    </div>
                                </div>

                                <!-- nombres -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="nombres">Nombre Completo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="nombres_span" class="input-group-text"><i
                                                class="fas fa-user"></i></span>
                                        <input type="text" required minlength="2" maxlength="100" class="form-control"
                                            name="nombres" id="nombres" placeholder="Ingresar nombres completos" />
                                    </div>
                                </div>

                                <!-- apellidos -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="apellidos">Apellido Completo</label>
                                    <div class="input-group input-group-merge">
                                        <span id="apellidos_span" class="input-group-text"><i
                                                class="fas fa-user"></i></span>
                                        <input type="text" required minlength="2" maxlength="100" class="form-control"
                                            name="apellidos" id="apellidos"
                                            placeholder="Ingresar apellidos completos" />
                                    </div>
                                </div>

                                <!-- numero de celular -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="celular">Numero de Celular</label>
                                    <div class="input-group input-group-merge">
                                        <span id="celular_span" class="input-group-text"><i
                                                class="fas fa-mobile-alt "></i></span>
                                        <input type="text" required type="text"
                                            onkeypress="return(multiplenumber(event));" minlength="10" maxlength="10"
                                            class="form-control" name="celular" id="celular"
                                            placeholder="Ingresar numero de celular" />
                                    </div>
                                </div>

                                <!-- grado del estudiante -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label for="estado" class="form-label">Grado Asignado</label>
                                    <div class="input-group input-group-merge">
                                        <span id="estado-2" class="input-group-text"><i
                                                class="fas fa-user-shield"></i></span>
                                        <select class="form-select" name="grado_asignado" required>
                                            <option value="">Seleccionar Grado...</option>
                                            <?php
                                            // CONSUMO DE DATOS DE LOS PROCESOS
                                            $tipo_grados = $connection->prepare("SELECT * FROM grados AS g");
                                            $tipo_grados->execute();
                                            $grados = $tipo_grados->fetchAll(PDO::FETCH_ASSOC);
                                            // Verificar si no hay datos
                                            if (empty($grados)) {
                                                echo "<option value=''>No hay datos...</option>";
                                            } else {
                                                // Iterar sobre los grados
                                                foreach ($grados as $grado) {
                                                    echo "<option value='{$grado['id_grado']}'>{$grado['grado']}</option>";
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
                                    <input type="submit" class="btn btn-primary" value="Registrar"></input>
                                    <input type="hidden" class="btn btn-info" value="formRegisterStudent"
                                        name="MM_formRegisterStudent"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("../components/footer.php")
    ?>