<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();
?>
<!doctype html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/libs/css/style.css">
	<link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
	<link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
	<link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
    <link rel="stylesheet" href="assets/vendor/fonts/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendor/fonts/themify-icons/themify-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rambla:ital@1&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="assets/images/logo.png" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/ojrrit6i20fvuzvl2sioxzrflc9dh7gpi3gosuyrwgzfa18y/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">

	
	<?php if (isset($_GET["pagina"])): ?>
		<title><?php echo 'IN Consulting México - '.$_GET["pagina"]; ?></title>
	<?php else: ?>
		<title><?php echo 'IN Consulting México'; ?></title>
	<?php endif ?>
</head>

<body>	
	<?php

	if(isset($_GET["pagina"])){

		if($_GET["pagina"] == "Empleados" ||
			$_GET["pagina"] == "Inicio" ||
			$_GET["pagina"] == "RegistroEmpleados" ||
			$_GET["pagina"] == "InformacionLaboral" ||
			$_GET["pagina"] == "Formacion" ||
			$_GET["pagina"] == "Departamento" ||
			$_GET["pagina"] == "CrearDepartamentos" ||
			$_GET["pagina"] == "Empleado" ||
			$_GET["pagina"] == "Foto" ||
			$_GET["pagina"] == "Documento" ||
			$_GET["pagina"] == "EditarDepto" ||
			$_GET["pagina"] == "EliminarDepto" ||
			$_GET["pagina"] == "Puestos" ||
			$_GET["pagina"] == "CrearPuestos" ||
			$_GET["pagina"] == "Vacantes" ||
			$_GET["pagina"] == "Postulantes" ||
			$_GET["pagina"] == "Reuniones" ||
			$_GET["pagina"] == "VerPdf" ||
			$_GET["pagina"] == "Configuraciones" ||
			$_GET["pagina"] == "Empresas" ||
			$_GET["pagina"] == "RegistroEmpresa" ||
			$_GET["pagina"] == "Talento" ||
			$_GET["pagina"] == "Nominas" ||
			$_GET["pagina"] == "Tareas" ||
			$_GET["pagina"] == "SubirDocumentos" ||
			$_GET["pagina"] == "EntregarTarea" ||
			$_GET["pagina"] == "FinalizarTarea" ||
			$_GET["pagina"] == "Evaluaciones"  ||
			$_GET["pagina"] == "somos" 

		){
			include "pages/navs/navbar.php";
			include "pages/navs/sidenav.php"; 

			include "pages/".$_GET["pagina"].".php";
			echo '<a href="Empresas" class="configuration-button"><i class="fas fa-cog rotate-center"></i></a>';

		}elseif(strpos($_GET["pagina"], "Vacantes-") !== false){

			$pagina = str_replace("Vacantes-", "", $_GET["pagina"]);
			if ($pagina == 'Postulantes'||
				$pagina == "CrearVacante" ||
				$pagina == "EliminarVacante") {

				include "pages/navs/navbar.php";
				include "pages/navs/sidenav.php";

				include "pages/Vacantes/".$pagina.".php";
			}

		}elseif ($_GET["pagina"] == "Postulacion") {

			include "pages/navs/navbar.php";
			include "pages/navs/sidenav.php"; 
			include "pages/Vacantes/".$_GET["pagina"].".php";

		}elseif ($_GET["pagina"] == "Datos") {

			include "pages/navs/navbar.php";
			include "pages/navs/sidenav.php"; 
			include "pages/Empleado/".$_GET["pagina"].".php";

		}elseif ($_GET["pagina"] == "Login" ||
				 $_GET["pagina"] == "Salir" ||
				 $_GET["pagina"] == "Forgot-Password") {

			include "pages/Login/".$_GET["pagina"].".php";

		}elseif ($_GET["pagina"] == "Organigrama" ||
					$_GET["pagina"] == "Perfil") {

			include "pages/navs/navbar.php";
			include "pages/".$_GET["pagina"].".php";

		}elseif ($_GET["pagina"] == "Noticias" ||
				 $_GET["pagina"] == "TableroNoticias" ||
				 $_GET["pagina"] == "EliminarNoticia"	) {

			include "pages/navs/navbar.php";
			include "pages/navs/sidenav.php"; 
			include "pages/modulos/".$_GET["pagina"].".php";

		}elseif ($_GET["pagina"] == "Password") {

			include "pages/".$_GET["pagina"].".php";

		}elseif ($_GET["pagina"] == "Asistencia" ||
				 $_GET["pagina"] == "Asistencia-resumen" ||
				 $_GET["pagina"] == "Asistencia-ajustes" ||
				 $_GET["pagina"] == "Asistencia-importar" ||
				 $_GET["pagina"] == "Asistencia-permisos" ||
				 $_GET["pagina"] == "Asistencia-permisos-vacaciones" ||
				 $_GET["pagina"] == "CrearHorario" ) {

			include "pages/navs/navbar.php";
			include "pages/navs/sidenav.php";
			if ($_GET['pagina'] == "Asistencia-permisos-vacaciones") {
				include "pages/Horarios/Vacaciones.php";
			}else{
				include "pages/Horarios/".$_GET["pagina"].".php";
			}

		}elseif ($_GET["pagina"] == "crearEvaluacion" ||
				 $_GET["pagina"] == "eliminarExamen" ||
				 $_GET["pagina"] == "AddPregunta" ||
				 $_GET["pagina"] == "CrearRespuesta" ||
				 $_GET["pagina"] == "EliminarPregunta" ||
				 $_GET["pagina"] == "AddEmpleados" ||
				 $_GET["pagina"] == "Evaluaciones_Asignadas" ||
				 $_GET["pagina"] == "Examen" ||
				 $_GET["pagina"] == "Calificaciones" ||
				 $_GET["pagina"] == "Preguntas") {

			include "pages/navs/navbar.php";
			include "pages/navs/sidenav.php";
			include "pages/Examenes/".$_GET["pagina"].".php";

		}else{
			include "pages/404-page.html";
		}

	}else{
		include "pages/navs/navbar.php";
		include "pages/navs/sidenav.php"; 
		include "pages/Inicio.php";
		echo '<a href="Empresas" class="configuration-button"><i class="fas fa-cog rotate-center"></i></a>';
	}
//	include "pages/navs/footer.php";

?>

</div>
</div>
</div>

<div id="form-result" class="alerta-flotante"></div>
<!-- JavaScript de Bootstrap 4 y jQuery -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
<script src="assets/libs/js/main-js.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables/js/data-table.js"></script>
<script src="assets/vendor/datatables/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <!-- Optional JavaScript -->
    <script src="assets/libs/js/main-js.js"></script>
</body>

</html>