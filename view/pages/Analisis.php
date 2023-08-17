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
						<a href="Analisis-Empleados" class="btn btn-primary">Ver Informe</a>
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
			<section class="row mt-3">
				<article class="col-md-6">
					<div class="analysis-item">
						<h3>Informe de Permisos</h3>
						<p>Seguimiento de las solicitudes y aprobaciones de permisos.</p>
						<a href="Analisis-Permisos" class="btn btn-primary">Ver Informe</a>
					</div>
				</article>
				<article class="col-md-6">
					<div class="analysis-item">
						<h3>Informe de Asistencias</h3>
						<p>Informe de las asistencias de los empleados.</p>
						<a href="Analisis-Asistencias" class="btn btn-primary">Ver Informe</a>
					</div>
				</article>
			</section>
			<section class="row mt-3">
				<article class="col-md-6">
					<div class="analysis-item">
						<h3>Informe de Gastos por Empleados</h3>
						<p>Relación entre la categoría de gasto y los empleados.</p>
						<a href="Analisis-EmpleadoGastos" class="btn btn-primary">Ver Informe</a>
					</div>
				</article>
				<article class="col-md-6">
					<div class="analysis-item">
						<h3>Informe de Diversidad e Inclusión</h3>
						<p>Distribución de empleados por género y departamento.</p>
						<a href="Analisis-Genero" class="btn btn-primary">Ver Informe</a>
					</div>
				</article>
			</section>
			<section class="row mt-3">
				<article class="col-md-6">
					<div class="analysis-item">
						<h3>Análisis de Distribución de Edades</h3>
						<p>Distribución de edades de los empleados.</p>
						<a href="Analisis-Edades" class="btn btn-primary">Ver Informe</a>
					</div>
				</article>
			</section>
		</div>
	</div>
</section>