</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>">
</script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js') ?>">
</script>
<!-- DataTables Bootstrap CSS -->
<script src="<?= base_url('assets/bower_components/datatables/media/js/jquery.dataTables.min.js') ?>">
</script>
<script
    src="<?= base_url('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') ?>">
</script>


<!-- Custom Theme JavaScript -->
<script src=" <?= base_url('assets/dist/js/sb-admin-2.js') ?>"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener datos desde PHP
    const datosChart = <?php echo $datos_chart; ?>;
    const datosArea = <?php echo $datos_grafico_area; ?>;
    const datosMedicos = <?php echo json_encode($datosMedicosDivEstYSede); ?>;
    console.log(datosMedicos);
    // Crear el gráfico
    Highcharts.chart('container_chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Gráfico de Modelos'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Cantidad'
            }
        },
        series: [{
            name: 'Cantidad de Registros',
            data: datosChart
        }]
    });

    // Crear el gráfico de tipo variable radius pie
    Highcharts.chart('container_radius_pie', {
        chart: {
            type: 'variablepie'
        },
        title: {
            text: 'Estadisticas medicos por Sede'
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><br>',
            pointFormat: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'
        },
        series: [{
            name: 'Cantidad',
            minPointSize: 10,
            innerSize: '20%',
            zMin: 0,
            data: datosArea
        }]
    });

    // Organizar datos para Highcharts
    const seriesData = {};
    datosMedicos.forEach(fila => {
        const sede = fila.nombre_sede;
        const estado = fila.estado;
        const cantidad = parseInt(fila.cantidad_medicos);

        if (!seriesData[estado]) {
            seriesData[estado] = [];
        }

        seriesData[estado].push({
            name: sede,
            y: cantidad
        });
    });

    // Convertir seriesData en formato para Highcharts
    const series = [];
    for (let estado in seriesData) {
        series.push({
            name: estado,
            data: seriesData[estado]
        });
    }

    // Crear el gráfico de barras
    Highcharts.chart('container_basic_bar', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Cantidad de Médicos por Sede y Estado'
        },
        xAxis: {
            type: 'category',
            title: {
                text: 'Sedes'
            }
        },
        yAxis: {
            title: {
                text: 'Cantidad de Médicos'
            }
        },
        series: series
    });
});
</script>

</body>

</html>