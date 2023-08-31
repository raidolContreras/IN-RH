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
												data-name="<?php echo $empleado['nombre']; ?>">
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
						<p class="subtitulo">Tareas</p>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Tareas" id="Ver-Tareas" class="custom-control-input">
							<span class="custom-control-label">Ver Tareas</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Tareas" id="Editar-Tareas" class="custom-control-input" disabled>
							<span class="custom-control-label">Editar Tareas</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Tareas" id="Del-Tareas" class="custom-control-input" disabled>
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
		var id = button.data('id');
		var modal = $(this);
		modal.find('.modal-title').text('Asignar Roles: ' + recipient);
		modal.find('#empleado-rol').val(id);
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
});
$(document).ready(function() {
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
});

</script>
