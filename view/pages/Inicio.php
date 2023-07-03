<?php $jefeDepartamento = ControladorFormularios::ctrVerDepartamentos("Empleados_idEmpleados", $_SESSION['idEmpleado']) ?>
<div class="container-fluid dashboard-content ">

<div class="row">

  <div class="col-xl-3 col-lg-12 px-0">
  <!--Tablero de empleado del mes-->
    <div class="row gx-1">
    	<div class="col-xl-12 col-lg-12">
				<div class="card">
					<div class="mt-1 mb-1 contenedor">
						<?php include "view/pages/modulos/EmpleadoMes.php" ?>
					</div>
				</div>
			</div>
	<!--Tablero de empleado del mes-->
			<div class="col-xl-12 col-lg-12">
				<div class="card contenedor">
					<div class="card-body">
						<?php include "view/pages/modulos/Responsable.php" ?>
					</div>
				</div>
			</div>
	<!--Tablero de cumpleaños empleado-->
			<div class="col-xl-12 col-lg-12">
				<div class="card">
					<div class="card-body contenedor">
						<?php include "view/pages/modulos/Birtday.php" ?>
					</div>
				</div>
			</div>
    </div>
  </div>

	<!--Tablero de Notificaciones-->
  <div class="col-xl-9 col-lg-12 order-first order-xl-last px-0">
  	<div class="row">
  		<div class="col-12 order-xl-1">
				<div class="card">
					<div class="m-2 altura">
						<?php include "view/pages/modulos/TableroNoticias.php" ?>
					</div>
				</div>
			</div>
			<?php if (!empty($jefeDepartamento)): ?>
  		<div class="col-xl-4 col-lg-12 order-xl-2 order-lg-3">
				<div class="card">
					<div class="card-body contenedor">
						<?php include "view/pages/modulos/Aniversario.php" ?>
					</div>
				</div>
			</div>
  		<div class="col-xl-8 col-lg-12 order-xl-3 order-lg-2">
				<div class="card">
					<div class="float-right" style="z-index: 2 !important;" id="justify-result">
					</div>
					<div class="card-body contenedor" style="z-index: 0 !important;">
						<?php include "view/pages/modulos/Peticiones.php" ?>
					</div>
				</div>
			</div>
  		<div class="col-xl-12 order-xl-4 order-lg-3">
				<a href="Tareas">
					<div class="card">
						<div class="float-right" style="z-index: 2 !important;" id="justify-result">
						</div>
						<div class="card-body contenedor" style="z-index: 0 !important;">
							<?php include "view/pages/modulos/Tareas.php" ?>
						</div>
					</div>
				</a>
			</div>
			<?php else: ?>
  		<div class="col-lg-12 order-xl-2">
				<div class="card">
					<div class="card-body contenedor">
						<?php include "view/pages/modulos/Aniversario.php" ?>
					</div>
				</div>
			</div>
			<?php endif ?>
  		<div class="col-xl-12 order-xl-5 order-lg-4">
				<div class="card">
					<div class="float-right" style="z-index: 2 !important;" id="justify-result">
					</div>
					<div class="card-body contenedor" style="z-index: 0 !important;">
						<?php include "view/pages/modulos/Encargos.php" ?>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>

</div>