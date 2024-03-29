<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<?php $rol = ModeloFormularios::mdlVerRoles("Empleados_idEmpleados", $_SESSION['idEmpleado']); ?>
<div class="dashboard-main-wrapper">
	<?php 
$primerLetra = strtoupper(substr($_SESSION["name"], 0, 1)); // Extrae la primer letra del texto
$segundaLetra = strtoupper(substr($_SESSION["lastname"], 0, 1)); // Extrae la primer letra del texto
$perfil = $primerLetra.$segundaLetra;
?>
<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
<?php $jefeDepartamento = ControladorFormularios::ctrVerDepartamentos("Empleados_idEmpleados", $_SESSION['idEmpleado']) ?>
<div class="dashboard-header">
	<nav class="navbar navbar-expand-lg bg-white fixed-top">
		<!--<img src="assets/images/logo.png" alt="">-->
		<a class="navbar-brand rambla" href="Inicio">HUCCO</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fas fa-bars"></span>
		</button>
		<div class="collapse navbar-collapse " id="navbarSupportedContent">
			<ul class="navbar-nav navbar-left-top">
				<li class="nav-item subtitle-nav"></li>
				<?php if (isset($_GET['pagina'])): ?>
					<?php 

					$paginaActual = $_GET['pagina'];

//Menu de Evaluaciones
					if (!empty($jefeDepartamento)) {
						$gastos = array('Gastos', 'Solicitudes_Gastos');
					}else{
						$gastos = array('Gastos');
					}

					if (!empty($paginaActual) && in_array($paginaActual, $gastos)) {
						foreach ($gastos as $pagina) {
							$activeClass = ($paginaActual == $pagina) ? ' active' : '';
							$marginLeftClass = ($pagina != $gastos[0]) ? ' ml-3' : '';

							echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
							if ($pagina == 'Gastos') {
								echo '<a href="' . $pagina . '"> GASTOS </a>';
							}elseif($pagina == 'Solicitudes_Gastos'){
								echo '<a href="' . $pagina . '"> SOLICITUDES DE GASTOS </a>';
							}else{
								echo '<a href="' . $pagina . '">' . strtoupper(ucfirst($pagina)) . '</a>';
							}
							echo '</li>';
						}
					}

//Menu de horarios
					$Asistencias = array('Asistencia-importar', 'Asistencia-exportar', 'Asistencia-permisos');
					$horarios = array('Asistencia', 'Asistencia-permisos-vacaciones', 'Asistencia-resumen', 'Asistencia-ajustes');

					if (!empty($paginaActual)) {
						if (in_array($paginaActual, $Asistencias)) {
							echo '<li class="nav-item subtitle-nav">';
							echo '<a href="Asistencia"> CALENDARIO </a>';
							echo '</li>';
							echo '<li class="nav-item subtitle-nav ml-3">';
							echo '<a href="Asistencia-permisos-vacaciones"> PERMISOS </a>';
							echo '</li>';
							if (!empty($rol) && $rol['Resumenes_Asistencias'] == 1) {
							echo '<li class="nav-item subtitle-nav ml-3">';
							echo '<a href="Asistencia-resumen"> RESUMEN DE ASISTENCIAS </a>';
							echo '</li>';
							}
							echo '<li class="nav-item subtitle-nav active ml-3">';
							echo '<a href="' . $paginaActual . '"> AJUSTES </a>';
							echo '</li>';
						} elseif (in_array($paginaActual, $horarios)) {
							foreach ($horarios as $pagina) {
								$activeClass = ($paginaActual == $pagina) ? ' active' : '';
								$marginLeftClass = ($pagina != $horarios[0]) ? ' ml-3' : '';

								if ($pagina == 'Asistencia') {
									echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
									echo '<a href="' . $pagina . '"> CALENDARIO </a>';
									echo '</li>';
								} elseif ($pagina == 'Asistencia-resumen' && !empty($rol) && $rol['Resumenes_Asistencias'] == 1) {
									echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
									echo '<a href="' . $pagina . '"> RESUMEN DE ASISTENCIAS </a>';
									echo '</li>';
								} elseif ($pagina == 'Asistencia-ajustes' && !empty($rol) && $rol['Ajustes_Asistencias'] == 1) {
									echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
									echo '<a href="' . $pagina . '"> AJUSTES </a>';
									echo '</li>';
								} elseif ($pagina == 'Asistencia-permisos-vacaciones') {
									echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
									echo '<a href="' . $pagina . '"> PERMISOS </a>';
									echo '</li>';
								}
							}
						}
					}

//Menu de Evaluaciones
					if (!empty($rol) && $rol['Ver_Evaluaciones'] == 1) {
						$evaluaciones = array('Evaluaciones', 'Evaluaciones_Asignadas');
					}else{
						$evaluaciones = array('Evaluaciones_Asignadas');
					}

					if (!empty($paginaActual) && in_array($paginaActual, $evaluaciones)) {
						foreach ($evaluaciones as $pagina) {
							$activeClass = ($paginaActual == $pagina) ? ' active' : '';
							$marginLeftClass = ($pagina != $evaluaciones[0]) ? ' ml-3' : '';

							echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
							if ($pagina == 'Evaluaciones') {
								echo '<a href="' . $pagina . '"> EVALUACIONES </a>';
							}elseif($pagina == 'Evaluaciones_Asignadas'){
								echo '<a href="' . $pagina . '"> EVALUACIONES ASIGNADAS </a>';
							}else{
								echo '<a href="' . $pagina . '">' . strtoupper(ucfirst($pagina)) . '</a>';
							}
							echo '</li>';
						}
					}

