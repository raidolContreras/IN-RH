<?php 
$permisos = ControladorFormularios::ctrVerPermisos(null,null); 
$empleados_has_permisos = ControladorFormularios::ctrVerPermisosEmpleados($_SESSION['idEmpleado']);
$tiempoContratado = $empleados_has_permisos[0]['tiempoContrato'];
$calculo_vacaciones = ControladorFormularios::ctrCalculoVacacional($tiempoContratado);
$incapacidades = ControladorFormularios::ctrVerIncapacidad(null,null);
$vacaciones = ControladorFormularios::ctrVerSolicitudesVacaciones($_SESSION['idEmpleado']);
$dias_consumidos = 0;
$dias_pendientes = 0;
foreach ($vacaciones as $value) {
	if ($value['respuesta'] == 1) {
		if ($value['status_vacaciones'] == 1 || $value['status_vacaciones'] == 0) {
			$dias_consumidos += $value['dias'];
		}
		if ($value['respuesta'] == null) {
			$dias_pendientes += $value['dias'];
		}
	}
}
$dias_disponibles = $calculo_vacaciones - $dias_consumidos - $dias_pendientes;
?>

<style>

<?php foreach ($permisos as $permiso): ?>
<?php $name = strtr($permiso['namePermisos'], " ", "-"); ?>

.badge-<?php echo $name; ?> {
	background-color: <?php echo $permiso['colorPermisos']; ?>;
}

.badge-<?php echo $name; ?>[href]:focus,
.badge-<?php echo $name; ?>[href]:hover {
	color: #fff;
	background-color: #17c0dc;
	text-decoration: none;
}

.btn-<?php echo $name; ?> {
	color: #343;
	background-color: <?php echo $permiso['colorPermisos']; ?>;
	border-color: <?php echo $permiso['colorPermisos']; ?>;
}
.btn-<?php echo $name; ?>:hover{
	color: #fff;
	background-color: #727A83;
	border-color: #727A83;
}

<?php endforeach ?>


.badge-incapacidad {
	background-color: <?php echo $permiso['colorPermisos']; ?>;
}

.badge-incapacidad[href]:focus,
.badge-incapacidad[href]:hover {
	color: #fff;
	background-color: #17c0dc;
	text-decoration: none;
}

