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
                                    <div class="col-lg-12">
                                        <h6 class="fw-bold"> <i class="bx bx-library"></i> DATOS DEL PRESTAMO DE LIBROS
                                        </h6>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#contenedorLibros">
                                            <i class="fas fa-search"></i> Consultar Libros
                                        </button>
                                    </div>
                                </div>

                                <!-- Tabla de libros seleccionados -->
                                <div class="row mt-3" id="contenedorLibrosSeleccionados" style="display: none;">
                                    <div class="col-lg-12">
                                        <h6 class="fw-bold"> <i class="bx bx-library"></i> LIBROS SELECCIONADOS PARA
                                            PRESTAR
                                        </h6>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped text-center">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Und. En Stock</th>
                                                        <th>Cantidad A Prestar</th>
                                                        <th>Fecha Prestamo</th>
                                                        <th>Fecha Entrega</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="librosSeleccionados">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" id="botonGuardarPrestamo">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary">
                                                <i class="bx bx-save"></i> Guardar Prestamo
                                            </button>
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
                                    <th>Codigo del Libro</th>
                                    <th>Nombre del Libro</th>
                                    <th>Cantidad Total</th>
                                    <th>Cantidad Disponible</th>
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
                                            cantidad_disponible: <?php echo $libro['cantidad_disponible']; ?>,
                                            nombre_libro: '<?php echo htmlspecialchars(addslashes($libro['nombre_libro'])) ?>',
                                            detalle: '<?php echo htmlspecialchars(addslashes($libro['detalle'])) ?>'
                                        })">
                                            <i class="bx bx-check-circle" title="Agregar este libro"></i> Agregar
                                        </button>
                                    </td>
                                    <td><?php echo htmlspecialchars($libro['codigo_libro']) ?></td>
                                    <td><?php echo htmlspecialchars($libro['nombre_libro']) ?></td>
                                    <td><?php echo htmlspecialchars($libro['cantidad_total']) ?></td>
                                    <td><?php echo htmlspecialchars($libro['cantidad_disponible']) ?></td>
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
const contenedorTabla = document.getElementById('librosSeleccionados');
const contenedorLibrosSeleccionados = document.getElementById('contenedorLibrosSeleccionados');
const modalElement = document.getElementById('contenedorLibros');
let modalInstance = null;


