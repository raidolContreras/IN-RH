<?php $vacantes = ControladorFormularios::ctrVerVacantes(null, null); 
?>
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Ofertas de empleo</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page">Ofertas de empleo</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end pageheader	-->
	<!-- ============================================================== -->
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
						<table id="Oferta-trabajo" class="table table-striped table-bordered first" style="width:100%">
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
											<form action="Vacantes-Postulantes" method="POST">
												<input type="hidden" value="<?php echo $vacante['idVacantes'] ?>" name="Postulantes">
												<button class="btn btn-outline-secondary" href="Vacantes-Postulantes">
													Postulantes <span class="badge">(<?php echo $suma[0] ?>)</span>
												</button>
											</form>
										</td>
										<td>
											<table>
												<tr>
													<!--<td>
														<form method="POST" action="EditarVacante">
															<inpat type="hidden" name="Edicion" value="<?php echo $vacante['idVacantes'] ?>">
															<button type="submit" class="btn btn-primary rounded btn-block"><i class="far fa-edit"></i></button>
														</form>
													</td>-->
													<td>
														<form method="POST" action="Vacantes-EliminarVacante">
															<input type="hidden" name="Eliminar" value="<?php echo $vacante['idVacantes'] ?>">
															<button type="submit" class="btn btn-danger rounded btn-block"><i class="fas fa-trash"></i></button>
														</form>
													</td>
													<td>
														<button onclick="copyToClipboard('http://127.0.0.1/IN-RH/Postulacion&vacante=<?php echo $vacante['idVacantes'] ?>')">Generar URL</button>

														<script>
														function copyToClipboard(text) {
														  const input = document.createElement('input');
														  input.setAttribute('value', text);
														  document.body.appendChild(input);
														  input.select();
														  document.execCommand('copy');
														  document.body.removeChild(input);
														  alert("¡URL copiada al portapapeles!");
														}
														</script>

													</td>
												</tr>
											</table>
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