.btn-incapacidad {
	color: #343;
	background-color: #08c738;
	border-color: #08c738;
}
.btn-incapacidad:hover{
	color: #fff;
	background-color: #727A83;
	border-color: #727A83;
}
</style>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row" style="justify-content: center;">
			<div class="col-xl-2 col-lg-12 col-md-12 col-12">
				<div class="card caja">
					<div class="card-header">
						<p class="titulo-tablero titulo">VACACIONES</p>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-6 col-vacations-left p-0 mb-2">
								Saldo inicial:
							</div>
							<div class="col-6 col-vacations-right mb-2">
								<?php echo $calculo_vacaciones; ?> días
							</div>
							<div class="col-6 col-vacations-left p-0 mt-2">
								Aprobadas:
							</div>
							<div class="col-6 col-vacations-right mt-2">
								<?php echo $dias_consumidos ?> días
							</div>
							<div class="col-6 col-vacations-left p-0 mt-3">
								Pendientes:
							</div>
							<div class="col-6 col-vacations-right mt-3">
								<?php echo $dias_pendientes ?> días
							</div>
						</div>
					</div>
						<div class="card-footer row">
							<div class="col-6 col-vacations-left p-0">
								<p class="titulo-tablero titulo">Disponibles</p>
							</div>
							<div class="col-6 col-vacations-right">
								<p class="titulo-tablero titulo"><?php echo $dias_disponibles; ?> días</p>
							</div>
						</div>
					<div class="card-header">
						<?php if ($tiempoContratado == 0): ?>
							<button class="btn btn-vacaciones btn-block rounded" disabled>Solicitar</button>
						<?php else: ?>
						<button type="button" 
						class="btn btn-vacaciones btn-block rounded" id="vacaciones-btn"
						data-toggle="modal"
						data-target="#permiso"
						data-name="Vacaciones"
						data-whatever="0">
								Solicitar
						  </button>
						<?php endif ?>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-12 col-md-12 col-12">
				<div class="card caja contenedor">
					<div class="card-header">
						<p class="titulo-tablero titulo">SOLICITAR PERMISOS</p>
					</div>
						<div class="card-header">
							<p class="subtitulo-tablero mt-3 mb-0">
								Incapacidad
							</p>
							<button type="button" 
								class="btn btn-incapacidad rounded float-right" id="incapacidad-btn"
								data-toggle="modal"
								data-target="#Incapacidad"
								data-name="Incapacidad"
								data-whatever="0">
								Registrar
							</button>
						</div>
					<?php foreach ($permisos as $permiso): ?>
						<?php $name = strtr($permiso['namePermisos'], " ", "-"); ?>
						<div class="card-header">
							<p class="subtitulo-tablero mt-3 mb-0">
								<?php echo $permiso['namePermisos'] ?>
							</p>
							<button type="button" 
								class="btn btn-<?php echo $name; ?> rounded float-right" id="<?php echo $name; ?>-btn"
								data-toggle="modal"
								data-target="#permiso"
								data-name="<?php echo $name; ?>"
								data-whatever="<?php echo $permiso['idPermisos']; ?>">
								Solicitar
							</button>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col-xl-8 col-md-12 col-12">
				<div class="card">
					<div class="card-header">
						HISTORIAL DE AUSENCIAS
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered Puestos">
								<thead>
									<tr>
										<th>Periodo</th>
										<th>Tipo</th>
										<th>Estado</th>
										<th width="10"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($empleados_has_permisos as $value): ?>
										<?php if ($value['idPermiso'] != null): ?>
										<tr>
											<td><?php echo $value['rango'] ?></td>
											<td><?php echo $value['permiso'] ?></td>
											<td>
												<?php if (empty($value['statusPermiso'])): ?>
													<span class="badge-dark p-1 rounded">Pendiente</span>
												<?php elseif ($value['statusPermiso'] == 1): ?>
													<span class="badge-success p-1 rounded">Aprobado</span>
												<?php else: ?>
													<span class="badge-danger p-1 rounded">Rechazado</span>
												<?php endif ?>
											</td>
											<td class="float-right">
												<button class="btn btn-danger rounded-circle btn-sm"
											data-toggle="modal"
											data-target="#eliminar"
											data-name="<?php echo $value['rango']; ?>"
											data-whatever="<?php echo $value['idPermiso']; ?>">
													&times;
											  </button>
											</td>
										</tr>
										<?php endif ?>
									<?php endforeach ?>
									<?php foreach ($vacaciones as $vacacion): ?>
										<?php if ($vacacion['status_vacaciones'] == 1): ?>
										<tr>
											<?php if ($vacacion['respuesta'] == 2): ?>
												<td><button class="btn btn-secondary-link"><?php echo $vacacion['rango'] ?></button></td>
											<?php else: ?>
												<td><?php echo $vacacion['rango'] ?></td>
											<?php endif ?>
											<td>Solicitud de vacaciones</td>
											<td>
												<?php if (empty($vacacion['respuesta'])): ?>
													<span class="badge-dark p-1 rounded">Pendiente</span>
												<?php elseif ($vacacion['respuesta'] == 1): ?>
													<span class="badge-success p-1 rounded">Aprobado</span>
												<?php else: ?>
													<span class="badge-danger p-1 rounded">Rechazado</span>
												<?php endif ?>
											</td>
											<td class="float-right">
												<button class="btn btn-danger rounded-circle btn-sm"
													data-toggle="modal"
													data-target="#eliminarV"
													data-name="<?php echo $vacacion['rango']; ?>"
													data-whatever="<?php echo $vacacion['idVacaciones']; ?>">
													&times;
											  </button>
											</td>
										</tr>
										<?php endif ?>
									<?php endforeach ?>
									<?php foreach ($incapacidades as $incapacidad): ?>
										<?php if ($incapacidad['Empleados_idEmpleados'] == $_SESSION['idEmpleado'] && $incapacidad['status'] == 1): ?>
										<tr>
											<td><?php echo $incapacidad['rango'] ?></td>
											<td>Informe de Incapacidad</td>
											<td><span class="badge-success p-1 rounded">Aprobado</span></td>
											<td class="float-right">
												<button class="btn btn-danger rounded-circle btn-sm"
													data-toggle="modal"
													data-target="#eliminarI"
													data-name="<?php echo $incapacidad['rango']; ?>"
													data-whatever="<?php echo $incapacidad['idIncapacidades']; ?>">
													&times;
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