//Menu de empleados
					if (!empty($rol) && $rol['Ver_Empleados'] == 1) {
						if (!empty($rol) && $rol['Ver_Departamentos'] == 1) {
							$empleados = array('Empleados', 'Departamento', 'Nominas', 'Organigrama');
						}else{
							$empleados = array('Empleados', 'Nominas', 'Organigrama');
						}

						if (!empty($paginaActual) && in_array($paginaActual, $empleados)) {
							foreach ($empleados as $pagina) {
								$activeClass = ($paginaActual == $pagina) ? ' active' : '';
								$marginLeftClass = ($pagina != $empleados[0]) ? ' ml-3' : '';

								echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
								if ($pagina == 'Nominas') {
									echo '<a href="' . $pagina . '"> NÓMINAS </a>';
								}elseif($pagina == 'Departamento'){
									echo '<a href="' . $pagina . '"> DIRECTIVOS Y JEFATURAS </a>';
								}else{
									echo '<a href="' . $pagina . '">' . strtoupper(ucfirst($pagina)) . '</a>';
								}
								echo '</li>';
							}
						}
					}
//Menu de empleado individual
					if (!empty($rol) && $rol['Editar_Empleados'] == 1) {
						$empleado = array('Empleado', 'Datos');
					}else{
						$empleado = array('Empleado');
					}

					if (!empty($paginaActual) && in_array($paginaActual, $empleado)) {
						foreach ($empleado as $pagina) {
							$activeClass = ($paginaActual == $pagina) ? ' active' : '';
							$marginLeftClass = ($pagina != $empleado[0]) ? ' ml-3' : '';

							echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
							if ($pagina == 'Datos') {
								echo '<a href="' . $pagina . '&perfil='.$_GET['perfil'].'"> DATOS </a>';
							}else{
								echo '<a href="' . $pagina . '&perfil='.$_GET['perfil'].'">' . strtoupper(ucfirst($pagina)) . '</a>';
							}
							echo '</li>';
						}
					}
//Menu de de Bolsa de trabajo
					$Vacantes = array( 'Vacantes','Talento');
					if (!empty($paginaActual) && in_array($paginaActual, $Vacantes)) {
						foreach ($Vacantes as $pagina) {
							$activeClass = ($paginaActual == $pagina) ? ' active' : '';
							$marginLeftClass = ($pagina != $Vacantes[0]) ? ' ml-3' : '';

							echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
							if ($pagina == 'Vacantes') {
								echo '<a href="' . $pagina . '"> OFERTAS DE EMPLEO </a>';
							}else{
								echo '<a href="' . $pagina . '"> BASES DE TALENTO </a>';
							}
							echo '</li>';
						}
					}
//Menu de de Bolsa de trabajo
					if (!empty($rol) && $rol['Ver_Empresas'] == 1) {
						$configuraciones = array( 'Configuraciones','Empresas');
					}else{
						$configuraciones = array( 'Configuraciones');
					}
					if (!empty($paginaActual) && in_array($paginaActual, $configuraciones)) {
						foreach ($configuraciones as $pagina) {
							$activeClass = ($paginaActual == $pagina) ? ' active' : '';
							$marginLeftClass = ($pagina != $configuraciones[0]) ? ' ml-3' : '';

							echo '<li class="nav-item subtitle-nav' . $activeClass . $marginLeftClass . '">';
							echo '<a href="' . $pagina . '">' . strtoupper(ucfirst($pagina)) . '</a>';
							echo '</li>';
						}
					}
					?>
				<?php endif ?>
			</ul>
			<ul class="navbar-nav ml-auto navbar-right-top">
			<!--<li class="nav-item subtitle-nav dropdown notification">
					<a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell wiggle"></i> <span class="indicator"></span></a>
					<ul class="dropdown-menu dropdown-menu-right notification-dropdown">
						<li>
							<div class="notification-title">Notificaciones</div>
							<div class="notification-list">
								<div class="list-group">
									<a href="#" class="list-group-item list-group-item-action active">
										<div class="notification-info">
											<div class="notification-list-user-img"><img src="" alt="" class="user-avatar-md rounded-circle"></div>
											<div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy Rakestraw</span>Aceptó la hora de la reunión.
												<div class="notification-date">2 min ago</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</li>
						<li>
							<div class="list-footer"> <a href="#">Ver todas las notificaciones</a></div>
						</li>
					</ul>
				</li>-->
				<li class="nav-item subtitle-nav dropdown nav-user">
					<a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php $foto = ControladorFormularios::ctrVerFotos("Empleados_idEmpleados", $_SESSION['idEmpleado']) ?>
						<?php if (!empty($foto)): ?>
							<img src="view/fotos/thumbnails/<?php echo $foto['namePhoto'] ?>" alt="" class="user-avatar-md2 rounded-circle">
						<?php else: ?>
							<?php if ($_SESSION['genero'] == 1): ?>
								<span style="background-color: #29CEE8; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; justify-content: center; align-items: center;">
								<?php else: ?>
									<span style="background-color: #F56CC1; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; justify-content: center; align-items: center;">
									<?php endif ?>
									<p class="mt-1" style="color: white;"><?php echo $perfil; ?></p>
								</span>
							<?php endif ?>
						</a>
						<div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
							<div class="nav-user-info">
								<h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION['name']." ".$_SESSION['lastname'] ?></h5>
							</div>
							<a class="dropdown-item" href="Perfil"><i class="fas fa-user mr-2"></i>Mi perfil</a>
							<a class="dropdown-item" href="Salir"><i class="fas fa-power-off mr-2"></i>Cerrar sesión</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	<!-- ============================================================== -->
	<!-- end navbar -->
	<!-- ============================================================== -->
