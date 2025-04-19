<?= require_once('components/sidebar.php') ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Registro de Sede</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ingresar por favor los datos de la sede
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="<?= base_url('sedes/register') ?>">
                                <div class="form-group">
                                    <label>Nombre de Sede</label>
                                    <input type="text" class="form-control" minlength="3" maxlength="60" min="3"
                                        max="60" autofocus name="nombre_sede" placeholder="Ingresar nombre de la sede">
                                </div>
                                <div class="form-group">
                                    <label>Direccion</label>
                                    <input type="text" class="form-control" minlegth="3" maxlength="200"
                                        name="direccion" placeholder="Ingresar direccion de la sede">
                                </div>
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" minlegth="10" maxlength="10" class="form-control"
                                        name="telefono" placeholder="Ingresar telefono de la sede">
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                                <a href="<?= base_url('sedes'); ?>" class="btn btn-danger">
                                    Regresar
                                </a>
                                <?php
                                if ($this->session->flashdata('error')) {
                                ?>
                                <script>
                                Swal.fire({
                                    title: 'Error!',
                                    text: '<?= $this->session->flashdata('error') ?>',
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                });
                                </script>

                                <?php

                                }
                                ?>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>

<?= require_once('components/footer.php') ?>