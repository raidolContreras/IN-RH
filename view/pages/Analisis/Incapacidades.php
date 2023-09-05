<?php if (!empty($rol) && $rol['Ver_Analisis'] == 1): ?>
<div class="container-fluid dashboard-content">
	<div class="card col-12 p-4 row">
<?php

$ramo = array(
	1 => "Riesgos de trabajo",
	2 => "Enfermedad General",
	3 => "Maternidad",
	4 => "Licencia 140 Bis"
);
$riesgo = array(
	1 => "Accidente de Trabajo",
	2 => "Accidente de Trayecto",
	3 => "Enfermedad Profesional"
);
$control = array(
	1 => "Unica",
	2 => "Inicial",
	3 => "Subsecuente",
	4 => "Alta Medica o ST-2"
);

if (isset($_GET['empresa'])): 
	$incapacidades = ControladorAnalisis::incapacidad($_GET['empresa']);
	$incapacidadContador = ControladorAnalisis::incapacidadContador($_GET['empresa']);

	$ramo_seguro = array(
		"Riesgos de trabajo" => "Riesgos de trabajo",
		"Enfermedad General" => "Enfermedad General",
		"Maternidad" => "Maternidad",
		"Licencia 140 Bis" => "Licencia 140 Bis"
	);
	$incapacidadT = array();
	foreach ($incapacidadContador as $incapacidadC) {
		$tipo_incapacidad = $ramo_seguro[$incapacidadC['Tipo_Incapacidad']];
		$cantidad = $incapacidadC['Total'];

		if (!isset($incapacidadT[$tipo_incapacidad])) {
			$incapacidadT[$tipo_incapacidad] = $cantidad;
		}
	}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
	#contratoChart {
		width: 100%;
		max-height: 300px;
	}

	.contrato-card {
		background-color: #ffffff;
		border: 1px solid #e0e0e0;
		border-radius: 10px;
		padding: 20px;
		margin-top: 20px;
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
	}

	.contrato-table {
		margin-top: 20px;
		width: 100%;
		border-collapse: collapse;
	}

	.contrato-table th,
	.contrato-table td {
		padding: 12px;
		text-align: center;
	}

	.contrato-table th {
		background-color: #f2f2f2;
		font-weight: bold;
	}

	.contrato-table tr:nth-child(even) {
		background-color: #f9f9f9;
	}
</style>

		<h3 class="mb-4">Tabla de Datos de Incapacidades</h3>
		<div class="col-12">
			<center>
				<div class="card contrato-card">
					<div class="card-body">
						<canvas id="contratoChart"></canvas>
					</div>
				</div>
			</center>
		</div>
		<div class="table-responsive">
			<table id="example" class="table table-bordered table-striped vacaciones-table analisis">
				<thead>
					<tr>
						<th>Folio</th>
						<th>Empleado</th>
						<th>Ramo del seguro</th>
						<th>Tipo de riesgo</th>
						<th>Secuela por consecuencia</th>
						<th>Control</th>
						<th>Fecha de Inicio</th>
						<th>Fecha de Termino</th>
						<th>Porcentaje</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($incapacidades as $incapacidad): ?>
						<tr>
							<td><?php echo $incapacidad['folio'] ?></td>
							<td><?php echo $incapacidad['nombre'] ?></td>
							<td><?php echo $ramo[$incapacidad['ramo_seguro']] ?></td>
							<?php if ($incapacidad['tipo_riesgo'] != ""): ?>
							<td><?php echo $riesgo[$incapacidad['tipo_riesgo']] ?></td>
							<td><?php echo $incapacidad['secuela_consecuencia'] ?></td>
							<?php else: ?>
							<td>-</td>
							<td>-</td>
							<?php endif ?>
							<td><?php echo $control[$incapacidad['control_incapacidad']] ?></td>
							<td><?php echo date("d/m/Y", strtotime($incapacidad['fecha_inicio'])) ?></td>
							<td><?php echo date("d/m/Y", strtotime($incapacidad['fecha_termino'])) ?></td>
							<td><?php echo $incapacidad['porcentaje'] ?> %</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	const ctx = document.getElementById('contratoChart');

function actualizarGrafico(contratos) {
	const contrato = Object.keys(contratos); // Obtener los nombres de los contrato
	const cantidades = Object.values(contratos); // Obtener las cantidades

	new Chart(ctx, {
		type: 'bar',
		data: {
			labels: contrato, // Usar los nombres de los meses como etiquetas en el datalabel
			datasets: [{
				label: 'Total de Incapacidades',
				data: cantidades, // Usar las cantidades
				backgroundColor: 'rgba(63, 103, 126, 0.7)',
				hoverBackgroundColor: 'rgba(63, 103, 126, 1)',
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
					text: 'Registro de Incapacidades',
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
actualizarGrafico(<?php echo json_encode($incapacidadT); ?>);

</script>
<?php else: 
	$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
?>
		<h3>Selecciona una empresa</h3>
		<div class="table-responsive">
			<table class="table table-bordered table-striped vacaciones-table analisis">
				<thead>
					<tr>
						<th>Empresa</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($empresas as $empresa):?>
						<tr>
							<td><a class="btn btn-in-consulting" href="Analisis-Incapacidades&empresa=<?php echo $empresa['idEmpresas'] ?>">
								<span><?php echo $empresa['nombre_razon_social'] ?></span>
							</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
<?php endif ?>
	</div>
</div>
<?php else: ?>
	<script>
		window.location.href = 'Inicio';
	</script>
<?php endif ?>