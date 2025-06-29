<?php
$titlePage = "Registro de Prestamo";
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
                        <h3 class="fw-bold pb-1">Registro Prestamo de Libros</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off"
                            name="formRegisterLibrary">
                            <div class="row" id="buscarDocumento">
                                <!-- <h6 class=" fw-bold"> <i class="bx bx-library"></i> DATOS DEL LIBRO</h6> -->
                                <div class="col-lg-12">
                                    <h6>Ingresa por favor el documento del estudiante para habilitar el prestamo de los
                                        libros.</h6>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" for="buscar_documento">Documento</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                        <input type="text" required minlength="5" maxlength="100" class="form-control"
                                            name="buscar_documento" id="buscar_documento"
                                            placeholder="Ingresar documento" autofocus />
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-top: 30px;">
                                    <div class="input-group">
                                        <button type="button" id="boton_buscar_docu" class="btn btn-primary"><i
                                                class="bx bx-search"></i>
                                            Buscar</button>
                                    </div>
                                </div>
                            </div>

                            <div id="contenedoresCondicionales" style="display:none;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 class=" fw-bold"> <i class="bx bx-library"></i> DATOS DEL ESTUDIANTE</h6>
                                    </div>
                                    <!-- tipo de documento -->
                                    <div class="mb-3 col-12 col-lg-6">
                                        <label class="form-label" for="documento_encontrado">Tipo de
                                            Documento</label>
                                        <div class="input-group input-group-merge">
                                            <span id="tipo_docu_encontrado-icon" class="input-group-text"><i
                                                    class="fas fa-address-card"></i></span>
                                            <input type="text" class="form-control" id="tipo_docu_encontrado"
                                                name="tipo_docu_encontrado" readonly />
                                        </div>
                                    </div>


                                    <!-- numero de documento -->
                                    <div class="mb-3 col-12 col-lg-6">
                                        <label class="form-label" for="documento_encontrado">Numero de
                                            Documento</label>
                                        <div class="input-group input-group-merge">
                                            <span id="documento_encontrado-icon" class="input-group-text"><i
                                                    class="fas fa-address-card"></i></span>

                                            <input type="text" class="form-control documento_encontrado"
                                                id="documento_encontrado" name="documento_encontrado" readonly />

                                            <input type="hidden" class="form-control documento_encontrado"
                                                id="documento_oculto" name="documento_oculto" />
                                        </div>
                                    </div>

                                    <!-- nombres -->
                                    <div class="mb-3 col-12 col-lg-6">
                                        <label class="form-label" for="nombres">Nombre Completo</label>
                                        <div class="input-group input-group-merge">
                                            <span id="nombres_span" class="input-group-text"><i
                                                    class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" name="nombre_encontrado"
                                                id="nombre_encontrado" readonly />
                                        </div>
                                    </div>

                                    <!-- numero de celular -->
                                    <div class="mb-3 col-12 col-lg-6">
                                        <label class="form-label" for="celular_encontrado">Numero de Celular</label>
                                        <div class="input-group input-group-merge">
                                            <span id="celular_encontrado_span" class="input-group-text"><i
                                                    class="fas fa-mobile-alt "></i></span>
                                            <input type="text" class="form-control" name="celular_encontrado"
                                                id="celular_encontrado" readonly />
                                        </div>
                                    </div>

                                    <!-- numero de celular -->
                                    <div class="mb-3 col-12 col-lg-6">
                                        <label class="form-label" for="grado_encontrado">Grado Asignado</label>
                                        <div class="input-group input-group-merge">
                                            <span id="grado_encontrado_span" class="input-group-text"><i
                                                    class="fas fa-mobile-alt "></i></span>
                                            <input type="text" class="form-control" name="grado_encontrado"
                                                id="grado_encontrado" readonly />
                                        </div>
                                    </div>
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