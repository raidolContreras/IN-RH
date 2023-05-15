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
	<link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
	<link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
	<link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
	<link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
    <link rel="stylesheet" href="assets/vendor/fonts/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendor/fonts/themify-icons/themify-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rambla:ital@1&display=swap" rel="stylesheet">
	<link href='assets/vendor/full-calendar/css/fullcalendar.css' rel='stylesheet' />
	<link href='assets/vendor/full-calendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<link rel="shortcut icon" href="assets/images/logo.png" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/ojrrit6i20fvuzvl2sioxzrflc9dh7gpi3gosuyrwgzfa18y/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	
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
			$_GET["pagina"] == "HistorialLaboral" ||
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
			$_GET["pagina"] == "somos" 

		){
			include "pages/navs/navbar.php";
			include "pages/navs/sidenav.php"; 

			include "pages/".$_GET["pagina"].".php";

		}elseif(strpos($_GET["pagina"], "Vacantes-") !== false){

			$pagina = str_replace("Vacantes-", "", $_GET["pagina"]);
			if ($pagina == 'Postulantes'||
				$pagina == "CrearVacante" ||
				$pagina == "EliminarVacante") {

				include "pages/navs/navbar.php";
				include "pages/navs/sidenav.php";

				include "pages/Vacantes/".$pagina.".php";
			}else{
				include "pages/404-page.html";
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
				 $_GET["pagina"] == "Salir"
				) {

			include "pages/Login/".$_GET["pagina"].".php";

		}elseif ($_GET["pagina"] == "Noticias" ||
				 $_GET["pagina"] == "TableroNoticias"	) {

			include "pages/navs/navbar.php";
			include "pages/navs/sidenav.php"; 
			include "pages/modulos/".$_GET["pagina"].".php";

		}else{
			include "pages/404-page.html";
		}

	}else{
		include "pages/navs/navbar.php";
		include "pages/navs/sidenav.php"; 
		include "pages/Inicio.php";
	}
//	include "pages/navs/footer.php";

?>
</div>
</div>
<!-- ============================================================== -->
<!-- end wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end main wrapper  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<!-- jquery 3.3.1 -->
<!-- ============================================================== -->

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
    <script src='assets/vendor/full-calendar/js/moment.min.js'></script>
    <script src='assets/vendor/full-calendar/js/fullcalendar.js'></script>
    <script src='assets/vendor/full-calendar/js/jquery-ui.min.js'></script>
    <script src='assets/vendor/full-calendar/js/calendar.js'></script>
    <script src="assets/libs/js/main-js.js"></script>
</body>

</html>