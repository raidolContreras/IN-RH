<?php if (!empty($rol) && $rol['Ver_Analisis'] == 1): ?>
<?php $altasBajas = ControladorAnalisis::altasBajas(); 
$altas = array();
$bajas = array();
foreach ($altasBajas as $altaBaja) {
    $empresa = $altaBaja['Empresa'];
    $altaBajaLabel = $altaBaja['Periodo'];
    $totalEmpleadosAltas = $altaBaja['Altas'];
    $totalEmpleadosBajas = $altaBaja['Bajas'];

    if (!isset($empresas[$empresa])) {
        $empresas[$empresa] = array();
    }
    $altas[$empresa] = $totalEmpleadosAltas;
    $bajas[$empresa] = $totalEmpleadosBajas;
}
?>
<!-- Tu HTML existente ... -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    #altasBajasChart {
        width: 100%;
        max-height: 300px;
    }

    .altasBajas-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .altasBajas-table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    .altasBajas-table th,
    .altasBajas-table td {
        padding: 12px;
        text-align: center;
    }

    .altasBajas-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .altasBajas-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<div class="container-fluid dashboard-content">
    <div class="card col-12 p-4 row">
        <h3 class="mb-4">Tabla de Datos de Altas y Bajas</h3>
        <div class="col-12">
            <center>
                <div class="card altasBajas-card">
                    <div class="card-body">
                        <canvas id="altasBajasChart"></canvas>
                    </div>
                </div>
            </center>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped vacaciones-table analisis">
                <thead>
                    <tr>
                        <th>PERIODO</th>
                        <th>EMPRESA</th>
                        <th>ALTAS</th>
                        <th>BAJAS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($altasBajas as $permiso): ?>
                        <tr>
                            <td><?php echo $permiso['Periodo'] ?></td>
                            <td><?php echo $permiso['Empresa'] ?></td>
                            <td><?php echo $permiso['Altas'] ?></td>
                            <td><?php echo $permiso['Bajas'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('altasBajasChart');

    function actualizarGrafico(altas, bajas) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(altas),
                datasets: [{
                    label: 'Altas',
                    data: Object.values(altas),
                    backgroundColor: 'rgba(52, 152, 219, 0.8)', // Azul con 80% de opacidad
                    borderRadius: 5,
                    borderWidth: 1
                },
                {
                    label: 'Bajas',
                    data: Object.values(bajas),
                    backgroundColor: 'rgba(231, 76, 60, 0.8)',  // Rojo con 80% de opacidad
                    borderRadius: 5,
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Registro de Altas y bajas',
                        padding: {
                            top: 20,
                            bottom: 20
                        },
                        font: {
                            size: 24,
                            weight: 'bold',
                            family: 'Arial, sans-serif'
                        },
                        color: 'rgba(0, 0, 0, 0.8)'
                    },
                    tooltips: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        bodyFont: {
                            size: 14,
                            weight: 'bold',
                            family: 'Arial, sans-serif'
                        },
                        titleFont: {
                            size: 16,
                            weight: 'bold',
                            family: 'Arial, sans-serif'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e0e0e0'
                        },
                        ticks: {
                            stepSize: 1, // Aquí ajustamos el paso a 1 para mostrar solo números enteros
                            precision: 0 // Aquí establecemos la precisión en 0 para evitar decimales
                        }
                    }
                }
            }
        });
    }

    // Llamada AJAX para obtener datos y actualizar el gráfico
    actualizarGrafico(<?php echo json_encode($altas); ?>, <?php echo json_encode($bajas); ?>);
</script>
<?php else: ?>
    <script>
        window.location.href = 'Inicio';
    </script>
<?php endif ?>