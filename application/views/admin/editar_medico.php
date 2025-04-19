<?= require_once('components/sidebar.php') ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar datos de <?= $medico_edit->names ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ingresar por favor los datos del medico
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="<?= base_url('medicos/actualizar') ?>">
                                <div class="form-group">
                                    <label>Documento</label>
                                    <input type="number" class="form-control" readonly
                                        value="<?= $medico_edit->documento ?>" required name="documento" minlength="6"
                                        maxlength="10" placeholder="Ingresar numero de documento del medico">
                                </div>
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input type="text" class="form-control" value="<?= $medico_edit->names ?>"
                                        name="names" autofocus required placeholder="Ingresar nombre del medico">
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" value="<?= $medico_edit->surnames ?>"
                                        name="surnames" required placeholder="Ingresar apellidos del medico">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="<?= $medico_edit->email ?>" required
                                        placeholder="Ingresar email del medico">
                                </div>
                                <div class="form-group">
                                    <label>Sede A la cual pertenece</label>
                                    <select class="form-control" name="id_sede" required>
                                        <option value=" <?= $medico_edit->id_sede ?>">Sede Actual:
                                            <?= $medico_edit->nombre_sede ?>
                                        </option>

                                        <?php if (!empty($sedes)): ?>
                                        <?php foreach ($sedes as $sede): ?>
                                        <option value="<?= $sede->id_sede ?>"><?= $sede->nombre_sede ?></option>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <option value="">No hay estados registrados.</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="id_type_user" required value="2">
                                <div class="form-group">
                                    <label>Tipo de Estado</label>
                                    <select class="form-control" name="id_state" required>
                                        <option value="<?= $medico_edit->id_estado ?>">Estado Actual:
                                            <?= $medico_edit->estado ?> </option>

                                        <?php if (!empty($estados)): ?>
                                        <?php foreach ($estados as $estado): ?>
                                        <option value="<?= $estado->id_estado ?>"><?= $estado->estado ?></option>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <option value="">No hay estados registrados.</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="<?= base_url('medicos');?>" class="btn btn-danger">
                                    Regresar
                                </a>
                                <?php
                                    if ($this->session->flashdata('error')) {                        
                                    ?>
                                <script>
                                Swal.fire({
                                    title: 'Error!',
                                    text: '<?= $this->session->flashdata('error')?>',
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