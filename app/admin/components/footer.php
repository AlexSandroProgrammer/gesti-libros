    <!-- / Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!--/ Basic footer -->
        <hr class="container-m-nx border-light my-5" />
        <!-- Footer with components -->
        <section id="component-footer">
            <footer class="footer bg-light">
                <div
                    class="container-fluid d-flex flex-lg-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
                    <div class="mb-2 mb-md-0">
                        ©
                        <script>
                        document.write(new Date().getFullYear());
                        </script>
                        , Todos los derechos reservados, diseñado y desarrollado por
                        <a href="#" target="_blank" class="footer-link fw-bolder">URBES</a>
                    </div>
                    <div>
                        <a href="index.php?logout" class="btn btn-sm btn-outline-danger"><i
                                class="bx bx-log-out-circle"></i>Cerrar Sesion</a>
                    </div>
                </div>
            </footer>
        </section>
        <!--/ Footer with components -->
    </div>

    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>

    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../../libraries/jquery/jquery-3.3.1.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../../libraries/datatables/datatables.min.js"></script>

    <!-- para usar botones en datatables JS -->
    <script src="../../libraries/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="../../libraries/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="../../libraries/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../../libraries/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../../libraries/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

    <!-- código JS propìo-->
    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <!-- Main JS -->
    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>

    <script src="../../js/functions.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script type="text/javascript" src="../../js/props-datatable.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    let buscar_documento = document.getElementById('buscar_documento');
    const boton_buscar_docu = document.getElementById('boton_buscar_docu');

    const documentos = document.querySelectorAll('.documento_encontrado');


    const nombre_encontrado = document.getElementById('nombre_encontrado');
    const celular_encontrado = document.getElementById('celular_encontrado');
    const tipo_docu_encontrado = document.getElementById('tipo_docu_encontrado');
    const grado_encontrado = document.getElementById('grado_encontrado');
    // mostramos el contenedor
    const contenedor = document.getElementById('contenedoresCondicionales');
    const buscarDocumento = document.getElementById('buscarDocumento');

    boton_buscar_docu.addEventListener('click', function() {

        let documento_ingresado = buscar_documento.value;

        if (documento_ingresado === '' || !documento_ingresado) {
            Swal.fire({
                icon: 'info',
                title: 'Campo vacío',
                text: 'Por favor, ingrese un documento para buscar al estudiante.',
                confirmButtonText: 'Aceptar'
            });
            return false;
        }


        // Realizamos la solicitud AJAX
        fetch(`buscar_estudiante.php?documento=${documento_ingresado}`)
            .then(response => response.json())
            .then(data => {

                console.log(data);

                if (data.status === 'success') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Perfecto!',
                        text: 'Hemos encontrado los datos del estudiante, por favor acepte para habilitar listado de libros.',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        const user = data.user;


                        // Asignar los valores a los inputs correspondientes
                        documentos.forEach(input => {
                            input.value = user.documento || '';
                        });



                        nombre_encontrado.value = `${user.nombres} ${user.apellidos}` || '';
                        celular_encontrado.value = user.celular || '';
                        tipo_docu_encontrado.value = user.tipo_documento || '';
                        grado_encontrado.value = user.grado || '';



                        // mostramos el contenedor

                        contenedor.style.display = 'block';
                        buscarDocumento.style.display = 'none';

                    });

                    return true;
                }


                Swal.fire({
                    icon: 'error',
                    title: 'Sin resultados!',
                    text: 'No se encontraron datos del estudiante, por favor ingresa un documento valido.',
                    confirmButtonText: 'Aceptar'
                });
                return false;
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Sin resultados!',
                    text: 'No se encontraron datos del estudiante, por favor ingresa un documento valido.',
                    confirmButtonText: 'Aceptar'
                });
                return false;
            });
    });

});
    </script>
    </body>

    </html>