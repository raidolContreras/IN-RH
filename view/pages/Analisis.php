<?php $empleados = ControladorEmpleados::ctrVerEmpleados(null, null) ?>
<section class="dashboard-content">
	<div class="container">
		<div class="card rounded-card">
			<header class="card-header">
				<h2 class="m-0">Análisis e Informes de Recursos Humanos</h2>
			</header>
		</div>
		<div class="card p-4">
			<section class="row">
				<article class="col-md-6">
					<div class="analysis-item">
						<h3>Informe de Empleados</h3>
						<p>Resumen detallado de la información clave de los empleados.</p>
						<a href="#" class="btn btn-primary">Ver Informe</a>
					</div>
				</article>
				<article class="col-md-6">
					<div class="analysis-item">
						<h3>Informe de Vacaciones</h3>
						<p>Seguimiento de las solicitudes y aprobaciones de vacaciones.</p>
						<a href="Analisis-Vacaciones" class="btn btn-primary">Ver Informe</a>
					</div>
				</article>
			</section>
		</div>
	</div>
</section>