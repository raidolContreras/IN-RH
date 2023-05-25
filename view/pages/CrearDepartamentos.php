<?php 
$empleados = ControladorEmpleados::ctrVerEmpleados(null,null); 
$registro = ControladorFormularios::ctrRegistrarDeptos();
$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
$departamentos = ControladorFormularios::ctrVerDepartamentos(null, null);
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

			echo '<div class="alert alert-success">¡Departamento creado Exitosamente!</div>';

		}
		if ($registro == "error") {

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo crear departamento!, intentalo de nuevo</div>';
		}

		?>
<div class="container">
	<div class="card">
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<label for="name" class="col-form-label font-weight-bold">Nombre:</label>
					<input type="text" class="form-control" id="name" name="name" required>
				</div>
				<div class="form-group">
					<label for="jefe" class="col-form-label font-weight-bold">Jefe del departamento:</label>
					<select class="form-control" id="jefe" name="jefe" required>
							<option value="Sin empleado" selected>
								Sin empleado
							</option>
						<?php foreach ($empleados as $empleado): ?>
							<option value="<?php echo $empleado['idEmpleados']; ?>">
								<?php echo ucwords(strtolower($empleado['name']." ".$empleado['lastname'])); ?>
							</option>
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
							<option value="<?php echo $empresa['idEmpresas']; ?>">
								<?php echo ucwords(strtolower($empresa['nombre_razon_social']." (".$empresa['rfc'].")")); ?>
							</option>
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
						<button type="submit" name="accion" class="btn btn-primary mr-1" value="otro">Enviar</button>
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
  $("#empresa").change(function() {
    var empresaId = $(this).val();
    $.ajax({
      url: "ajax.formularios.php",
      type: "POST",
      data: {
        empresaId: empresaId
      },
      success: function(response) {
        var perteneceDepa = JSON.parse(response);

        // Limpiar las opciones actuales del select de ciudades
        pertenencia.innerHTML = '';

        // Agregar una opción predeterminada
        var opcionPredeterminada = document.createElement('option');
        opcionPredeterminada.text = 'Sin departamento';
        pertenencia.add(opcionPredeterminada);

        // Agregar las opciones de ciudades correspondientes al estado seleccionado
        perteneceDepa.forEach(function(datos) {
          var opcionDepartamento = document.createElement('option');
          if (datos.Pertenencia === null) {
          	opcionDepartamento.text = datos.name;
      	  }else{
          opcionDepartamento.text = datos.name + ' (' + datos.Pertenencia + ')';
      	  }
          opcionDepartamento.value = datos.id;
          pertenencia.add(opcionDepartamento);
        });
      }
    });
  });
});
</script>