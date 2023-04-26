<?php
$curriculum = ControladorFormularios::ctrVerDocumento("curriculum", $_POST["empleado"]);
$acta_nacimiento = ControladorFormularios::ctrVerDocumento("acta_nacimiento", $_POST["empleado"]);
$comprobante_domicilio = ControladorFormularios::ctrVerDocumento("comprobante_domicilio", $_POST["empleado"]);
$identificacion_anverso = ControladorFormularios::ctrVerDocumento("identificacion_anverso", $_POST["empleado"]);
$identificacion_reverso = ControladorFormularios::ctrVerDocumento("identificacion_reverso", $_POST["empleado"]);
$rfc = ControladorFormularios::ctrVerDocumento("rfc", $_POST["empleado"]);
$curp = ControladorFormularios::ctrVerDocumento("curp", $_POST["empleado"]);
$nss = ControladorFormularios::ctrVerDocumento("nss", $_POST["empleado"]);
$comprobante_estudios = ControladorFormularios::ctrVerDocumento("comprobante_estudios", $_POST["empleado"]);
$recomendacion_laboral = ControladorFormularios::ctrVerDocumento("recomendacion_laboral", $_POST["empleado"]);
$recomendacion_personal = ControladorFormularios::ctrVerDocumento("recomendacion_personal", $_POST["empleado"]);
?>
<link rel="stylesheet" href="assets/libs/css/archivo.css">
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Subir Documentos</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page"><a href="Empleados" class="breadcrumb-link">Colaboradores</a></li>
							<li class="breadcrumb-item active" aria-current="page">Subir documentos</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="card shadow">
			<div class="card-body">
				<div class="row">
					<?php
					$subir = ControladorFormularios::ctrSubirPDF();
					// Definir un arreglo asociativo para almacenar la información de los documentos
					$documentos = [
					    'curriculum' => 'Curriculum',
					    'acta_nacimiento' => 'Acta de Nacimiento',
					    'comprobante_domicilio' => 'Comprobante de Domicilio',
					    'identificacion_anverso' => 'Identificación Anverso',
					    'identificacion_reverso' => 'Identificación Reverso',
					    'rfc' => 'RFC (Constancia de situación fiscal)',
					    'curp' => 'CURP',
					    'nss' => 'NSS',
					    'comprobante_estudios' => 'Comprobante último grado de estudios',
					    'recomendacion_laboral' => 'Carta de recomendación (Laboral)',
					    'recomendacion_personal' => 'Carta de recomendación (personal)'
					];

					// Recorrer el arreglo para mostrar o subir los documentos
					foreach ($documentos as $nombreArchivo => $nombreDocumento) {
					    if (!isset($$nombreArchivo['nameDoc'])) {
					        // Si el archivo no existe, mostrar el formulario para subirlo
					        echo '<form method="POST" enctype="multipart/form-data" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">';
					        echo '<div class="row centrado">';
					        echo '<div class="form-group col-xl-8 col-lg-8 col-md-6 col-sm-6 col-12">';
					        echo "<label for=\"$nombreArchivo\">$nombreDocumento</label>";
					        echo "<input type=\"file\" accept=\".pdf\" class=\"form-control-file\" id=\"$nombreArchivo\" name=\"file\" required>";
					        echo '</div>';
					        echo '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">';
					        echo "<input type=\"hidden\" name=\"archivo\" value=\"$nombreArchivo\">";
					        echo "<input type=\"hidden\" name=\"empleado\" value=\"{$_POST['empleado']}\">";
					        echo '<button type="submit" class="btn btn-secondary rounded btn-block">Enviar</button>';
					        echo '</div>';
					        echo '</div>';
					        echo '</form>';
					    } else {
					        // Si el archivo existe, mostrar un mensaje de éxito
					        echo '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">';
					        echo '<div class="row centrado">';
					        echo '<div class="form-group col-xl-8 col-lg-8 col-md-6 col-sm-6 col-12">';
					        echo "<label>$nombreDocumento</label>";
					        echo '<div class="alert alert-success center">';
					        echo "$nombreDocumento ya en sistema";
					        echo '</div>';
					        echo '</div>';
					        echo '</div>';
					        echo '</div>';
					    }
					}
					?>

				</div>
			</div>
		</div>
	</div> 
</div>
</div>