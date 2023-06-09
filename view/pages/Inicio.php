<?php $jefeDepartamento = ControladorFormularios::ctrVerDepartamentos("Empleados_idEmpleados", $_SESSION['idEmpleado']) ?>
<div class="container-fluid dashboard-content ">

<div class="row">
  <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12 col-12">
  <!--Tablero de empleado del mes-->
    <div class="row gx-1">
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
  <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12 col-12">
  	<div class="row">
  		<div class="col-12">
				<div class="card">
					<div class="m12">
						<?php include "view/pages/modulos/TableroNoticias.php" ?>
					</div>
				</div>
			</div>
			<?php if (!empty($jefeDepartamento)): ?>
	  		<div class="col-12">
					<div class="card">
						<div class="mt-2 ml-2">
							<?php include "view/pages/modulos/Peticiones.php" ?>
						</div>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>

</div>

</div>