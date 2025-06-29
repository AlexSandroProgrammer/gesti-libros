<?php
$titlePage = "Registro de Prestamo";
require_once("../components/sidebar.php");

//* CONSULTA PARA CONSUMIR LOS DATOS DE LOS LIBROS
$listaLibros = $connection->prepare("SELECT * FROM libros AS g");
$listaLibros->execute();
$libros = $listaLibros->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3 class="fw-bold pb-1">Registro Prestamo de Libros</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="row" id="buscarDocumento">
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
                                    <button type="button" id="boton_buscar_docu" class="btn btn-primary">
                                        <i class="bx bx-search"></i> Buscar
                                    </button>
                                </div>
                            </div>

                            <div id="contenedoresCondicionales" style="display:none;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 class="fw-bold"> <i class="bx bx-library"></i> DATOS DEL ESTUDIANTE</h6>
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


                                <div class="row mt-3">
                                    <div class="col-lg-4 col-md-6">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#contenedorLibros">
                                            <i class="fas fa-search"></i> Consultar Libros
                                        </button>
                                    </div>
                                </div>

                                <!-- Tabla de libros seleccionados -->
                                <div class="row mt-3" id="contenedorLibrosSeleccionados" style="display: none;">
                                    <div class="col-12">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="librosSeleccionados">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="contenedorLibros" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Por favor seleccionar libros que se prestaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                        <button class="btn btn-info mb-2"
                                            onclick="verDetalleLibro('<?php echo htmlspecialchars(addslashes($libro['nombre_libro'])) ?>', '../assets/img/<?php echo htmlspecialchars(addslashes($libro['imagen'])) ?>', '<?php echo htmlspecialchars(addslashes($libro['detalle'])) ?>')">
                                            <i class="bx bx-show"></i> Ver
                                        </button>
                                        <button class="btn btn-success mb-2" onclick="agregarLibro({
                                            id_libro: <?php echo $libro['id_libro']; ?>,
                                            nombre_libro: '<?php echo htmlspecialchars(addslashes($libro['nombre_libro'])) ?>',
                                            detalle: '<?php echo htmlspecialchars(addslashes($libro['detalle'])) ?>'
                                        })">
                                            <i class="bx bx-check-circle" title="Agregar este libro"></i> Agregar
                                        </button>
                                    </td>
                                    <td><?php echo htmlspecialchars($libro['nombre_libro']) ?></td>
                                    <td><?php echo htmlspecialchars($libro['detalle']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetalleLibro" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetalleLibroTitulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalDetalleLibroImagen" src="" alt="Imagen del libro" class="img-fluid mb-3"
                        style="max-height:250px;">
                    <p id="modalDetalleLibroDescripcion"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let librosSeleccionados = [];

function agregarLibro(libro) {
    if (!librosSeleccionados.some(l => l.id_libro === libro.id_libro)) {
        librosSeleccionados.push(libro);
        console.log(librosSeleccionados);
        renderizarTablaLibros();
    } else {
        Swal.fire({
            icon: 'info',
            title: 'Libro ya Agregado!',
            text: 'El libro seleccionado ya fue agregado, por favor seleccione otro libro.',
            confirmButtonText: 'Aceptar'
        });
        return false;
    }
}

function renderizarTablaLibros() {
    const contenedorTabla = document.getElementById('librosSeleccionados');
    const contenedorLibrosSeleccionados = document.getElementById('contenedorLibrosSeleccionados');

    if (!contenedorTabla) return;

    contenedorTabla.innerHTML = '';

    let tabla = ``;

    librosSeleccionados.forEach(libro => {
        tabla += `
        <tr>
        <td>${libro.nombre_libro}</td>
        <td>${libro.detalle}</td>
        <td>
        <button class="btn btn-danger btn-sm" onclick="eliminarLibro(${libro.id_libro})">
        <i class="bx bx-trash"></i> Quitar
        </button>
        </td>
        </tr>
        `;
    });

    contenedorTabla.innerHTML = tabla;


    // Ocultar el modal correctamente usando Bootstrap 5
    const modalElement = document.getElementById('contenedorLibros');
    const modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (modalInstance) {
        modalInstance.hide();
    }

    contenedorLibrosSeleccionados.style.display = 'block';
}

function eliminarLibro(id_libro) {
    librosSeleccionados = librosSeleccionados.filter(libro => libro.id_libro !== id_libro);
    renderizarTablaLibros();
}

function verDetalleLibro(nombre, imagen, detalle) {
    document.getElementById('modalDetalleLibroTitulo').textContent = nombre;
    document.getElementById('modalDetalleLibroImagen').src = imagen;
    document.getElementById('modalDetalleLibroDescripcion').textContent = detalle;

    var modal = new bootstrap.Modal(document.getElementById('modalDetalleLibro'));
    modal.show();
}
</script>

<?php require_once("../components/footer.php") ?>