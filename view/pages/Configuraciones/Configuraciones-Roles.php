<?php 
$Ver_Empleados = 0;
$Editar_Empleados = 0;
$Del_Empleados = 0;
$Ver_Tareas = 0;
$Editar_Tareas = 0;
$Del_Tareas = 0;
 ?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="card-header encabezado">Configuración del sistema</div>
			<div class="row">
				<?php require_once "view/pages/navs/sidenav_configuracion.php"; ?>
				<div class="col-xl-10 col-lg-9 col-md-8 col-9" id="horarios">
					<div class="row mr-4 ml-2 mt-3">
						<div class="card-header encabezado m-0 p-0">
							Gestionar categorías
						</div>
						<div class="card-header encabezado m-0 p-0">
							<button type="button" class="btn btn-in-consulting float-right" data-toggle="modal" data-target="#exampleModal">
								<i class="fas fa-plus-circle"></i> <span>Dar de alta categoría</span>
							</button>
						</div>
					</div>
					<?php $empleados = ControladorEmpleados::ctrVerEmpleados(null,null); ?>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table roles">
								<thead>
									<tr>
										<th width="200">Empleados</th>
										<th>Puesto</th>
										<th>Departamento</th>
										<th>Empresa</th>
										<th>Asignar roles</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($empleados as $empleado): 
										$puestos = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $empleado['idEmpleados']);
										$departamentos = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puestos['Departamentos_idDepartamentos']);
										$empresas = ControladorFormularios::ctrVerEmpresas("idEmpresas", $departamentos['Empresas_idEmpresas']);
										$rol = ModeloFormularios::mdlVerRoles("Empleados_idEmpleados", $empleado['idEmpleados']);
										if (!empty($rol)) {
											$Ver_Empleados = $rol['Ver_Empleados'];
											$Editar_Empleados = $rol['Editar_Empleados'];
											$Del_Empleados = $rol['Del_Empleados'];
											$Ver_Tareas = $rol['Ver_Tareas'];
											$Editar_Tareas = $rol['Editar_Tareas'];
											$Del_Tareas = $rol['Del_Tareas'];
										}
										?>
										<tr>
											<td><?php echo mb_strtoupper($empleado['nombre']); ?></td>
											<td><?php echo mb_strtoupper($puestos['namePuesto']); ?></td>
											<td><?php echo mb_strtoupper($departamentos['nameDepto']); ?></td>
											<td><?php echo mb_strtoupper($empresas['nombre_razon_social']); ?></td>
											<td>
												<button
												class="btn btn-outline-purple rounded btn-block"
												data-toggle="modal"
												data-target="#rolesModal"
												data-id="<?php echo $empleado['idEmpleados']; ?>"
												data-name="<?php echo $empleado['nombre']; ?>"
												data-Ver_Empleados="<?php echo $Ver_Empleados; ?>"
												data-Editar_Empleados="<?php echo $Editar_Empleados; ?>"
												data-Del_Empleados="<?php echo $Del_Empleados; ?>"
												data-Ver_Tareas="<?php echo $Ver_Tareas; ?>"
												data-Editar_Tareas="<?php echo $Editar_Tareas; ?>"
												data-Del_Tareas="<?php echo $Del_Tareas; ?>">
												<i class="fas fa-clipboard-list"></i>
											</button>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Modal de Asignar Roles -->
