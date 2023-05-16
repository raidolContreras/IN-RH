<div class="container-fluid dashboard-content ">

<div class="row">
  <div class="col-md-3">
  <!--Tablero de empleado del mes-->
    <div class="row">
    	<div class="col-12">
				<div class="card">
					<div class="m-2">
						<?php include "view/pages/modulos/EmpleadoMes.php" ?>
					</div>
				</div>
			</div>
	<!--Tablero de empleado del mes-->
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<?php include "view/pages/modulos/Responsable.php" ?>
					</div>
				</div>
			</div>
	<!--Tablero de cumpleaños empleado-->
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<?php include "view/pages/modulos/Birtday.php" ?>
					</div>
				</div>
			</div>
    </div>
  </div>
	<!--Tablero de Notificaciones-->
  <div class="col-md-9">
		<div class="card">
			<div class="m12">
				<div class="pr-3 pt-3">
					<div class="float-right pr-2">
						<p class="titulo-sup m-0">
							<a href="Noticias" class="btn-outline-light boton" >
								<i class="fas fa-plus"></i>
							</a>
						</p>
					</div>
				</div>
				<?php include "view/pages/modulos/TableroNoticias.php" ?>
			</div>
		</div>
	</div>
</div>

</div>