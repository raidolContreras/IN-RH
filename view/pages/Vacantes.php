<?php $vacantes = ControladorFormularios::ctrVerVacantes(null, null); ?>
<div class="container-fluid dashboard-content ">
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body">
					<a href="Vacantes-CrearVacante" class="btb btn-success p-2 rounded mb-3 float-right animacion">
						Crear Oferta de Empleo <i class="icon-briefcase"></i>
					</a>
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered Extras" style="width:100%">
							<thead>
								<tr>
									<th>Departamento</th>
									<th width="43%">Nombre vacante</th>
									<th width="43%">Requisitos</th>
									<th>Salario</th>
									<th>Postulantes</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($vacantes as $key => $vacante): ?>
								<?php $suma = ControladorFormularios::ctrSumaPostulantes('Vacantes_idVacantes', $vacante['idVacantes']); ?>
									<tr>
										<td><?php echo $vacante['nameDepto'] ?></td>
										<td><?php echo $vacante['nameVacante'] ?></td>
										<td><?php echo $vacante['requisitos'] ?></td>
										<td><?php echo $vacante['salarioVacante'] ?></td>
										<td>
											<?php if ($suma[0] >= 1): ?>
											<form action="Vacantes-Postulantes" method="GET">
												<a class="btn btn-outline-secondary rounded" href="Vacantes-Postulantes&Postulantes=<?php echo $vacante['idVacantes'] ?>">
													Postulantes <span class="badge">(<?php if ($suma[0] >=1) { echo $suma[0]; }else{ echo "0";} ?>)</span>
												</a>
											</form>
											<?php else: ?>
											<a class="btn btn-outline-secondary rounded disabled" href="">
												Postulantes <span class="badge">(0)</span>
											</a>
											<?php endif ?>
										</td>
										<td>
											<div class="dropdown">
											  <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											    <i class="fas fa-ellipsis-v"></i>
											  </button>
											  <div class="dropdown-menu mr-0" aria-labelledby="dropdownMenuButton">
											    <a class="dropdown-item" href="Vacantes-CrearVacante&Editar=<?php echo $vacante['idVacantes'] ?>"><i class="fas fa-edit"></i> Editar</a>
											    <a class="dropdown-item" href="Vacantes-EliminarVacante&Eliminar=<?php echo $vacante['idVacantes'] ?>"><i class="fas fa-trash"></i> Eliminar</a>
											    <a class="dropdown-item" href="Postulacion&vacante=<?php echo $vacante['idVacantes'] ?>">
											    <i class="fas fa-user-plus"></i> Agregar</a>
											  </div>
											</div>
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