document.addEventListener('DOMContentLoaded', () => {

    const modalElement = document.getElementById('contenedorLibros');
    const btnGuardar = document.querySelector('#botonGuardarPrestamo button');


    if (modalElement) {
        modalInstance = new bootstrap.Modal(modalElement);
    }

    btnGuardar.addEventListener('click', function() {
        // Obtener el documento del estudiante
        const documento = document.getElementById('documento_encontrado').value;
        // Obtener los libros seleccionados
        const libros = [];
        // llamamos los libros
        const filas = document.querySelectorAll('#librosSeleccionados tr');


        filas.forEach((fila, idx) => {

            const id_libro_prestamo = fila.querySelector('input[name="id_libro_prestamo"]')
                ?.value || '';

            const cantidad_disponible = fila.children[1]?.textContent || '';

            const cantidad_prestamo = fila.querySelector('input[name="cantidad_prestamo"]')
                ?.value || '';

            const fecha_prestamo_raw = fila.querySelector('input[name="fecha_prestamo"]')
                ?.value || '';
            const fecha_entrega_raw = fila.querySelector('input[name="fecha_entrega"]')
                ?.value || '';

            // Validar campos vacíos
            if (
                id_libro_prestamo.trim() === '' ||
                isNaN(cantidad_disponible) ||
                isNaN(cantidad_prestamo) ||
                fecha_prestamo_raw.trim() === '' ||
                fecha_entrega_raw.trim() === ''
            ) {
                Swal.fire({
                    icon: 'info',
                    title: 'Datos Vacíos!',
                    text: 'Por favor ingresa todos los datos.',
                    confirmButtonText: 'Aceptar'
                });
                error = true;
                return false;
            }


            // Separar fecha y hora si el campo no está vacío
            let fecha_prestamo = '',
                hora_prestamo = '',
                fecha_entrega = '',
                hora_entrega = '';

            if (fecha_prestamo_raw) {
                [fecha_prestamo, hora_prestamo] = fecha_prestamo_raw.split('T');
            }
            if (fecha_entrega_raw) {
                [fecha_entrega, hora_entrega] = fecha_entrega_raw.split('T');
            }

            // Validar cantidad prestada no mayor que disponible
            if (cantidad_prestamo > cantidad_disponible) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cantidad inválida',
                    text: 'La cantidad a prestar no puede ser mayor que la cantidad disponible.',
                    confirmButtonText: 'Aceptar'
                });
                error = true;
                return false;
            }

            // Validar fecha de préstamo no mayor a fecha de entrega
            if (fecha_prestamo > fecha_entrega) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Fechas inválidas',
                    text: 'La fecha de préstamo no puede ser mayor que la fecha de entrega.',
                    confirmButtonText: 'Aceptar'
                });
                error = true;
                return false;
            }

            error = false;

            libros.push({
                id_libro_prestamo,
                cantidad_disponible,
                cantidad_prestamo,
                fecha_prestamo,
                hora_prestamo,
                fecha_entrega,
                hora_entrega
            });
        });

        if (error) return;

        // realizamos envio de los datos y del estudiante realizando la solicitud AJAX
        const librosArray = JSON.stringify(libros);
        const librosParam = encodeURIComponent(librosArray);
        const url =
            `registrar_prestamo_fact.php?libros=${librosParam}&documento=${documento}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {

                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Perfecto!',
                        text: 'Se ha registrado correctamente el prestamo de libros del estudiante.',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        location.href = "prestamos_pendientes.php";
                    });

                    return true;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error de registro!',
                    text: 'Error al momento de registrar los datos, por favor comunicate con tu administrador TI.',
                    confirmButtonText: 'Aceptar'
                });
                return false;
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de registro!',
                    text: 'Error al momento de registrar los datos, por favor comunicate con tu administrador TI.',
                    confirmButtonText: 'Aceptar'
                });
                return false;
            });
    });
});


function agregarLibro(libro) {
    if (!librosSeleccionados.some(l => l.id_libro === libro.id_libro)) {

        librosSeleccionados.push(libro);
        renderizarTablaLibros();
    } else {

        if (modalInstance) {
            modalInstance.hide();
        }

        Swal.fire({
            icon: 'info',
            title: 'Libro ya agregado!',
            text: 'El libro seleccionado ya fue agregado, por favor seleccione otro libro.',
            confirmButtonText: 'Aceptar'
        });
        return false;
    }
}

function renderizarTablaLibros() {

    if (!contenedorTabla) return;

    contenedorTabla.innerHTML = '';

    let tabla = ``;

    librosSeleccionados.forEach(libro => {
        tabla += `
        <tr>
        <td>${libro.nombre_libro}</td>
        <td>${libro.cantidad_disponible}<input type="hidden" class="form-control" name="id_libro_prestamo" id="id_libro_prestamo" value="${libro.id_libro}" /></td>
        <td>
            <div class="input-group input-group-merge">
                <span id="cantidad_prestamo_span" class="input-group-text"><i class="bx bx-library"></i></span>
                <input type="number" class="form-control" name="cantidad_prestamo" id="cantidad_prestamo" />
            </div>
        </td>

        <td>
            <div class="input-group input-group-merge">
                <span id="fecha_prestamo_span" class="input-group-text"><i class="bx bx-time "></i></span>
                <input type="datetime-local" class="form-control" name="fecha_prestamo" id="fecha_prestamo" />
            </div>
        </td>

        <td>
            <div class="input-group input-group-merge">
                <span id="fecha_entrega_span" class="input-group-text"><i class="bx bx-time "></i></span>
                <input type="datetime-local" class="form-control" name="fecha_entrega" id="fecha_entrega" />
            </div>
        </td>

        <td>
        <button class="btn btn-danger btn-sm" onclick="eliminarLibro(${libro.id_libro})">
        <i class="bx bx-trash"></i>
        </button>
        </td>
        </tr>
        `;
    });

    contenedorTabla.innerHTML = tabla;

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