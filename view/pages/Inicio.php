<div class="container-fluid dashboard-content ">

	<div class="row">
<!--Tablero de empleado del mes-->
		<div class="row col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
			<div class="col-12">
				<div class="card">
					<div class="m-2">
						<?php include "view/pages/modulos/EmpleadoMes.php" ?>
					</div>
				</div>
			</div>
	<!--Tablero de epleado del mes-->
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<?php include "view/pages/modulos/Responsable.php" ?>
					</div>
				</div>
			</div>
		</div>
<!--Tablero de Noticias-->
		<div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12">
			<div class="card">
				<div class="m-2">
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
