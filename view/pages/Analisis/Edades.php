<?php if (!empty($rol) && $rol['Ver_Analisis'] == 1): ?>
<?php 
$edades = ControladorAnalisis::edad();
$labels = ['Menores de 18', '18 a 25', '26 a 35', '36 a 45', '46 a 55', '55+'];
$data = [];
$empresa = [];

foreach ($edades as $edad) {
    $data[] = [
        $edad['Menores_de_18'],
        $edad['Edad_18_25'],
        $edad['Edad_26_35'],
        $edad['Edad_36_45'],
        $edad['Edad_46_55'],
        $edad['Edad_55_Plus'],
    ];
    $empresa[] = [
    	$edad['Empresa']
    ];
} ?>

<style>
    #edadesChart {
        width: 100%;
        max-height: 300px;
    }

    .permisos-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .permisos-table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    .permisos-table th,
    .permisos-table td {
        padding: 12px;
        text-align: center;
    }

    .permisos-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .permisos-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
<div class="container-fluid dashboard-content ">
    <div class="card col-12 p-4 row">
        <h3>Tabla de Distribución de Edades</h3>
        <div class="col-12">
            <center>
                <div class="card">
                    <div class="card-body" style="max-height:400px">
                        <canvas id="edadesChart">
                        </canvas>
                    </div>
                </div>
            </center>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped vacaciones-table analisis">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <?php foreach ($labels as $label): ?>
                            <th><?php echo $label; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($edades as $i => $edad): ?>
                        <tr>
                            <td><?php echo $edad['Empresa'] ?></td>
                            <?php foreach ($data as $ages): ?>
                                <td><?php echo $ages[$i]; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('edadesChart');
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($data); ?>;
    const empresa = <?php echo json_encode($empresa); ?>;

    function actualizarGrafico(data, empresa) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: data.map((values, index) => ({
                    label: empresa[index],
                    data: values,
                    backgroundColor: [
                    	'rgba(40, 167, 69, 0.8)',
                    	'rgba(220, 53, 69, 0.8)',
                    	'rgba(255, 193, 7, 0.8)',
                    	'rgba(0, 123, 255, 0.8)',
                    	'rgba(23, 162, 184, 0.8)',
                    	'rgba(108, 117, 125, 0.8)'
	                ],
                    borderRadius: 5,
                    borderWidth: 1
                })),
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribución de edades',
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

    actualizarGrafico(data,empresa);
</script>
<?php else: ?>
    <script>
        window.location.href = 'Inicio';
    </script>
<?php endif ?>