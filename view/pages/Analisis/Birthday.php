<div class="container-fluid dashboard-content">
	<div class="card col-12 p-4 row">
<?php if (isset($_GET['empresa'])): 

$birthdays = ControladorAnalisis::birthday($_GET['empresa']);
$birthdayContador = ControladorAnalisis::birthdayContador($_GET['empresa']);
$meses = array(
	"01" => "Enero",
	"02" => "Febrero",
	"03" => "Marzo",
	"04" => "Abril",
	"05" => "Mayo",
	"06" => "Junio",
	"07" => "Julio",
	"08" => "Agosto",
	"09" => "Septiembre",
	"10" => "Octubre",
	"11" => "Noviembre",
	"12" => "Diciembre"
);
$cumple = array();
foreach ($birthdayContador as $birthday) {
	$mes = $meses[$birthday['Mes']];
	$cantidad = $birthday['Cantidad_de_Empleados'];

	if (!isset($cumple[$mes])) {
		$cumple[$mes] = $cantidad;
	}
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
	#birthdayChart {
		width: 100%;
		max-height: 300px;
	}

	.birthday-card {
		background-color: #ffffff;
		border: 1px solid #e0e0e0;
		border-radius: 10px;
		padding: 20px;
		margin-top: 20px;
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
	}

	.birthday-table {
		margin-top: 20px;
		width: 100%;
		border-collapse: collapse;
	}

	.birthday-table th,
	.birthday-table td {
		padding: 12px;
		text-align: center;
	}

	.birthday-table th {
		background-color: #f2f2f2;
		font-weight: bold;
	}

	.birthday-table tr:nth-child(even) {
		background-color: #f9f9f9;
	}
</style>

		<h3 class="mb-4">Tabla de Datos de Cumpleaños</h3>
		<div class="col-12">
			<center>
				<div class="card birthday-card">
					<div class="card-body">
						<canvas id="birthdayChart"></canvas>
					</div>
				</div>
			</center>
		</div>
		<div class="table-responsive">
			<table id="example" class="table table-bordered table-striped vacaciones-table analisis">
				<thead>
					<tr>
						<th>Empleado</th>
						<th>Fecha de Cumpleaños</th>
						<th>Edad</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($birthdays as $birthday): ?>
						<tr>
							<td><?php echo $birthday['nombre'] ?></td>
							<td><?php echo $birthday['Fecha_de_Cumpleaños'] ?></td>
							<td><?php echo ControladorFormularios::calcularEdad($birthday['fNac']) ?> años</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>

<script>
	const ctx = document.getElementById('birthdayChart');

function actualizarGrafico(cumple) {
    const meses = Object.keys(cumple); // Obtener los nombres de los meses
    const cantidades = Object.values(cumple); // Obtener las cantidades

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: meses, // Usar los nombres de los meses como etiquetas en el datalabel
            datasets: [{
                label: 'Cumpleaños',
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
                    text: 'Registro de Cumpleaños',
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
                        stepSize: 1,
                        precision: 0,
                    }
                }
            }
        }
    });
}

// Llamada AJAX para obtener datos y actualizar el gráfico
actualizarGrafico(<?php echo json_encode($cumple); ?>);

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
							<td><a class="btn btn-in-consulting" href="Analisis-Birthday&empresa=<?php echo $empresa['idEmpresas'] ?>">
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