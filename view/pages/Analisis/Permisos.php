<?php if (!empty($rol) && $rol['Ver_Analisis'] == 1): ?>
<?php $permisos = ControladorAnalisis::permisos(); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
	#myPermisosChart {
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
		<h3 class="mb-4">Tabla de Datos de Permisos</h3>
		<div class="col-12">
			<center>
				<div class="card permisos-card">
					<div class="card-body">
						<canvas id="myPermisosChart"></canvas>
					</div>
				</div>
			</center>
		</div>
		<div class="table-responsive">
			<table id="example" class="table table-bordered table-striped vacaciones-table analisis">
				<thead>
					<tr>
						<th>Empleado</th>
						<th>Fecha de inicio</th>
						<th>Fecha de fin</th>
						<th>Fecha de la solicitud</th>
						<th>Tipo de permiso</th>
						<th>Descripción</th>
						<th>Estado</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($permisos as $permiso): ?>
						<tr>
							<td><?php echo $permiso['nombre'] ?></td>
							<td><?php echo $permiso['FechaPermiso'] ?></td>
							<td><?php echo $permiso['FechaFin'] ?></td>
							<td><?php echo $permiso['FechaHoraSolicitud'] ?></td>
							<td><?php echo $permiso['TipoPermiso'] ?></td>
							<td><?php echo $permiso['Descripcion'] ?></td>
							<td><?php echo $permiso['EstadoPermiso'] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	const ctxPermisos = document.getElementById('myPermisosChart');

	function actualizarGraficoPermisos(data) {
		new Chart(ctxPermisos, {
			type: 'bar',
			data: {
				labels: ['Aceptados', 'Rechazados', 'Pendientes'],
				datasets: [{
					label: 'Total de Peticiones',
					data: data,backgroundColor: [
						'rgba(52, 152, 219, 0.8)', // Azul con 80% de opacidad
						'rgba(231, 76, 60, 0.8)',  // Rojo con 80% de opacidad
						'rgba(243, 156, 18, 0.8)'  // Amarillo con 80% de opacidad
					],
					hoverBackgroundColor: ['#217AB6', '#C53E30', '#C9851A'],
					borderRadius: 5,
					borderWidth: 1
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
						text: 'Estado de Permisos',
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

	// Llamada AJAX para obtener datos y actualizar el gráfico de permisos
	const xhrPermisos = new XMLHttpRequest();
	xhrPermisos.open('GET', 'ajax/permisos.contador.php', true);
	xhrPermisos.onreadystatechange = function () {
		if (xhrPermisos.readyState === XMLHttpRequest.DONE) {
			if (xhrPermisos.status === 200) {
				const responseDataPermisos = JSON.parse(xhrPermisos.responseText);
				const dataPermisos = [responseDataPermisos.Aprobados, responseDataPermisos.Rechazados, responseDataPermisos.Pendientes];
				actualizarGraficoPermisos(dataPermisos);
			} else {
				console.error('Error en la solicitud AJAX');
			}
		}
	};
	xhrPermisos.send();
</script>
<?php else: ?>
	<script>
		window.location.href = 'Inicio';
	</script>
<?php endif ?>