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
					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Empleados', 'Departamento', 'Nominas', 'Organigrama','RegistroEmpleados'))): ?>
							<a class="nav-link active" href="Empleados">
						<?php else: ?>
							<a class="nav-link" href="Empleados">
						<?php endif ?>
						<i class="fa fa-users"></i>EMPLEADOS</a>
					</li>

					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Vacantes', 'Talento'))): ?>
							<a class="nav-link active" href="Vacantes">
						<?php else: ?>
							<a class="nav-link" href="Vacantes">
						<?php endif ?>
						<i class="fa fa-bullhorn"></i>RECLUTAMIENTO</a>
					</li>

					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Asistencia', 'Asistencia-resumen', 'Asistencia-ajustes'))): ?>
							<a class="nav-link active" href="Asistencia">
						<?php else: ?>
							<a class="nav-link" href="Asistencia">
						<?php endif ?>
							<i class="fas fa-pencil-alt"></i>REGISTRO DE HORAS</a>
					</li>

					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Tareas', 'Tareas-ajustes'))): ?>
							<a class="nav-link active" href="Tareas">
						<?php else: ?>
							<a class="nav-link" href="Tareas">
						<?php endif ?>
						<i class="fa fa-tasks"></i>TAREAS</a>
					</li>

					<li class="nav-item">
						<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Evaluaciones', 'Preguntas'))): ?>
							<a class="nav-link active" href="Evaluaciones">
						<?php else: ?>
							<a class="nav-link" href="Evaluaciones">
						<?php endif ?>
						<i class="far fa-star"></i>EVALUACIONES</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#"><i class="fas fa-money-bill-alt"></i>GASTOS</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#"><i class="fas fa-chart-bar"></i>ANALISÍS E INFORMES</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#"><i class="fa fa-graduation-cap"></i>CURSOS Y CAPACITACIONES</a>
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