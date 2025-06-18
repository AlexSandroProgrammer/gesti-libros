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
                        <h3 class="fw-bold pb-1">Registro de Libro</h3>
                        <h6 class="mb-0">Ingresa por favor los siguientes datos.</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off"
                            name="formRegisterLibrary">
                            <div class="row">
                                <h6 class=" fw-bold"> <i class="bx bx-library"></i> DATOS DEL LIBRO</h6>

                                <!-- nombre del libro -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="nombre_libro">Nombre del Libro</label>
                                    <div class="input-group input-group-merge">
                                        <span id="nombre_libro_span" class="input-group-text"><i
                                                class="fas fa-book"></i></span>
                                        <input type="text" required minlength="5" maxlength="100" class="form-control"
                                            name="nombre_libro" id="nombre_libro"
                                            placeholder="Ingresar nombre del libro" autofocus />
                                    </div>
                                </div>

                                <!-- adjuntar la imagen del libro -->
                                <div class="mb-3 col-12 col-lg-6">
                                    <label class="form-label" for="imagen">Adjuntar Imagen del libro</label>
                                    <div class="input-group input-group-merge">
                                        <span id="imagen_span" class="input-group-text"><i
                                                class="fas fa-image"></i></span>
                                        <input type="file" required class="form-control" name="imagen" id="imagen"
                                            accept="image/*" onchange="previewImage(event)" />
                                    </div>
                                </div>

                                <!-- container para vista previa de la imagen -->
                                <div class="col-md-12 d-flex justify-content-center">
                                    <div class="col-md-6 col-lg-4" id="containerPreview" style="display: none;">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Imagen del libro</h5>
                                                <h6 class="card-subtitle mb-3">Imagen del libro seleccionada</h6>
                                                <img class="img-fluid rounded" id="preview" src="#"
                                                    alt="Imagen seleccionada">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- descripcion del libro -->
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="descripcion_libro">Descripcion del libro</label>
                                    <div class="input-group input-group-merge">
                                        <span id="descripcion_libro_span" class="input-group-text"><i
                                                class="fas fa-info-circle"></i></span>
                                        <textarea cols="30" rows="5" class="form-control" name="descripcion_libro"
                                            id="descripcion_libro" required></textarea>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="listar_libros.php" class="btn btn-danger">
                                        Cancelar
                                    </a>
                                    <input type="submit" class="btn btn-primary" value="Registrar"></input>
                                    <input type="hidden" class="btn btn-info" value="formRegisterLibrary"
                                        name="MM_formRegisterLibrary"></input>
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

    <script>
    function previewImage(event) {
        const file = event.target.files[0];
        const container = document.getElementById('containerPreview');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                container.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            alert('Por favor selecciona un archivo de imagen valido.');
            event.target.value = '';
            container.style.display = 'none';
        }
    }
    </script>