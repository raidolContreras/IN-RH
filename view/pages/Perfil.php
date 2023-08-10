<?php $empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $_SESSION['idEmpleado']); 


// Leer el archivo JSON de estados
$estadosJson = file_get_contents('view/pages/json/estados.json');

// Leer el archivo JSON de ciudades
$ciudadesJson = file_get_contents('view/pages/json/ciudades.json');

// Convertir el JSON a un array asociativo
$estadosArray = json_decode($estadosJson, true);
$ciudadesArray = json_decode($ciudadesJson, true);
?>
<div class="container-fluid dashboard-content ">
	<div class="row">
		<div class="container">
			<div class="card rounded-card card-info">
				<h2 class="mx-4 my-5">Configuración de cuenta</h2>
			</div>
			<div class="card">
				<div class="row rounded-card">
					<?php require_once "view/pages/Perfil/Cambio_foto.php" ?>
					<?php require_once "view/pages/Perfil/cambio_pass.php" ?>
					<?php require_once "view/pages/Perfil/datosPersonales.php" ?>
				</div>
			</div>
		</div>
	</div>
</div>