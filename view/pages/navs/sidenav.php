<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar">
	<div class="menu-list pt-2">
		<nav class="navbar navbar-expand-lg sidebar-dark">
			<a class="d-xl-none d-lg-none" href="#"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fas fa-bars"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav flex-column">
					<?php if (!empty($rol) && $rol['Ver_Empleados'] == 1) : ?>
					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Empleados', 'Departamento', 'Nominas', 'Organigrama','RegistroEmpleados'))): ?>
							<a class="nav-link active" href="Empleados">
						<?php else: ?>
							<a class="nav-link" href="Empleados">
						<?php endif ?>
						<i class="fa fa-users"></i>EMPLEADOS</a>
					</li>
					<?php endif ?>

					<?php if (!empty($rol) && $rol['Ver_Reclutamiento'] == 1) : ?>
					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Vacantes', 'Talento'))): ?>
							<a class="nav-link active" href="Vacantes">
						<?php else: ?>
							<a class="nav-link" href="Vacantes">
						<?php endif ?>
						<i class="fa fa-bullhorn"></i>RECLUTAMIENTO</a>
					</li>
					<?php endif ?>

					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Asistencia', 'Asistencia-resumen', 'Asistencia-ajustes'))): ?>
							<a class="nav-link active" href="Asistencia">
						<?php else: ?>
							<a class="nav-link" href="Asistencia">
						<?php endif ?>
							<i class="fas fa-pencil-alt"></i>REGISTRO DE HORAS</a>
					</li>
					
					<?php if (!empty($rol) && $rol['Ver_Tareas'] == 1) : ?>
					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Tareas', 'Tareas-ajustes'))): ?>
							<a class="nav-link active" href="Tareas">
						<?php else: ?>
							<a class="nav-link" href="Tareas">
						<?php endif ?>
						<i class="fa fa-tasks"></i>TAREAS</a>
					</li>
					<?php endif ?>

					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Evaluaciones', 'Preguntas', 'Evaluaciones_Asignadas', 'Examen', 'AddEmpleados', 'crearEvaluacion', 'eliminarExamen'))): ?>
							<a class="nav-link active" href="Evaluaciones">
						<?php else: ?>
							<a class="nav-link" href="Evaluaciones">
						<?php endif ?>
						<i class="far fa-star"></i>EVALUACIONES</a>
					</li>

					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Gastos'))): ?>
							<a class="nav-link active" href="Gastos">
						<?php else: ?>
							<a class="nav-link" href="Gastos">
						<?php endif ?>
						<i class="fas fa-money-bill-alt"></i>GASTOS</a>
					</li>

					<?php if (!empty($rol) && $rol['Ver_Analisis'] == 1) : ?>
					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Analisis'))): ?>
							<a class="nav-link active" href="Analisis">
						<?php else: ?>
							<a class="nav-link" href="Analisis">
						<?php endif ?>
						<i class="fas fa-chart-bar"></i>ANALISÍS E INFORMES</a>
					</li>
					<?php endif ?>
					<?php if (empty($rol) || $rol['Ver_Empleados'] == 0) : ?>
					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Organigrama'))): ?>
							<a class="nav-link active" href="Organigrama">
						<?php else: ?>
							<a class="nav-link" href="Organigrama">
						<?php endif ?>
						<i class="fa fa-users"></i>ORGANIGRAMA</a>
					</li>
					<?php endif ?>

					<li class="nav-item">
						<a class="nav-link" href="https://contreras-flota.click/moodle/" target="_blank"><i class="fa fa-graduation-cap"></i>CURSOS Y CAPACITACIONES</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
		<!-- wrapper  -->
		<!-- ============================================================== -->
		<div class="dashboard-wrapper">
		<div class="dashboard-ecommerce">