<div class="modal fade" id="rolesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title titulo-tablero" id="exampleModalLabel">Asignar Roles</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="row" id="asignarRoles-form">
					<div class="col-sm-6">
						<p class="subtitulo">Empleados
						<label class="custom-control custom-checkbox custom-control">
							<input type="checkbox" id="Marcar-Todos-Empleados" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label></p>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Empleados" id="Ver-Empleados" class="empleado-checkbox custom-control-input">
							<span class="custom-control-label">Ver Empleados</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Empleados" id="Editar-Empleados" class="empleado-checkbox custom-control-input" disabled>
							<span class="custom-control-label">Editar Empleados</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Empleados" id="Del-Empleados" class="empleado-checkbox custom-control-input" disabled>
							<span class="custom-control-label">Eliminar Empleados</span>
						</label>
					</div>
					<div class="col-sm-6">
						<p class="subtitulo">Tareas
						<label class="custom-control custom-checkbox custom-control">
							<input type="checkbox" id="Marcar-Todos-Tareas" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label></p>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Tareas" id="Ver-Tareas" class=" Tarea-checkbox custom-control-input">
							<span class="custom-control-label">Ver Tareas</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Tareas" id="Editar-Tareas" class=" Tarea-checkbox custom-control-input" disabled>
							<span class="custom-control-label">Editar Tareas</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Tareas" id="Del-Tareas" class=" Tarea-checkbox custom-control-input" disabled>
							<span class="custom-control-label">Eliminar Tareas</span>
						</label>
					</div>
					<input type="hidden" name="empleado-rol" id="empleado-rol">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary rounded" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary rounded" id="asignarRoles-btn">Actualizar roles</button>
			</div>
		</div>
	</div>
</div>

<script>
$('#rolesModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	var recipient = button.data('name');
	var ver_empleados = button.data('ver_empleados');
	var editar_empleados = button.data('editar_empleados');
	var del_empleados = button.data('del_empleados');
	var ver_tareas = button.data('ver_tareas');
	var editar_tareas = button.data('editar_tareas');
	var del_tareas = button.data('del_tareas');
	var id = button.data('id');
	var modal = $(this);
	modal.find('.modal-title').text('Asignar Roles: ' + recipient);
	modal.find('#empleado-rol').val(id);
	
	if (ver_empleados === 1) {
		modal.find('#Ver-Empleados').prop('checked', true);
		$('#Editar-Empleados').prop('disabled', false);
		$('#Del-Empleados').prop('disabled', false);
		if (editar_empleados === 1) {
			modal.find('#Editar-Empleados').prop('checked', true);
		}else{
			modal.find('#Editar-Empleados').prop('checked', false);
		}
		if (del_empleados === 1) {
			modal.find('#Del-Empleados').prop('checked', true);
		}else{
			modal.find('#Del-Empleados').prop('checked', false);
		}
	} else {
		modal.find('#Ver-Empleados').prop('checked', false);
		$('#Editar-Empleados').prop('disabled', true);
		$('#Del-Empleados').prop('disabled', true);
		modal.find('#Del-Empleados').prop('checked', false);
		modal.find('#Editar-Empleados').prop('checked', false);
	}
	if (ver_tareas === 1) {
		modal.find('#Ver-Tareas').prop('checked', true);
		$('#Editar-Tareas').prop('disabled', false);
		$('#Del-Tareas').prop('disabled', false);
		if (editar_tareas === 1) {
			modal.find('#Editar-Tareas').prop('checked', true);
		}else{
			modal.find('#Editar-Tareas').prop('checked', false);
		}
		if (del_tareas === 1) {
			modal.find('#Del-Tareas').prop('checked', true);
		}else{
			modal.find('#Del-Tareas').prop('checked', false);
		}
	} else {
		modal.find('#Ver-Tareas').prop('checked', false);
		$('#Editar-Tareas').prop('disabled', true);
		$('#Del-Tareas').prop('disabled', true);
		modal.find('#Del-Tareas').prop('checked', false);
		modal.find('#Editar-Tareas').prop('checked', false);
	}
});


