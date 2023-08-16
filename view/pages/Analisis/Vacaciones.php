<?php $vacaciones = ControladorAnalisis::vacaciones(); ?>
<div class="container-fluid dashboard-content ">
	<div class="card col-12 p-4 row">
		<h3>Tabla de Datos de Vacaciones</h3>
		<div class="col-12">
			<center>
				<div class="card">
					<div class="card-body" style="max-height:400px">
						<canvas id="myChart">
							<p>Vacaciones</p>
						</canvas>
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

    function actualizarGrafico(data) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Aceptados', 'Rechazados', 'Pendientes'],
                datasets: [{
                    label: '# of Votes',
                    data: data,
                    backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
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
                    tooltip: {}
                }
            }
        });
    }

    // Llamada AJAX para obtener datos y actualizar el gráfico
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajax/vacaciones.contador.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const responseData = JSON.parse(xhr.responseText);
                const data = [responseData.Aprobados, responseData.Rechazados, responseData.Pendientes];
                actualizarGrafico(data);
            } else {
                console.error('Error en la solicitud AJAX');
            }
        }
    };
    xhr.send();
</script>