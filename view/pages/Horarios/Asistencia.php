<?php $permisos = ControladorFormularios::ctrVerPermisos(null,null); ?>
<link href='assets/vendor/full-calendar/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/vendor/full-calendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><!-- Agrega esta línea en el head de tu HTML -->

<style>

.fc-nonbusiness {
  background: #BABABA;  
}
	
.fc-disabled-day {
  background: #FFF !important;  
}
	
.badge-Presente {
	color: #343;
	background-color: #ACE799;
}
.badge-Retardo {
	color: #343;
	background-color: #E7E199;
}
.badge-Ausente {
	color: #343;
	background-color: #EF8B8B;
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
							<button class="btn btn-outline-success btn-rounded btn-block btn-lg">
								<i class="mdi mdi-download"></i> Exportar a Excel
							</button>
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
						<div class="card-body">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src='assets/vendor/full-calendar/js/moment.min.js'></script>
<script src='assets/vendor/full-calendar/js/fullcalendar.js'></script>
<script src='assets/vendor/full-calendar/js/jquery-ui.min.js'></script>
<script src='assets/vendor/full-calendar/js/calendar.js'></script>