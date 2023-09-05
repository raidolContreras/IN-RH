<?php if (!empty($rol) && $rol['Ver_Reclutamiento'] == 1): ?>
<?php
$empresas = ControladorFormularios::ctrVerEmpresas(null,null);

$nameVacante = '';
$salarioVacante = 0;
$requisitos = '';
$Empresas_idEmpresas = 0;
$Departamentos_idDepartamentos = 0;
$nameDepto = '';
$idVacantes = 0;

if (isset($_GET['Editar'])) {
	$vacante = ControladorFormularios::ctrVerVacantes('idVacantes', $_GET['Editar']);
	$nameVacante = $vacante['nameVacante'];
	$salarioVacante = $vacante['salarioVacante'];
	$requisitos = $vacante['requisitos'];
	$Empresas_idEmpresas = $vacante['Empresas_idEmpresas'];
	$idVacantes = $_GET['Editar'];
	$Departamentos_idDepartamentos = $vacante['Departamentos_idDepartamentos'];
	$depto = ControladorFormularios::ctrVerDepartamentos('idDepartamentos',$Departamentos_idDepartamentos);
	$nameDepto = $depto['nameDepto'];
}


?>
<div class="container-fluid dashboard-content ">
	<div class="container">
		<div class="card">
			<div class="card-body">
				<form id="vacantes-form">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nameVacante" class="col-form-label font-weight-bold">Nombre del puesto:</label>
								<input type="text" class="form-control" id="nameVacante" value="<?php echo $nameVacante ?>" name="nameVacante" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="salarioVacante" class="col-form-label font-weight-bold">Salario:</label>
								<input type="text"  maxlength="10" class="form-control" id="salarioVacante" value="<?php echo $salarioVacante ?>" name="salarioVacante" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="empresa" class="col-form-label font-weight-bold">Empresa:</label>
								<select class="form-control" id="empresa" name="empresaVacante" required>
									<option>
										Seleccionar empresa
									</option>
									<?php foreach ($empresas as $empresa): ?>
										<?php if ($empresa['idEmpresas'] == $Empresas_idEmpresas): ?>
											<option value="<?php echo $empresa['idEmpresas']; ?>" selected>
										<?php else: ?>
											<option value="<?php echo $empresa['idEmpresas']; ?>">
										<?php endif ?>
												<?php echo ucwords(strtolower($empresa['nombre_razon_social']." (".$empresa['rfc'].")")); ?>
											</option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="departamentoVacante" class="col-form-label font-weight-bold">Departamento:</label>
								<select class="form-control" id="departamentoVacante" value="" name="departamentoVacante" required>
									<?php if ($nameDepto != ''): ?>
										<option value="<?php echo $Departamentos_idDepartamentos ?>"><?php echo $nameDepto ?></option>
									<?php else: ?>
									<option>
										Selecciona una empresa
									</option>
										
									<?php endif ?>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="requisitosVacante" class="col-form-label font-weight-bold">Requisitos:</label>
								<!---->
								<textarea class="form-control texteditor" name="requisitosVacante" id="requisitosVacante" rows="3" required>
									<?php echo $requisitos; ?>
								</textarea>
								<!---->
							</div>
						</div>
						<input type="hidden" name="vacante_creada" value="<?php echo $idVacantes; ?>">

					</div>
					<div class="form-group float-right">
						<button type="button" id="vacantes-btn" class="btn btn-primary rounded">Registrar</button>
						<a href="Vacantes" class="btn btn-danger rounded">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>

	tinymce.init({
	selector: '.texteditor',
	plugins: 'advlist lists',
	menubar: '',
	toolbar: 'bold italic underline | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat'

	});
	$(document).ready(function() {
	var empresa = document.getElementById('empresa');
	var departamento = document.getElementById('departamentoVacante');
	$("#empresa").change(function() {
		var empresaId = $(this).val();
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: {
				empresaId: empresaId
			},
			success: function(response) {
				var perteneceDepa = JSON.parse(response);

				// Limpiar las opciones actuales del select de ciudades
				departamento.innerHTML = '';

				// Agregar una opción predeterminada
				var opcionPredeterminada = document.createElement('option');
				opcionPredeterminada.text = 'Sin departamento';
				departamento.add(opcionPredeterminada);

				// Agregar las opciones de ciudades correspondientes al estado seleccionado
				perteneceDepa.forEach(function(datos) {
					var opcionDepartamento = document.createElement('option');
					if (datos.Pertenencia === null) {
						opcionDepartamento.text = datos.name;
					}else{
					opcionDepartamento.text = datos.name + ' (' + datos.Pertenencia + ')';
					}
					opcionDepartamento.value = datos.id;
					departamento.add(opcionDepartamento);
				});
			}
		});
	});

	$("#vacantes-btn").click(function() {

		var contenidoEditor = tinymce.get('requisitosVacante').getContent();
		$("#requisitosVacante").val(contenidoEditor);
		var formData = $("#vacantes-form").serialize(); // Obtener los datos del formulario

		$.ajax({
			url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
			type: "POST",
			data: formData,
			success: function(response) {

				if (response === 'ok') {
					$("#form-result").val("");
					$("#form-result").html(`
					<div class='alert alert-success' role="alert" id="alerta">
					  <i class="fas fa-check-circle"></i>
					  <?php 
					  	if (isset($_GET['Editar'])) {
					  		echo "Vacante actualizada.";
					  	}else{
					  		echo "Nueva vacante registrada.";
					  	}
					  ?>
					</div>
						`);
					deleteAlert();
					setTimeout(function() {
						location.href = 'Vacantes';
					}, 1600);
				}else if (response === '2') {
					$("#form-result").val("");
					$("#form-result").html(`
					<div class='alert alert-warning' role="alert" id="alerta">
					  <i class="fas fa-exclamation-triangle"></i>
					  <b>Error</b>, El nombre de la vacante no puede contener numeros o caracteres especiales.
					</div>
						`);
					deleteAlert();
				}else{
					$("#form-result").val("");
					$("#form-result").html(`
					<div class='alert alert-danger' role="alert" id="alerta">
					  <i class="fas fa-exclamation-triangle"></i>
					  <b>Error</b>, no se pudo crear la vacante, intenta nuevamente.
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
			}, 1500);
		}
</script>
<?php else: ?>
	<script>
		window.location.href = 'Inicio';
	</script>
<?php endif ?>