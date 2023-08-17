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
			<table class="table table-bordered">
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
							<td><?php echo $empleado['Salario'] ?></td>
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
        height: 100vh;
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
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderWidth: 2,
                    borderColor: 'rgba(0, 0, 0, 0.6)',
                    borderRadius: 10,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 20,
                        bottom: 20
                    }
                },
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
                            weight: 'bold'
                        },
                        color: 'rgba(0, 0, 0, 0.8)'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        bodyFont: {
                            size: 16,
                            weight: 'bold'
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
                                size: 14,
                                weight: 'bold'
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
                                size: 14,
                                weight: 'bold'
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
