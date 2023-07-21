<?php

	if (isset($_GET['evaluacion'])): 

	$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $_GET['evaluacion']);
	$empleados = ControladorEmpleados::ctrVerEmpleados(null,null);
	$empleados_has_examenes = ModeloFormularios::mdlEmpleadosExamenes($_GET['evaluacion']);

?>
<style>
  select {height: 30px;}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="assets/vendor/multi-select/css/multi-select.css">
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card">
			<div class="card-header">
				<p class="titulo-tablero"><strong>Agregar Empleados a la evaluación:</strong> 
					<?php echo mb_strtoupper($Evaluaciones['titulo']) ?></p>
			</div>
			<div class="card-body">
				<form
					class="mb-3"
					id="empleado-evaluaciones-form">

					<select name="empleados_has_examenes[]"
							class="col-12" 
							id="field1"
							multiple multiselect-search="true"
							multiselect-select-all="true"
							multiselect-max-items="3"
							onchange="console.log(this.selectedOptions)">
					<?php
						foreach ($empleados as $empleado){
							$selected = false; 
							if (!empty($empleados_has_examenes[0])){
								foreach ($empleados_has_examenes as $empleadosExamenes){
									if ($empleadosExamenes['idEmpleado'] == $empleado['idEmpleados']){
										$selected = true;
									}
								}
							}
							if ($selected){
								echo "<option value='".$empleado['idEmpleados']."' selected>"
								.mb_strtoupper($empleado['lastname']." ".$empleado['name'])
								."</option>";
							}else{
								echo "<option value='".$empleado['idEmpleados']."'>"
								.mb_strtoupper($empleado['lastname']." ".$empleado['name'])
								."</option>";
							}
						}
					?>
					</select>
					<input type="hidden"
						name="empleados_examenes"
						value="<?php echo $_GET['evaluacion'] ?>">
				</form>
			</div>
			<div class="card-footer p-0 text-center d-flex justify-content-center">
				<div class="card-footer-item card-footer-item-bordered">
					<div class="row">
						<div class="col-6">
							<a href="Evaluaciones" 
									class="card-link btn btn-outline-secondary btn-block">
								Cancelar
							</a>
						</div>
						<div class="col-6">
							<button class="card-link btn btn-outline-primary btn-block"
									type="button"
									id="empleado-evaluaciones-btn">
								Actualizar lista
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<script src="assets/libs/js/multiselect-dropdown.js"></script>
<script>
	$(document).ready(function() {
		$("#empleado-evaluaciones-btn").click(function() {
		var formData = $("#empleado-evaluaciones-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					$("#form-result").val("");
					if (response === 'ok') {
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  Empleados inscritos correctamente
						</div>
							`);
						deleteAlert();
						window.location.href='CrearRespuesta&pregunta='+response;
					}else if (response === 'eliminado') {
						$("#form-result").html(`
						<div class='alert alert-warning' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  Empleados eliminados correctamente
						</div>
							`);
						deleteAlert();
						window.location.href='CrearRespuesta&pregunta='+response;
					}else{
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						  <i class="fas fa-exclamation-triangle"></i>
						  <b>Error</b>, no se inscribieron los Empleados, intenta nuevamente
						</div>
							`);
						deleteAlert();
					}

				}
			});
		});
	});

function deleteAlert() {
	setTimeout(function() {
	var alert = $('#alerta');
	alert.fadeOut('slow', function() {
		alert.remove();
	});
	}, 500);
}
</script>
<?php endif ?>