<?= require_once('components/sidebar.php') ?>

<!-- mostrar la notificacion de registro exitoso -->
<?php
if ($this->session->flashdata('success')) {                        
?>
<script>
Swal.fire({
    title: 'Perfecto!',
    text: '<?= $this->session->flashdata('success')?>',
    icon: 'success',
    confirmButtonText: 'Aceptar'
});
</script>
<?php                            
}
?>

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
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Estados</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- Modal -->
        <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Registrar Estado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario dentro del modal -->
                        <form action="<?= base_url('estados/register') ?>" method="post">
                            <div class="form-group">
                                <label for="estado">Nombre del Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" required>
                            </div>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mb-2 text-left">
                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal">
                    <i class="fa fa-plus"></i> Registrar
                </button>
            </div>
            <div class="panel panel-default" style="margin-top: 20px;">
                <div class="panel-heading">
                    Listado de Estados
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper mt-2">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre de Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($estados)): ?>
                                <?php foreach ($estados as $estado): ?>
                                <tr>
                                    <td><?php echo $estado->id_estado; ?></td>
                                    <td><?php echo $estado->estado; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr class="text-center">
                                    <td colspan="4">No hay estados registradas.</td>
                                    <!-- Actualizado para la nueva columna -->
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>


<?= require_once('components/footer.php') ?>