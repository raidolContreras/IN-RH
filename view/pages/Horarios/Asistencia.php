<?php $permisos = ControladorFormularios::ctrVerPermisos(null,null); 
$justificantes = ControladorEmpleados::ctrAsistenciasJustificantes();
?>
<link href='assets/vendor/full-calendar/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/vendor/full-calendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><!-- Agrega esta línea en el head de tu HTML -->

<style>

.status{
	display: flex;
	letter-spacing: 0.6px;
	justify-content: space-evenly;
	flex-wrap: wrap;
	align-content: center;
}

.Aprobado{
	margin-left: 10px;
	padding-left: 5px;
	padding-right: 5px;
	border-radius: 100px;
	background-color: #52DC96;
	color: #fff;
}

.Rechazado{
	margin-left: 10px;
	padding-left: 5px;
	padding-right: 5px;
	border-radius: 100px;
	background-color: #EEAB59;
	color: #fff;
}

.Pendiente{
	margin-left: 10px;
	padding-left: 5px;
	padding-right: 5px;
	border-radius: 100px;
	background-color: #DCDCDC;
	color: #5C5C5C;
}

.fc-nonbusiness {
	background: #BABABA;
}
	
.fc-disabled-day {
	background: #FFF !important;
}
	
.badge-Presente {
	color: #343;
	background-color: #0EE276;
}
.badge-Retardo {
	color: #343;
	background-color: #EF890C;
}
.badge-Ausente {
	color: #343;
	background-color: #EC5869;
}

<?php foreach ($permisos as $permiso): ?>
	
.badge-<?php echo strtr($permiso['namePermisos'], " ", "-"); ?> {
	color: #343;
	background-color: <?php echo $permiso['colorPermisos']; ?>;
}
	
<?php endforeach ?>
	
</style>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row">
			<div class="col-xl-9 col-lg-8 col-md-10 col-sm-12 col-12">
				<div class="card">
					<div class="card-body">
						<div id="horarios"></div>
					</div>
				</div>
			</div>
			<div id="values" class="col-xl-3 col-lg-4 col-md-2 col-sm-12 col-12 order-first order-md-last">
				<div class="row">
					<div class="col-12 card">
						<div class="card-body">
							<form id="exportarExcel-form">
								<input type="hidden" name="genExcel" value="<?php echo $_SESSION['idEmpleado'] ?>">
								<button type="button" class="btn btn-outline-success btn-rounded btn-block btn-lg" id="exportarExcel-btn">
									<i class="mdi mdi-download"></i> Exportar a Excel
								</button>
							</form>
						</div>
					</div>
					<div class="col-12 card">
						<div class="card-body">
							<span class="mr-2 badge badge-Presente">Presente</span>
							<span class="mr-2 badge badge-Retardo">Retardo</span>
							<span class="mr-2 badge badge-Ausente">Ausente</span>
							<?php foreach ($permisos as $permiso): ?>
								<span class="mr-2 mt-2 badge badge-<?php echo strtr($permiso['namePermisos'], " ", "-"); ?>">
									<?php echo $permiso['namePermisos'] ?>
								</span>
							<?php endforeach ?>
						</div>
					</div>
					<div class="col-12 card">
						<div class="card-body mb-2">
							<p class="encabezado-h">Solicitudes</p>
							<?php foreach ($justificantes as $justificante): ?>
								<?php if ($justificante['Comentario'] != null): 
									$estado = ($justificante['status_justificante'] == 1) ? 'Aprobado' : (($justificante['status_justificante'] !== null) ? 'Rechazado' : 'Pendiente');
								?>
									<hr>

									<!-- Button trigger modal -->
									<button type="button" class="btn btn-light btn-block" data-toggle="modal" data-target="#status<?php echo $justificante['idJustificantes'] ?>">
										<div class="status">
											<?php echo $justificante['fecha_asistencia']." <span class='".$estado."'>".$estado."</span>"; ?>
										</div>
									</button>
								<?php endif ?>
							<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php foreach ($justificantes as $justificante): ?>
	<?php if ($justificante['Comentario'] != null): 
		$estado = ($justificante['status_justificante'] == 1) ? 'Aprobado' : (($justificante['status_justificante'] !== null) ? 'Rechazado' : 'Pendiente');
		$causa = ($justificante['entrada'] == "00:00:00" || $justificante['salida'] == "00:00:00") ? 'Ausencia' : 'Retardo';
	?>
		<!-- Modal -->
		<div class="modal fade" id="status<?php echo $justificante['idJustificantes'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<p class="titulo-tablero titulo" id="exampleModalLongTitle"><?php echo $justificante['fecha_asistencia']." (".$causa.")" ?></p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-8">
							<div class="row">
								<?php if ($causa == "Retardo"): ?>
									<div class="col-12">
										<label>Horario:</label>
										<p class="titulo"><?php echo $justificante['entrada']." - ".$justificante['salida'] ?></p>
									</div>
								<?php endif ?>
								<div class="col-12">
									<label>Comentario:</label>
									<p class="titulo"><?php echo $justificante['Comentario'] ?></p>
								</div>
							</div>
						</div>
						<div class="col-4 status">
							<?php echo "<span class='".$estado."'>".$estado."</span>"; ?>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	<?php endif ?>
<?php endforeach ?>

	<div class="row">
		<div id="content" class="col-lg-12">
			<div id="calendar"></div>
			<div class="modal fade" id="modal-event" tabindex="-1" role="dialog" aria-labelledby="modal-eventLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="event-title"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="asistencia-form">
						<div class="modal-body">
							<div class="row">
								<div class="col"><span id="entrada"></span></div>
								<div class="col"><span id="hEntrada"></span></div>
							</div>
							<div class="row">
								<div class="col"><span id="salida"></span></div>
								<div class="col"><span id="hSalida"></span></div>
							</div>
								<label for="Comentario">Comentario</label>
								<input class="form-control" type="text" name="Comentario" id="Comentario" required>
							<input type="hidden" id="asistencia" name="asistencia">
						</div>
					</form>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="asistencia-btn" data-dismiss="modal">Enviar</button>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>

<div id="form-result" class="alerta-flotante"></div>
<script src='assets/vendor/full-calendar/js/moment.min.js'></script>
<script src='assets/vendor/full-calendar/js/fullcalendar.js'></script>
<script src='assets/vendor/full-calendar/js/jquery-ui.min.js'></script>
<script src='assets/vendor/full-calendar/js/calendarioAsistencias.js'></script>