<?php if (!empty($rol) && $rol['Editar_Empleados'] == 1): ?>
<?php
					
$colaborador = ControladorEmpleados::ctrVerEmpleados( 'idEmpleados',$_POST["empleado"]); 
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
		'recomendacion_personal' => 'Carta de recomendación (personal)',
		'estado_cuenta' => 'Estado de cuenta',
		'infonavit' => 'Carta de no adeudos (infonavit)',
		'fonacot' => 'Carta de no adeudos (fonacot)'
];
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
				<form method="POST" action="Colaborador" class="breadcrumb-item">
					<button class="btn btn-outline-warning float-right" name="Editar" value="<?php echo $_POST["empleado"];?>">
						Regresar
					</button>
				</form>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item" aria-current="page"><a href="Empleados" class="breadcrumb-link">Colaboradores</a></li>
							<li class="breadcrumb-item" aria-current="page">
								Perfil (<?php echo ucwords($colaborador["name"]." ".$colaborador["lastname"]); ?>)
							</li>
							<li class="breadcrumb-item active" aria-current="page">Subir documentos</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div id="resultado"></div>

	<?php $subir = ControladorFormularios::ctrSubirPDF();
if($subir == "ok"){

			echo '<script>

				if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

				}

			</script>
			';
			
			echo '<div class="alert alert-success">¡Documento cargado Exitosamente!</div>';
		
		}

		if($subir == "error"){

			echo '<script>

				if ( window.history.replaceState ) {

					window.history.replaceState( null, null, window.location.href );

				}

			</script>';

			echo '<div class="alert alert-danger">Error, no se pudo subir el documento, intente de nuevo</div>';

		} ?>
	<div class="container-fluid">
		<div class="card shadow">
			<div class="card-body">
				<div class="row">
					<?php 
						// Recorrer el arreglo para mostrar o subir los documentos
						foreach ($documentos as $nombreArchivo => $nombreDocumento) {
							$doc = ControladorFormularios::ctrVerDocumento($nombreArchivo, $_POST["empleado"]);
							if (!empty($doc)) {
								echo ControladorFormularios::ctrImprimirDivs(1,$nombreArchivo,$_POST["empleado"],$nombreDocumento);
							}else{
								echo ControladorFormularios::ctrImprimirDivs(0,$nombreArchivo,$_POST["empleado"],$nombreDocumento);
							}
						}
					?>

				</div>
			</div>
		</div>
	</div> 
</div>
</div>
<?php else: ?>
	<script>
		window.location.href = 'Empleados';
	</script>
<?php endif ?>