$(document).ready(function() {
	$('#Ver-Empleados').change(function() {
		var isChecked = $(this).prop('checked');
		if (isChecked) {
			$('#Editar-Empleados').prop('disabled', false);
			$('#Del-Empleados').prop('disabled', false);
		} else {
			$('#Editar-Empleados').prop('disabled', true);
			$('#Del-Empleados').prop('disabled', true);
		}
	});

	// Verificar el valor inicial al cargar la página
	var isCheckedInitially = $('#Ver-Empleados').prop('checked');
	if (isCheckedInitially) {
		$('#Editar-Empleados').prop('disabled', false);
		$('#Del-Empleados').prop('disabled', false);
	} else {
		$('#Editar-Empleados').prop('disabled', true);
		$('#Del-Empleados').prop('disabled', true);
	}
	// Función para manejar cambios en el checkbox "Ver Tareas"
	$('#Ver-Tareas').change(function() {
		var isChecked = $(this).prop('checked');
		if (isChecked) {
			$('#Editar-Tareas').prop('disabled', false);
			$('#Del-Tareas').prop('disabled', false);
		} else {
			$('#Editar-Tareas').prop('disabled', true);
			$('#Del-Tareas').prop('disabled', true);
		}
	});

	// Verificar el valor inicial al cargar la página
	var isCheckedInitially = $('#Ver-Tareas').prop('checked');
	if (isCheckedInitially) {
		$('#Editar-Tareas').prop('disabled', false);
		$('#Del-Tareas').prop('disabled', false);
	} else {
		$('#Editar-Tareas').prop('disabled', true);
		$('#Del-Tareas').prop('disabled', true);
	}

	// Marcar o desmarcar todos los checkboxes de empleados al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Empleados').change(function() {
		var isChecked = $(this).prop('checked');
		$('.empleado-checkbox').prop('checked', isChecked);

		// Si el checkbox "Marcar Todos" está marcado, habilitar los checkboxes de acciones
		$('#Editar-Empleados').prop('disabled', !isChecked);
		$('#Del-Empleados').prop('disabled', !isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de empleados
	$('.empleado-checkbox').change(function() {
		var totalEmpleados = $('.empleado-checkbox').length;
		var totalSeleccionados = $('.empleado-checkbox:checked').length;
		
		// Si todos los checkboxes de empleados están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Empleados').prop('checked', totalSeleccionados === totalEmpleados);
		
		// Habilitar o deshabilitar los checkboxes de acciones basado en la selección de empleados
		$('#Editar-Empleados').prop('disabled', totalSeleccionados === 0);
		$('#Del-Empleados').prop('disabled', totalSeleccionados === 0);
	});

	// Marcar o desmarcar todos los checkboxes de empleados al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Tareas').change(function() {
		var isChecked = $(this).prop('checked');
		$('.Tarea-checkbox').prop('checked', isChecked);

		// Si el checkbox "Marcar Todos" está marcado, habilitar los checkboxes de acciones
		$('#Editar-Tareas').prop('disabled', !isChecked);
		$('#Del-Tareas').prop('disabled', !isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Tareas
	$('.Tarea-checkbox').change(function() {
		var totalTareas = $('.Tarea-checkbox').length;
		var totalSeleccionados = $('.Tarea-checkbox:checked').length;
		
		// Si todos los checkboxes de Tareas están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Tareas').prop('checked', totalSeleccionados === totalTareas);
		
		// Habilitar o deshabilitar los checkboxes de acciones basado en la selección de Tareas
		$('#Editar-Tareas').prop('disabled', totalSeleccionados === 0);
		$('#Del-Tareas').prop('disabled', totalSeleccionados === 0);
	});
});

$(document).ready(function() {
	$("#asignarRoles-btn").click(function() {
		var formData = $("#asignarRoles-form").serialize(); // Obtener los datos del formulario
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: formData,
			success: function(response) {
				$("#form-result").val("");
				if (response === 'ok') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						<i class="fas fa-check-circle"></i>
						Roles asignados
						</div>
						`);
					deleteAlert();
					setTimeout(function() {
						location.href = 'Configuraciones-Roles';
					}, 900);
				} else {
					$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						<i class="fas fa-exclamation-triangle"></i>
						<b>Error</b>, no se pudo asignar los roles, intenta nuevamente.
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
	}, 1000);
}
</script>
