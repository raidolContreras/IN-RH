<?php $vacaciones = ControladorAnalisis::vacaciones(); ?>
<div class="container-fluid dashboard-content ">
	<div class="card col-12 p-4 row">
		<h3>Tabla de Datos de Vacaciones</h3>
		<div class="col-12">
			<center>
				<div class="card">
					<div class="card-body" style="max-height:400px">
						<canvas id="myChart"></canvas>
					</div>
				</div>
			</center>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Empleado</th>
						<th>Fecha inicio</th>
						<th>Fecha de fin</th>
						<th>Fecha de la solicitud</th>
						<th>Estado</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($vacaciones as $vacacion): ?>
						<tr>
							<td><?php echo $vacacion['nombre'] ?></td>
							<td><?php echo $vacacion['fecha_inicio_vacaciones'] ?></td>
							<td><?php echo $vacacion['fecha_fin_vacaciones'] ?></td>
							<td><?php echo $vacacion['fecha_solicitud'] ?></td>
							<td><?php echo $vacacion['Estado'] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Aceptados', 'Rechazado', 'Pendientes'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3]
      }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Vacaciones',
                padding: {
                    top: 10,
                    bottom: 30
                }
            },
            tooltip: {

            }
        }
    }
  });
</script>