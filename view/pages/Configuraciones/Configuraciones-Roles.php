<?php if (!empty($rol) && $rol['Configuracion_Permisos'] == 1): ?>
<?php 
$Ver_Empleados = 0;
$Editar_Empleados = 0;
$Del_Empleados = 0;
$Ver_Departamentos = 0;
$Editar_Departamentos = 0;
$Del_Departamentos = 0;
$Ver_Evaluaciones = 0;
$Editar_Evaluaciones = 0;
$Del_Evaluaciones = 0;
$Ver_Tareas = 0;
$Editar_Tareas = 0;
$Del_Tareas = 0;
$Resumenes_Asistencias = 0;
$Ajustes_Asistencias = 0;
$Asignar_EmpleadoMes = 0;
$Ver_Analisis = 0;
$Ver_Reclutamiento = 0;
$Editar_Reclutamiento = 0;
$Del_Reclutamiento = 0;
$Ver_Organigramas = 0;
$Agregar_Noticias = 0;
$Editar_Noticias = 0;
$Del_Noticias = 0;
$Ver_Empresas = 0;
$Editar_Empresas = 0;
$Configuracion_Divisas = 0;
$Configuracion_Categorias = 0;
$Configuracion_Permisos = 0;
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
							Gestionar permisos del sistema
						</div>
					</div>
					<?php $empleados = ControladorEmpleados::ctrVerEmpleados(null,null); ?>
					<div class="card-body">
						<div class="table-responsive p-2">
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
									if ($empleado['status'] == 1):
									$puestos = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $empleado['idEmpleados']);
									$departamentos = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puestos['Departamentos_idDepartamentos']);
									$empresas = ControladorFormularios::ctrVerEmpresas("idEmpresas", $departamentos['Empresas_idEmpresas']);
									$rol = ModeloFormularios::mdlVerRoles("Empleados_idEmpleados", $empleado['idEmpleados']);
									if (!empty($rol)) {
										$Ver_Empleados = $rol['Ver_Empleados'];
										$Editar_Empleados = $rol['Editar_Empleados'];
										$Del_Empleados = $rol['Del_Empleados'];
										$Ver_Departamentos = $rol['Ver_Departamentos'];
										$Editar_Departamentos = $rol['Editar_Departamentos'];
										$Del_Departamentos = $rol['Del_Departamentos'];
										$Ver_Evaluaciones = $rol['Ver_Evaluaciones'];
										$Editar_Evaluaciones = $rol['Editar_Evaluaciones'];
										$Del_Evaluaciones = $rol['Del_Evaluaciones'];
										$Resumenes_Asistencias = $rol['Resumenes_Asistencias'];
										$Ajustes_Asistencias = $rol['Ajustes_Asistencias'];
										$Ver_Tareas = $rol['Ver_Tareas'];
										$Editar_Tareas = $rol['Editar_Tareas'];
										$Del_Tareas = $rol['Del_Tareas'];
										$Asignar_EmpleadoMes = $rol['Asignar_EmpleadoMes'];
										$Ver_Analisis = $rol['Ver_Analisis'];
										$Ver_Reclutamiento = $rol['Ver_Reclutamiento'];
										$Editar_Reclutamiento = $rol['Editar_Reclutamiento'];
										$Del_Reclutamiento = $rol['Del_Reclutamiento'];
										$Ver_Organigramas = $rol['Ver_Organigramas'];
										$Agregar_Noticias = $rol['Agregar_Noticias'];
										$Editar_Noticias = $rol['Editar_Noticias'];
										$Del_Noticias = $rol['Del_Noticias'];
										$Ver_Empresas = $rol['Ver_Empresas'];
										$Editar_Empresas = $rol['Editar_Empresas'];
										$Configuracion_Divisas = $rol['Configuracion_Divisas'];
										$Configuracion_Categorias = $rol['Configuracion_Categorias'];
										$Configuracion_Permisos = $rol['Configuracion_Permisos'];
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
												data-Ver_Departamentos="<?php echo $Ver_Departamentos; ?>"
												data-Editar_Departamentos="<?php echo $Editar_Departamentos; ?>"
												data-Del_Departamentos="<?php echo $Del_Departamentos; ?>"
												data-Ver_Evaluacion="<?php echo $Ver_Evaluaciones; ?>"
												data-Editar_Evaluacion="<?php echo $Editar_Evaluaciones; ?>"
												data-Del_Evaluacion="<?php echo $Del_Evaluaciones; ?>"
												data-Resumenes_Asistencias="<?php echo $Resumenes_Asistencias; ?>"
												data-Ajustes_Asistencias="<?php echo $Ajustes_Asistencias; ?>"
												data-Ver_Tareas="<?php echo $Ver_Tareas; ?>"
												data-Editar_Tareas="<?php echo $Editar_Tareas; ?>"
												data-Del_Tareas="<?php echo $Del_Tareas; ?>"
												data-Asignar_EmpleadoMes="<?php echo $Asignar_EmpleadoMes; ?>"
												data-Ver_Analisis="<?php echo $Ver_Analisis; ?>"
												data-Ver_Reclutamiento="<?php echo $Ver_Reclutamiento; ?>"
												data-Editar_Reclutamiento="<?php echo $Editar_Reclutamiento; ?>"
												data-Del_Reclutamiento="<?php echo $Del_Reclutamiento; ?>"
												data-Ver_Organigramas="<?php echo $Ver_Organigramas; ?>"
												data-Agregar_Noticias="<?php echo $Agregar_Noticias; ?>"
												data-Editar_Noticias="<?php echo $Editar_Noticias; ?>"
												data-Del_Noticias="<?php echo $Del_Noticias; ?>"
												data-Ver_Empresas="<?php echo $Ver_Empresas; ?>"
												data-Editar_Empresas="<?php echo $Editar_Empresas; ?>"
												data-Configuracion_Divisas="<?php echo $Configuracion_Divisas; ?>"
												data-Configuracion_Categorias="<?php echo $Configuracion_Categorias; ?>"
												data-Configuracion_Permisos="<?php echo $Configuracion_Permisos; ?>">
												<i class="fas fa-clipboard-list"></i>
											</button>
										</td>
									</tr>
									<?php endif ?>
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
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Empleados</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Empleados" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Empleados" id="Ver-Empleados" class="empleado-checkbox custom-control-input-look">
							<span class="custom-control-label">Ver</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Empleados" id="Editar-Empleados" class="empleado-checkbox custom-control-input-edit" disabled>
							<span class="custom-control-label">Editar</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Empleados" id="Del-Empleados" class="empleado-checkbox custom-control-input-trash" disabled>
							<span class="custom-control-label">Eliminar</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Departamentos</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Departamentos" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Departamentos" id="Ver-Departamentos" class="departamentos-checkbox custom-control-input-look">
							<span class="custom-control-label">Ver</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Departamentos" id="Editar-Departamentos" class="departamentos-checkbox custom-control-input-edit" disabled>
							<span class="custom-control-label">Editar</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Departamentos" id="Del-Departamentos" class="departamentos-checkbox custom-control-input-trash" disabled>
							<span class="custom-control-label">Eliminar</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Asistencias</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Asistencias" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Resumenes-Asistencias" id="Resumenes-Asistencias" class=" Asistencia-checkbox custom-control-input-look">
							<span class="custom-control-label">Resumenes</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ajustes-Asistencias" id="Ajustes-Asistencias" class=" Asistencia-checkbox custom-control-input-look">
							<span class="custom-control-label">Ajustes</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Evaluaciones</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Evaluaciones" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Evaluaciones" id="Ver-Evaluaciones" class=" evaluacion-checkbox custom-control-input-look">
							<span class="custom-control-label">Ver</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Evaluaciones" id="Editar-Evaluaciones" class=" evaluacion-checkbox custom-control-input-edit" disabled>
							<span class="custom-control-label">Editar</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Evaluaciones" id="Del-Evaluaciones" class=" evaluacion-checkbox custom-control-input-trash" disabled>
							<span class="custom-control-label">Eliminar</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Tareas</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Tareas" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Tareas" id="Ver-Tareas" class=" tareas-checkbox custom-control-input-look">
							<span class="custom-control-label">Ver</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Tareas" id="Editar-Tareas" class=" tareas-checkbox custom-control-input-edit" disabled>
							<span class="custom-control-label">Editar</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Tareas" id="Del-Tareas" class=" tareas-checkbox custom-control-input-trash" disabled>
							<span class="custom-control-label">Eliminar</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Reclutamiento</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Reclutamiento" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Reclutamiento" id="Ver-Reclutamiento" class=" reclutamiento-checkbox custom-control-input-look">
							<span class="custom-control-label">Ver</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Reclutamiento" id="Editar-Reclutamiento" class=" reclutamiento-checkbox custom-control-input-edit" disabled>
							<span class="custom-control-label">Editar</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Reclutamiento" id="Del-Reclutamiento" class=" reclutamiento-checkbox custom-control-input-trash" disabled>
							<span class="custom-control-label">Eliminar</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Noticias</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Noticias" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Agregar-Noticias" id="Agregar-Noticias" class=" noticias-checkbox custom-control-input-look">
							<span class="custom-control-label">Agregar</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Noticias" id="Editar-Noticias" class=" noticias-checkbox custom-control-input-edit">
							<span class="custom-control-label">Editar</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Del-Noticias" id="Del-Noticias" class=" noticias-checkbox custom-control-input-trash">
							<span class="custom-control-label">Eliminar</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Empresas</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Empresas" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Ver-Empresas" id="Ver-Empresas" class=" empresas-checkbox custom-control-input-look">
							<span class="custom-control-label">Ver</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Editar-Empresas" id="Editar-Empresas" class=" empresas-checkbox custom-control-input-edit" disabled>
							<span class="custom-control-label">Editar</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Configuracion</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" id="Marcar-Todos-Configuraciones" class="custom-control-input">
							<span class="custom-control-label">Marcar Todos</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Configuracion-Divisas" id="Configuracion-Divisas" class=" configuraciones-checkbox custom-control-input-edit">
							<span class="custom-control-label">Divisas</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Configuracion-Categorias" id="Configuracion-Categorias" class=" configuraciones-checkbox custom-control-input-edit">
							<span class="custom-control-label">Categorias</span>
						</label>
						<label class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" Name="Configuracion-Permisos" id="Configuracion-Permisos" class=" configuraciones-checkbox custom-control-input-edit">
							<span class="custom-control-label">Permisos</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Empleado del mes</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" Name="Asignar-EmpleadoMes" id="Asignar-EmpleadoMes" class="custom-control-input-look">
							<span class="custom-control-label">Asignar</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Análisis</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" Name="Ver-Analisis" id="Ver-Analisis" class="custom-control-input-look">
							<span class="custom-control-label">Ver</span>
						</label>
					</div>
					<div class="col-sm-6 mt-3">
						<hr>
						<strong><p class="subtitulo mb-0">Organigramas</p></strong>
						<label class="custom-control custom-checkbox custom-control mb-0">
							<input type="checkbox" Name="Ver-Organigramas" id="Ver-Organigramas" class="custom-control-input-look">
							<span class="custom-control-label">Ver Todos</span>
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

	var id = button.data('id');
	var recipient = button.data('name');
	// Permisos Empleados
	var ver_empleados = button.data('ver_empleados');
	var editar_empleados = button.data('editar_empleados');
	var del_empleados = button.data('del_empleados');
	// Permisos Departamentos
	var ver_departamentos = button.data('ver_departamentos');
	var editar_departamentos = button.data('editar_departamentos');
	var del_departamentos = button.data('del_departamentos');
	// Permisos Evaluaciones
	var ver_evaluacion = button.data('ver_evaluacion');
	var editar_evaluacion = button.data('editar_evaluacion');
	var del_evaluacion = button.data('del_evaluacion');
	// Permisos Tareas
	var ver_tareas =  button.data('ver_tareas');
	var editar_tareas =  button.data('editar_tareas');
	var del_tareas =  button.data('del_tareas');
	// Permisos Asistencias
	var resumenes_asistencias = button.data('resumenes_asistencias');
	var ajustes_asistencias = button.data('ajustes_asistencias');
	// Permisos Analisís e informes
	var ver_analisis =  button.data('ver_analisis');
	// Permisos Empleado del Mes
	var asignar_empleadomes =  button.data('asignar_empleadomes');
	// Ver todos los organigramas
	var ver_organigramas =  button.data('ver_organigramas');
	// Permisos Reclutamiento
	var ver_reclutamiento = button.data('ver_reclutamiento');
	var editar_reclutamiento = button.data('editar_reclutamiento');
	var del_reclutamiento = button.data('del_reclutamiento');
	// Permisos Noticias
	var agregar_noticias = button.data('agregar_noticias');
	var editar_noticias = button.data('editar_noticias');
	var del_noticias = button.data('del_noticias');
	// Permisos Noticias
	var ver_empresas = button.data('ver_empresas');
	var editar_empresas = button.data('editar_empresas');
	// Permisos Configuraciones
	var configuracion_divisas = button.data('configuracion_divisas');
	var configuracion_categorias = button.data('configuracion_categorias');
	var configuracion_permisos = button.data('configuracion_permisos');

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
	
	if (ver_empresas === 1) {
		modal.find('#Ver-Empresas').prop('checked', true);
		$('#Editar-Empresas').prop('disabled', false);
		if (editar_empresas === 1) {
			modal.find('#Editar-Empresas').prop('checked', true);
		}else{
			modal.find('#Editar-Empresas').prop('checked', false);
		}
	} else {
		modal.find('#Ver-Empresas').prop('checked', false);
		$('#Editar-Empresas').prop('disabled', true);
		modal.find('#Editar-Empresas').prop('checked', false);
	}
	
	if (ver_departamentos === 1) {
		modal.find('#Ver-Departamentos').prop('checked', true);
		$('#Editar-Departamentos').prop('disabled', false);
		$('#Del-Departamentos').prop('disabled', false);
		if (editar_departamentos === 1) {
			modal.find('#Editar-Departamentos').prop('checked', true);
		}else{
			modal.find('#Editar-Departamentos').prop('checked', false);
		}
		if (del_departamentos === 1) {
			modal.find('#Del-Departamentos').prop('checked', true);
		}else{
			modal.find('#Del-Departamentos').prop('checked', false);
		}
	} else {
		modal.find('#Ver-Departamentos').prop('checked', false);
		$('#Editar-Departamentos').prop('disabled', true);
		$('#Del-Departamentos').prop('disabled', true);
		modal.find('#Del-Departamentos').prop('checked', false);
		modal.find('#Editar-Departamentos').prop('checked', false);
	}

	
	if (ver_evaluacion === 1) {
		modal.find('#Ver-Evaluaciones').prop('checked', true);
		$('#Editar-Evaluaciones').prop('disabled', false);
		$('#Del-Evaluaciones').prop('disabled', false);
		if (editar_evaluacion === 1) {
			modal.find('#Editar-Evaluaciones').prop('checked', true);
		}else{
			modal.find('#Editar-Evaluaciones').prop('checked', false);
		}
		if (del_evaluacion === 1) {
			modal.find('#Del-Evaluaciones').prop('checked', true);
		}else{
			modal.find('#Del-Evaluaciones').prop('checked', false);
		}
	} else {
		modal.find('#Ver-Evaluaciones').prop('checked', false);
		$('#Editar-Evaluaciones').prop('disabled', true);
		$('#Del-Evaluaciones').prop('disabled', true);
		modal.find('#Del-Evaluaciones').prop('checked', false);
		modal.find('#Editar-Evaluaciones').prop('checked', false);
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

	if (agregar_noticias === 1) {
		modal.find('#Agregar-Noticias').prop('checked', true);
	}else{
		modal.find('#Agregar-Noticias').prop('checked', false);
	}

	if (editar_noticias === 1) {
		modal.find('#Editar-Noticias').prop('checked', true);
	}else{
		modal.find('#Editar-Noticias').prop('checked', false);
	}

	if (del_noticias === 1) {
		modal.find('#Del-Noticias').prop('checked', true);
	}else{
		modal.find('#Del-Noticias').prop('checked', false);
	}

	if (resumenes_asistencias === 1) {
		modal.find('#Resumenes-Asistencias').prop('checked', true);
	}else{
		modal.find('#Resumenes-Asistencias').prop('checked', false);
	}
	
	if (ajustes_asistencias === 1) {
		modal.find('#Ajustes-Asistencias').prop('checked', true);
	}else{
		modal.find('#Ajustes-Asistencias').prop('checked', false);
	}
	
	if (asignar_empleadomes === 1) {
		modal.find('#Asignar-EmpleadoMes').prop('checked', true);
	}else{
		modal.find('#Asignar-EmpleadoMes').prop('checked', false);
	}
	
	if (ver_analisis === 1) {
		modal.find('#Ver-Analisis').prop('checked', true);
	}else{
		modal.find('#Ver-Analisis').prop('checked', false);
	}
	
	if (ver_organigramas === 1) {
		modal.find('#Ver-Organigramas').prop('checked', true);
	}else{
		modal.find('#Ver-Organigramas').prop('checked', false);
	}
	
	if (configuracion_divisas === 1) {
		modal.find('#Configuracion-Divisas').prop('checked', true);
	}else{
		modal.find('#Configuracion-Divisas').prop('checked', false);
	}
	
	if (configuracion_categorias === 1) {
		modal.find('#Configuracion-Categorias').prop('checked', true);
	}else{
		modal.find('#Configuracion-Categorias').prop('checked', false);
	}
	
	if (configuracion_permisos === 1) {
		modal.find('#Configuracion-Permisos').prop('checked', true);
	}else{
		modal.find('#Configuracion-Ppermisos').prop('checked', false);
	}
	
	if (ver_reclutamiento === 1) {
		modal.find('#Ver-Reclutamiento').prop('checked', true);
		$('#Editar-Reclutamiento').prop('disabled', false);
		$('#Del-Reclutamiento').prop('disabled', false);
		if (editar_reclutamiento === 1) {
			modal.find('#Editar-Reclutamiento').prop('checked', true);
		}else{
			modal.find('#Editar-Reclutamiento').prop('checked', false);
		}
		if (del_reclutamiento === 1) {
			modal.find('#Del-Reclutamiento').prop('checked', true);
		}else{
			modal.find('#Del-Reclutamiento').prop('checked', false);
		}
	} else {
		modal.find('#Ver-Reclutamiento').prop('checked', false);
		$('#Editar-Reclutamiento').prop('disabled', true);
		$('#Del-Reclutamiento').prop('disabled', true);
		modal.find('#Del-Reclutamiento').prop('checked', false);
		modal.find('#Editar-Reclutamiento').prop('checked', false);
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
		var totalSeleccionadosEmpleados = $('.empleado-checkbox:checked').length;
		
		// Si todos los checkboxes de empleados están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Empleados').prop('checked', totalSeleccionadosEmpleados === totalEmpleados);
		
		// Habilitar o deshabilitar los checkboxes de acciones basado en la selección de empleados
		$('#Editar-Empleados').prop('disabled', totalSeleccionadosEmpleados === 0);
		$('#Del-Empleados').prop('disabled', totalSeleccionadosEmpleados === 0);
	});

	$('#Ver-Empresas').change(function() {
		var isChecked = $(this).prop('checked');
		if (isChecked) {
			$('#Editar-Empresas').prop('disabled', false);
		} else {
			$('#Editar-Empresas').prop('disabled', true);
		}
	});

	// Verificar el valor inicial al cargar la página
	var isCheckedInitially = $('#Ver-Empresas').prop('checked');
	if (isCheckedInitially) {
		$('#Editar-Empresas').prop('disabled', false);
	} else {
		$('#Editar-Empresas').prop('disabled', true);
	}

	// Marcar o desmarcar todos los checkboxes de Empresas al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Empresas').change(function() {
		var isChecked = $(this).prop('checked');
		$('.empresas-checkbox').prop('checked', isChecked);

		// Si el checkbox "Marcar Todos" está marcado, habilitar los checkboxes de acciones
		$('#Editar-Empresas').prop('disabled', !isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Empresas
	$('.empresas-checkbox').change(function() {
		var totalEmpresas = $('.empresas-checkbox').length;
		var totalSeleccionadosEmpresas = $('.empresas-checkbox:checked').length;
		
		// Si todos los checkboxes de Empresas están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Empresas').prop('checked', totalSeleccionadosEmpresas === totalEmpresas);
		
		// Habilitar o deshabilitar los checkboxes de acciones basado en la selección de Empresas
		$('#Editar-Empresas').prop('disabled', totalSeleccionadosEmpresas === 0);
	});

	// Marcar o desmarcar todos los checkboxes de Noticias al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Noticias').change(function() {
		var isChecked = $(this).prop('checked');
		$('.noticias-checkbox').prop('checked', isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Noticias
	$('.noticias-checkbox').change(function() {
		var totalNoticias = $('.noticias-checkbox').length;
		var totalSeleccionadosNoticias = $('.noticias-checkbox:checked').length;
		
		// Si todos los checkboxes de Noticias están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Noticias').prop('checked', totalSeleccionadosNoticias === totalNoticias);
	});

	// Marcar o desmarcar todos los checkboxes de Configuraciones al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Configuraciones').change(function() {
		var isChecked = $(this).prop('checked');
		$('.configuraciones-checkbox').prop('checked', isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Noticias
	$('.configuraciones-checkbox').change(function() {
		var totalConfiguraciones = $('.configuraciones-checkbox').length;
		var totalSeleccionadosConfiguraciones = $('.configuraciones-checkbox:checked').length;
		
		// Si todos los checkboxes de Configuraciones están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Configuraciones').prop('checked', totalSeleccionadosConfiguraciones === totalConfiguraciones);
	});
	
	$('#Ver-Departamentos').change(function() {
		var isChecked = $(this).prop('checked');
		if (isChecked) {
			$('#Editar-Departamentos').prop('disabled', false);
			$('#Del-Departamentos').prop('disabled', false);
		} else {
			$('#Editar-Departamentos').prop('disabled', true);
			$('#Del-Departamentos').prop('disabled', true);
		}
	});

	// Verificar el valor inicial al cargar la página
	var isCheckedInitially = $('#Ver-Departamentos').prop('checked');
	if (isCheckedInitially) {
		$('#Editar-Departamentos').prop('disabled', false);
		$('#Del-Departamentos').prop('disabled', false);
	} else {
		$('#Editar-Departamentos').prop('disabled', true);
		$('#Del-Departamentos').prop('disabled', true);
	}

	// Marcar o desmarcar todos los checkboxes de Departamentos al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Departamentos').change(function() {
		var isChecked = $(this).prop('checked');
		$('.departamentos-checkbox').prop('checked', isChecked);

		// Si el checkbox "Marcar Todos" está marcado, habilitar los checkboxes de acciones
		$('#Editar-Departamentos').prop('disabled', !isChecked);
		$('#Del-Departamentos').prop('disabled', !isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Departamentos
	$('.departamentos-checkbox').change(function() {
		var totalDepartamentos = $('.departamentos-checkbox').length;
		var totalSeleccionadosDepartamentos = $('.departamentos-checkbox:checked').length;
		
		// Si todos los checkboxes de Departamentos están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Departamentos').prop('checked', totalSeleccionadosDepartamentos === totalDepartamentos);
		
		// Habilitar o deshabilitar los checkboxes de acciones basado en la selección de Departamentos
		$('#Editar-Departamentos').prop('disabled', totalSeleccionadosDepartamentos === 0);
		$('#Del-Departamentos').prop('disabled', totalSeleccionadosDepartamentos === 0);
	});

	$('#Ver-Evaluaciones').change(function() {
		var isChecked = $(this).prop('checked');
		if (isChecked) {
			$('#Editar-Evaluaciones').prop('disabled', false);
			$('#Del-Evaluaciones').prop('disabled', false);
		} else {
			$('#Editar-Evaluaciones').prop('disabled', true);
			$('#Del-Evaluaciones').prop('disabled', true);
		}
	});

	// Verificar el valor inicial al cargar la página
	var isCheckedInitially = $('#Ver-Evaluaciones').prop('checked');
	if (isCheckedInitially) {
		$('#Editar-Evaluaciones').prop('disabled', false);
		$('#Del-Evaluaciones').prop('disabled', false);
	} else {
		$('#Editar-Evaluaciones').prop('disabled', true);
		$('#Del-Evaluaciones').prop('disabled', true);
	}

	// Marcar o desmarcar todos los checkboxes de Evaluaciones al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Evaluaciones').change(function() {
		var isChecked = $(this).prop('checked');
		$('.evaluacion-checkbox').prop('checked', isChecked);

		// Si el checkbox "Marcar Todos" está marcado, habilitar los checkboxes de acciones
		$('#Editar-Evaluaciones').prop('disabled', !isChecked);
		$('#Del-Evaluaciones').prop('disabled', !isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Evaluaciones
	$('.evaluacion-checkbox').change(function() {
		var totalEvaluaciones = $('.evaluacion-checkbox').length;
		var totalSeleccionadosEvaluaciones = $('.evaluacion-checkbox:checked').length;
		
		// Si todos los checkboxes de Evaluaciones están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Evaluaciones').prop('checked', totalSeleccionadosEvaluaciones === totalEvaluaciones);
		
		// Habilitar o deshabilitar los checkboxes de acciones basado en la selección de Evaluaciones
		$('#Editar-Evaluaciones').prop('disabled', totalSeleccionadosEvaluaciones === 0);
		$('#Del-Evaluaciones').prop('disabled', totalSeleccionadosEvaluaciones === 0);
	});

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
	// Marcar o desmarcar todos los checkboxes de Tareas al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Tareas').change(function() {
		var isChecked = $(this).prop('checked');
		$('.tareas-checkbox').prop('checked', isChecked);

		// Si el checkbox "Marcar Todos" está marcado, habilitar los checkboxes de acciones
		$('#Editar-Tareas').prop('disabled', !isChecked);
		$('#Del-Tareas').prop('disabled', !isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Tareas
	$('.tareas-checkbox').change(function() {
		var totalTareas = $('.tareas-checkbox').length;
		var totalSeleccionadosTareas = $('.tareas-checkbox:checked').length;
		
		// Si todos los checkboxes de Tareas están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Tareas').prop('checked', totalSeleccionadosTareas === totalTareas);
		
		// Habilitar o deshabilitar los checkboxes de acciones basado en la selección de Tareas
		$('#Editar-Tareas').prop('disabled', totalSeleccionadosTareas === 0);
		$('#Del-Tareas').prop('disabled', totalSeleccionadosTareas === 0);
	});

	$('#Ver-Reclutamiento').change(function() {
		var isChecked = $(this).prop('checked');
		if (isChecked) {
			$('#Editar-Reclutamiento').prop('disabled', false);
			$('#Del-Reclutamiento').prop('disabled', false);
		} else {
			$('#Editar-Reclutamiento').prop('disabled', true);
			$('#Del-Reclutamiento').prop('disabled', true);
		}
	});

	// Verificar el valor inicial al cargar la página
	var isCheckedInitially = $('#Ver-Reclutamiento').prop('checked');
	if (isCheckedInitially) {
		$('#Editar-Reclutamiento').prop('disabled', false);
		$('#Del-Reclutamiento').prop('disabled', false);
	} else {
		$('#Editar-Reclutamiento').prop('disabled', true);
		$('#Del-Reclutamiento').prop('disabled', true);
	}

	// Marcar o desmarcar todos los checkboxes de Reclutamiento al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Reclutamiento').change(function() {
		var isChecked = $(this).prop('checked');
		$('.reclutamiento-checkbox').prop('checked', isChecked);

		// Si el checkbox "Marcar Todos" está marcado, habilitar los checkboxes de acciones
		$('#Editar-Reclutamiento').prop('disabled', !isChecked);
		$('#Del-Reclutamiento').prop('disabled', !isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Reclutamiento
	$('.reclutamiento-checkbox').change(function() {
		var totalReclutamiento = $('.reclutamiento-checkbox').length;
		var totalSeleccionadosReclutamiento = $('.reclutamiento-checkbox:checked').length;
		
		// Si todos los checkboxes de Reclutamiento están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Reclutamiento').prop('checked', totalSeleccionadosReclutamiento === totalReclutamiento);
		
		// Habilitar o deshabilitar los checkboxes de acciones basado en la selección de Reclutamiento
		$('#Editar-Reclutamiento').prop('disabled', totalSeleccionadosReclutamiento === 0);
		$('#Del-Reclutamiento').prop('disabled', totalSeleccionadosReclutamiento === 0);
	});

	// Marcar o desmarcar todos los checkboxes de empleados al hacer clic en "Marcar Todos"
	$('#Marcar-Todos-Asistencias').change(function() {
		var isChecked = $(this).prop('checked');
		$('.Asistencia-checkbox').prop('checked', isChecked);
	});

	// Manejar el cambio en los checkboxes individuales de Asistencias
	$('.Asistencia-checkbox').change(function() {
		var totalAsistencias = $('.Asistencia-checkbox').length;
		var totalSeleccionadosAsistencias = $('.Asistencia-checkbox:checked').length;
		
		// Si todos los checkboxes de Asistencias están seleccionados, marcar el checkbox "Marcar Todos"
		$('#Marcar-Todos-Asistencias').prop('checked', totalSeleccionadosAsistencias === totalAsistencias);
		
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
<?php else: ?>
	<script>
		window.location.href="Inicio";
	</script>
<?php endif ?>