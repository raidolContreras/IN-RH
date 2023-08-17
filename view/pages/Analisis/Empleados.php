<?php $empleados = ControladorAnalisis::empleados(); ?>

<div class="container-fluid dashboard-content ">
	<div class="card col-12 p-4 row">
		<h3>Tabla de Datos de Empleados</h3>
		<div class="col-12">
			<center>
				<div class="card">
					<div class="card-body" style="max-height:400px">
						<canvas id="myChart">
							<p>Empresas</p>
						</canvas>
					</div>
				</div>
			</center>
		</div>
		<div class="table-responsive">
			<table id="example" class="table table-bordered table-striped vacaciones-table analisis">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Género</th>
						<th>Fecha de Nac.</th>
						<th>Teléfono</th>
						<th>Salario</th>
						<th>Puesto</th>
						<th>Departamento</th>
						<th>Empresa</th>
						<th>Años Trabajados</th>
						<th>Fecha de Ingreso</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($empleados as $empleado): ?>
						<tr>
							<td><?php echo ucwords(mb_strtolower($empleado['nombre'])) ?></td>
							<td><?php echo $empleado['Género'] ?></td>
							<td><?php echo $empleado['Fecha_de_Nacimiento'] ?></td>
							<td><?php echo $empleado['Teléfono'] ?></td>
							<td><?php echo ControladorFormularios::formatearNumero($empleado['Salario'], "MXN") ?></td>
							<td><?php echo $empleado['Puesto'] ?></td>
							<td><?php echo $empleado['Departamento'] ?></td>
							<td><?php echo $empleado['Empresa'] ?></td>
							<td><?php echo $empleado['Años_Trabajados'] ?></td>
							<td><?php echo $empleado['Fecha_de_Ingreso'] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Tu HTML existente ... -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    #myChart {
        width: 100%;
        max-height: 800px;
    }
</style>

<script>
    const ctx = document.getElementById('myChart');

    function actualizarGrafico(data) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(item => item.Empresa),
                datasets: [{
                    label: 'Total de Empleados',
                    data: data.map(item => item.Total_de_Empleados),
                    backgroundColor: 'rgba(63, 103, 126, 0.7)',
                    hoverBackgroundColor: 'rgba(63, 103, 126, 1)',
                    borderWidth: 0,
                    borderRadius: 5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Total de Empleados por Empresa',
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
                    tooltip: {
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
                        },
                        ticks: {
                            font: {
                                size: 12,
                                family: 'Arial, sans-serif'
                            },
                            color: 'rgba(0, 0, 0, 0.6)'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)',
                            lineWidth: 1,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                family: 'Arial, sans-serif'
                            },
                            color: 'rgba(0, 0, 0, 0.6)'
                        }
                    }
                }
            }
        });
    }

    // Llamada AJAX para obtener datos y actualizar el gráfico
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajax/empleados.contador.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const responseData = JSON.parse(xhr.responseText);
                actualizarGrafico(responseData);
            } else {
                console.error('Error en la solicitud AJAX');
            }
        }
    };
    xhr.send();
</script>

<!-- Resto de tu HTML existente ... -->
