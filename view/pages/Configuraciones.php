<?php if (!empty($rol) && ($rol['Configuracion_Divisas'] == 1 || $rol['Configuracion_Categorias'] == 1 || $rol['Configuracion_Permisos'] == 1)): ?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="card-header encabezado">Configuración del sistema</div>
			<div class="row">
				<?php require_once "view/pages/navs/sidenav_configuracion.php"; ?>
				<div class=" col-xl-10 col-lg-9 col-md-8 col-9" id="horarios">
					<div class="row mr-4 ml-2 mt-3">
						<div class="card-header encabezado m-0 p-0">
							Configuraciones Generales
						</div>
					</div>
					<div class="mr-4 ml-3 mt-3">
						<p>
							Gestión de divisas utilizadas, categorías de gastos, etc...
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
	<script>
		window.location.href="Inicio";
	</script>
<?php endif ?>