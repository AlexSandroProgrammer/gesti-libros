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
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sedes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-2 text-left">
                <a href="<?= base_url('form_registrar_sede');?>" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                    Agregar Sede
                </a>
            </div>
            <div class="panel panel-default" style="margin-top: 20px;">
                <div class="panel-heading">
                    Listado de Sedes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper mt-2">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Nombre de Sede</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sedes)): ?>
                                <?php foreach ($sedes as $sede): ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="<?php echo base_url('sedes/view_editar/'.$sede->id_sede); ?>"
                                                class="btn btn-primary mx-1">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                            <a href="<?php echo base_url('sedes/delete/'.$sede->id_sede); ?>"
                                                class="btn btn-danger mx-1"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta sede?');">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo $sede->nombre_sede; ?></td>
                                    <td><?php echo $sede->direccion; ?></td>
                                    <td><?php echo $sede->telefono; ?></td>
                                </tr>

                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr class="text-center">
                                    <td colspan="4">No hay sedes registradas.</td>
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