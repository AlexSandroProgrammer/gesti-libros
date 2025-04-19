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
            <h1 class="page-header">Medicos</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-2 text-left">
                <!-- Botón para abrir el modal -->
                <a href="<?= base_url('form_registrar_medico');?>" class="btn btn-success">
                    <i class="fa fa-plus"></i> Registrar Medico
                </a>
            </div>
            <div class="panel panel-default" style="margin-top: 20px;">
                <div class="panel-heading">
                    Listado de Medicos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper mt-2">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Tipo de Usuario</th>
                                    <th>Estado</th>
                                    <th>Sede perteneciente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($medicos)): ?>
                                <?php foreach ($medicos as $medico): ?>
                                <?php if ($medico !== null): // Comprobar que $medico no sea null ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="<?php echo base_url('medicos/view_editar/'.$medico->documento); ?>"
                                                class="btn btn-primary mx-1 my-2" style="margin-bottom: 5px;">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                            <a href="<?php echo base_url('medicos/delete/'.$medico->documento); ?>"
                                                class="btn btn-danger mx-1"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este medico?');">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                    <td><?= isset($medico->documento) ? $medico->documento : 'N/A'; ?></td>
                                    <td><?= isset($medico->names) ? $medico->names : 'N/A'; ?></td>
                                    <td><?= isset($medico->surnames) ? $medico->surnames : 'N/A'; ?></td>
                                    <td><?= isset($medico->email) ? $medico->email : 'N/A'; ?></td>
                                    <td><?= isset($medico->tipo_usuario) ? $medico->tipo_usuario : 'N/A'; ?></td>
                                    <td><?= isset($medico->estado) ? $medico->estado : 'N/A'; ?></td>
                                    <td><?= isset($medico->nombre_sede) ? $medico->nombre_sede : 'N/A'; ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr class="text-center">
                                    <td colspan="7">No hay médicos registrados.</td>
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