<?php include 'view/pages/Horarios/Modals/SolicitudAusencia.php' ?>
<?php include 'view/pages/Horarios/Modals/Incapacidad.php' ?>
<?php include 'view/pages/Horarios/Modals/DelSolicitud.php' ?>
<?php include 'view/pages/Horarios/Modals/DelSolicitudVacaciones.php' ?>
<?php include 'view/pages/Horarios/Modals/DelSolicitudIncapacidades.php' ?>

<script src="assets/libs/js/generar_permisos_vacaciones.js"></script>
<script>
	
$(document).ready(function() {
	$('#ramo_seguro').change(function() {
		var selectedOption = $(this).val();
		if (selectedOption === "1") {
			$('#tipo_riesgo').prop('disabled', false);
			$('#secuela_consecuencia').prop('disabled', false);
		} else {
			$('#tipo_riesgo').prop('disabled', true);
			$('#tipo_riesgo').val('Selecciona un tipo de riesgo'); // Establecer el valor en una cadena vacía
			$('#secuela_consecuencia').prop('disabled', true);
			$('#secuela_consecuencia').val('Selecciona una opción'); // Establecer el valor en una cadena vacía
		}
	});

	// Verificar el valor inicial al cargar la página
	if ($('#ramo_seguro').val() === '') {
		$('#tipo_riesgo').prop('disabled', true);
		$('#tipo_riesgo').val('Selecciona un tipo de riesgo'); // Establecer el valor en una cadena vacía
		$('#secuela_consecuencia').prop('disabled', true);
		$('#secuela_consecuencia').val('Selecciona una opción'); // Establecer el valor en una cadena vacía
	}
});

    // Función para calcular la fecha de término
    function calcularFechaTermino() {
        // Obtén los valores de fecha de inicio y días
        const fechaInicio = new Date(document.getElementById("fecha_inicio").value);
        const dias = parseInt(document.getElementById("dias").value);

        if (!isNaN(dias) && fechaInicio instanceof Date && !isNaN(fechaInicio.getTime())) {
            // Calcula la fecha de término sumando los días a la fecha de inicio
            fechaInicio.setDate(fechaInicio.getDate() + dias);

            // Formatea la fecha de término como "yyyy-MM-dd"
            const año = fechaInicio.getFullYear();
            const mes = (fechaInicio.getMonth() + 1).toString().padStart(2, "0");
            const dia = fechaInicio.getDate().toString().padStart(2, "0");

            // Actualiza el campo de fecha de término
            document.getElementById("fecha_termino").value = `${año}-${mes}-${dia}`;
            document.getElementById("fecha_termino_envio").value = `${año}-${mes}-${dia}`;
        } else {
            // Si los valores no son válidos, borra el campo de fecha de término
            document.getElementById("fecha_termino").value = "";
            document.getElementById("fecha_termino_envio").value = "";
        }
    }

    // Asocia la función de cálculo con los eventos de cambio en fecha de inicio y días
    document.getElementById("fecha_inicio").addEventListener("change", calcularFechaTermino);
    document.getElementById("dias").addEventListener("input", calcularFechaTermino);
</script>

