<!-- ============================================================== -->
		<!-- main wrapper -->
		<!-- ============================================================== -->
		<div class="dashboard-main-wrapper">
<?php if (!isset($_SESSION['validarIngreso'])): ?>
			<script>
				setTimeout(function() {
					location.href='Login';
				}, 500);
			</script>
<?php endif ?>
<?php 
$primerLetra = strtoupper(substr($_SESSION["name"], 0, 1)); // Extrae la primer letra del texto
$segundaLetra = strtoupper(substr($_SESSION["lastname"], 0, 1)); // Extrae la primer letra del texto
$perfil = $primerLetra.$segundaLetra;
 ?>
<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
<div class="dashboard-header">
	<nav class="navbar navbar-expand-lg bg-white fixed-top">
		<a class="navbar-brand rambla" href="Inicio"><img src="assets/images/logo.png" width="40px" height="auto">consulting</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fas fa-bars"></span>
		</button>
		<div class="collapse navbar-collapse " id="navbarSupportedContent">
			<ul class="navbar-nav navbar-left-top">
				<li class="nav-item"></li>
				<?php if (isset($_GET['pagina'])): ?>
				<?php 
				//Menu de empleados
					$empleados = array('Asistencia', 'Asistencia-resumen', 'Asistencia-ajustes');
					$paginaActual = $_GET['pagina'];

					if (!empty($paginaActual) && in_array($paginaActual, $empleados)) {
							foreach ($empleados as $pagina) {
									$activeClass = ($paginaActual == $pagina) ? ' active' : '';
									$marginLeftClass = ($pagina != $empleados[0]) ? ' ml-3' : '';
									
									echo '<li class="nav-item' . $activeClass . $marginLeftClass . '">';
									if ($pagina == 'Asistencia-resumen') {
										echo '<a href="' . $pagina . '"> Resumen de asistencias </a>';
									}elseif ($pagina == 'Asistencia-ajustes') {
										echo '<a href="' . $pagina . '"> Ajustes </a>';
									}else{
										echo '<a href="' . $pagina . '">' . ucfirst($pagina) . '</a>';
									}
									echo '</li>';
							}
					}
					?>
				<?php 
				//Menu de empleados
					$empleados = array('Empleados', 'Departamento', 'Nominas', 'Organigrama');
					$paginaActual = $_GET['pagina'];

					if (!empty($paginaActual) && in_array($paginaActual, $empleados)) {
							foreach ($empleados as $pagina) {
									$activeClass = ($paginaActual == $pagina) ? ' active' : '';
									$marginLeftClass = ($pagina != $empleados[0]) ? ' ml-3' : '';
									
									echo '<li class="nav-item' . $activeClass . $marginLeftClass . '">';
									if ($pagina == 'Nominas') {
										echo '<a href="' . $pagina . '"> Nóminas </a>';
									}elseif($pagina == 'Departamento'){
										echo '<a href="' . $pagina . '"> Directivos y jefaturas </a>';
									}else{
										echo '<a href="' . $pagina . '">' . ucfirst($pagina) . '</a>';
									}
									echo '</li>';
							}
					}
					?>

				<?php 
				//Menu de empleado individual
					$empleado = array('Empleado', 'Datos');
					$paginaActual = $_GET['pagina'];

					if (!empty($paginaActual) && in_array($paginaActual, $empleado)) {
							foreach ($empleado as $pagina) {
									$activeClass = ($paginaActual == $pagina) ? ' active' : '';
									$marginLeftClass = ($pagina != $empleado[0]) ? ' ml-3' : '';
									
									echo '<li class="nav-item' . $activeClass . $marginLeftClass . '">';
									if ($pagina == 'Datos') {
										echo '<a href="' . $pagina . '&perfil='.$_GET['perfil'].'"> Datos </a>';
									}else{
										echo '<a href="' . $pagina . '&perfil='.$_GET['perfil'].'">' . ucfirst($pagina) . '</a>';
									}
									echo '</li>';
							}
					}
					?>

				<?php 
				//Menu de de Bolsa de trabajo
					$Vacantes = array( 'Vacantes','Talento');
					$paginaActual = $_GET['pagina'];
					if (!empty($paginaActual) && in_array($paginaActual, $Vacantes)) {
							foreach ($Vacantes as $pagina) {
									$activeClass = ($paginaActual == $pagina) ? ' active' : '';
									$marginLeftClass = ($pagina != $Vacantes[0]) ? ' ml-3' : '';
									
									echo '<li class="nav-item' . $activeClass . $marginLeftClass . '">';
									if ($pagina == 'Vacantes') {
										echo '<a href="' . $pagina . '"> Ofertas de empleo </a>';
									}else{
										echo '<a href="' . $pagina . '"> Bases de talento </a>';
									}
									echo '</li>';
							}
					}
					?>

				<?php 
				//Menu de de Bolsa de trabajo
					$Vacantes = array( 'Configuraciones','Empresas', 'Permisos');
					$paginaActual = $_GET['pagina'];
					if (!empty($paginaActual) && in_array($paginaActual, $Vacantes)) {
							foreach ($Vacantes as $pagina) {
									$activeClass = ($paginaActual == $pagina) ? ' active' : '';
									$marginLeftClass = ($pagina != $Vacantes[0]) ? ' ml-3' : '';
									
									echo '<li class="nav-item' . $activeClass . $marginLeftClass . '">';
									echo '<a href="' . $pagina . '">' . ucfirst($pagina) . '</a>';
									echo '</li>';
							}
					}
					?>

				<?php endif ?>

			</ul>
			<ul class="navbar-nav ml-auto navbar-right-top">
				<li class="nav-item dropdown notification">
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
				</li>
				<li class="nav-item dropdown nav-user">
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
