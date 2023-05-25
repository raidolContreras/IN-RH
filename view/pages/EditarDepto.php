<?php 
$datos = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$_GET['Edicion']);
if ($datos['Empleados_idEmpleados']!=null) {
	$empleadoDpto = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $datos['Empleados_idEmpleados']); 
}
$empresasSelect = ControladorFormularios::ctrVerEmpresas("idEmpresas", $datos['Empresas_idEmpresas']);

$empleadosDpto = ControladorEmpleados::ctrVerEmpleados(null,null); 
$empleados = ControladorEmpleados::ctrVerEmpleados(null,null); 
$registro = ControladorFormularios::ctrActualizarDepto();
$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
?>
<div class="container-fluid dashboard-content ">

		<?php 

		/*=============================================
		FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
		=============================================*/

		if($registro == "ok"){

			echo '<script>
			location.href="Departamento";
			</script>';

			echo '<div class="alert alert-success">¡Departamento Actualizado con exito!</div>';

		}
		if ($registro == "error") {

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo actualizar el departamento!, intentalo de nuevo</div>';
		}
		?>
<div class="container">
	<div class="card">
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<label for="name" class="col-form-label font-weight-bold">Nombre:</label>
					<input type="text" class="form-control" id="name" name="name" value="<?php echo $datos['nameDepto']; ?>" required>
				</div>
				<div class="form-group">
					<label for="jefe" class="col-form-label font-weight-bold">Jefe del departamento:</label>
					<select class="form-control" id="jefe" name="jefe">
							<option>
								Selecciona un empleado
							</option>
						<?php foreach ($empleadosDpto as $key => $empleado): ?>
							<?php if ($empleado['idEmpleados'] == $empleadoDpto['idEmpleados']): ?>
								
							<option value="<?php echo $empleado['idEmpleados']; ?>" selected>
								<?php echo ucwords(strtolower($empleado['name']." ".$empleado['lastname'])); ?>
							</option>
							<?php else: ?>
							<option value="<?php echo $empleado['idEmpleados']; ?>">
								<?php echo ucwords(strtolower($empleado['name']." ".$empleado['lastname'])); ?>
							</option>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="empresa" class="col-form-label font-weight-bold">Empresa:</label>
					<select class="form-control" id="empresa" name="empresa" required>
							<option>
								Seleccionar empresa
							</option>
						<?php foreach ($empresas as $empresa): ?>
						    <?php if ($empresasSelect['idEmpresas'] == $empresa['idEmpresas']): ?>
						        <option value="<?php echo $empresa['idEmpresas']; ?>" selected>
						            <?php echo ucwords(strtolower($empresa['nombre_razon_social']." (".$empresa['rfc'].")")); ?>
						        </option>
						    <?php else: ?>
						        <option value="<?php echo $empresa['idEmpresas']; ?>">
						            <?php echo ucwords(strtolower($empresa['nombre_razon_social']." (".$empresa['rfc'].")")); ?>
						        </option>
						    <?php endif ?>
						<?php endforeach ?>

					</select>
				</div>
				<div class="form-group">
					<label for="Pertenencia" class="col-form-label font-weight-bold">Departamento:</label>
					<select class="form-control" id="Pertenencia" name="Pertenencia">
							<option>
								Seleccionar departamento
							</option>
					</select>
				</div>
				<div class="row mt-5 rounded float-right">
					<div class="text-center">
						<input type="hidden" name="idDepto" value="<?php echo $_GET['Edicion']; ?>">
						<button type="submit" name="accion" class="btn btn-primary mr-1" value="<?php echo $_GET['Edicion'] ?>">Enviar</button>
					</div>
					<div class="text-center">
						<a href="Departamento" class="btn btn-danger mr-3">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

	</div>
</div>
<script>
$(document).ready(function() {
  var empresa = document.getElementById('empresa');
  var pertenencia = document.getElementById('Pertenencia');

  // Función para cargar los departamentos correspondientes a la empresa seleccionada
  function cargarDepartamentos(empresaId) {
    $.ajax({
      url: "ajax.formularios.php",
      type: "POST",
      data: { empresaId: empresaId },
      success: function(response) {
        var perteneceDepa = JSON.parse(response);

        // Limpiar las opciones actuales del select de departamentos
        pertenencia.innerHTML = '';

        // Agregar una opción predeterminada
        var opcionPredeterminada = document.createElement('option');
        opcionPredeterminada.text = 'Sin departamento';
        pertenencia.add(opcionPredeterminada);

        // Agregar las opciones de departamentos correspondientes a la empresa seleccionada
        perteneceDepa.forEach(function(datos) {
          var opcionDepartamento = document.createElement('option');
          if (datos.Pertenencia === null) {
            opcionDepartamento.text = datos.name;
          } else {
            opcionDepartamento.text = datos.name + ' (' + datos.Pertenencia + ')';
          }
          opcionDepartamento.value = datos.id;
          if (datos.id === <?php echo $datos['Pertenencia'] ?>) {
          	opcionDepartamento.selected = true;
          }
          pertenencia.add(opcionDepartamento);
        });
      }
    });
  }

  // Cargar los departamentos iniciales de la empresa seleccionada por defecto
  cargarDepartamentos(empresa.value);

  // Cambiar los departamentos cuando se seleccione otra empresa
  $("#empresa").change(function() {
    var empresaId = $(this).val();
    cargarDepartamentos(empresaId);
  });
});

</script>