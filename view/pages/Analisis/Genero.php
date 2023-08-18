<?php
$generos = ControladorAnalisis::genero();

// Obtén los totales de género para cada empresa
$empresas = array();
$masculinos = array();
$femeninos = array();

foreach ($generos as $genero) {
    $empresa = $genero['Empresa'];
    $generoLabel = $genero['Género'];
    $totalEmpleados = $genero['Total_de_Empleados'];

    if (!isset($empresas[$empresa])) {
        $empresas[$empresa] = array();
    }

    if ($generoLabel === 'Masculino') {
        $masculinos[$empresa] = $totalEmpleados;
    } elseif ($generoLabel === 'Femenino') {
        $femeninos[$empresa] = $totalEmpleados;
    }
}

?>

<style>
    #generosChart {
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
<div class="container-fluid dashboard-content">
    <div class="card col-12 p-4 row">
        <h3>Gráfico de Diversidad e Inclusión de Género</h3>
        <div class="col-12">
            <center>
                <div class="card">
                    <div class="card-body" style="max-height:400px">
                        <canvas id="generosChart">
                            <p>Diversidad e Inclusión de Género</p>
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
						<th>Género</th>
						<th>Total de Empleados</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($generos as $genero): ?>
						<tr>
							<td><?php echo $genero['Empresa'] ?></td>
							<td><?php echo $genero['Género'] ?></td>
							<td><?php echo $genero['Total_de_Empleados'] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('generosChart');

    function actualizarGrafico(masculinos, femeninos) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(masculinos),
                datasets: [{
                    label: 'Masculino',
                    data: Object.values(masculinos),
                    backgroundColor: 'rgba(52, 152, 219, 0.8)', // Azul con 80% de opacidad
                    borderRadius: 5,
                    borderWidth: 1
                },
                {
                    label: 'Femenino',
                    data: Object.values(femeninos),
                    backgroundColor: 'rgba(231, 76, 60, 0.8)',  // Rojo con 80% de opacidad
                    borderRadius: 5,
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Diversidad e Inclusión de Género',
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
            }
        });
    }

    // Llamada AJAX para obtener datos y actualizar el gráfico
    actualizarGrafico(<?php echo json_encode($masculinos); ?>, <?php echo json_encode($femeninos); ?>);
</script>
