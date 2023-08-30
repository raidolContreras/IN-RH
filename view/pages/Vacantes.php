<?php $vacantes = ControladorFormularios::ctrVerVacantes(null, null); 
$i = 0; ?>
<div class="container-fluid dashboard-content ">
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body">
					<a href="Vacantes-CrearVacante" class="btb btn-success p-2 rounded mb-3 float-right">
						Crear Oferta de Empleo <i class="icon-briefcase"></i>
					</a>
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered Extras" style="width:100%">
							<thead>
								<tr>
									<th>Nombre vacante</th>
									<th>Empresa</th>
									<th>Departamento</th>
									<th>Aprobado</th>
									<th width="10%">Salario</th>
									<th width="5%">Postulantes</th>
									<th width="5%">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($vacantes as $key => $vacante):
									$activacion = 0;
									$suma = ControladorFormularios::ctrSumaPostulantes('Vacantes_idVacantes', $vacante['idVacantes']);
									$Activador = ModeloFormularios::mdlActivadoresVacantes($vacante['Departamentos_idDepartamentos']);
									$activadores = array();
									if ($vacante['Departamentos_idDepartamentos'] == $_SESSION['idDepartamentos']) {
										while ($Activador['Pertenencia'] != 0){
											$activadores[] = array(
												"idEmpleados" => $Activador['idEmpleados']
											);
											$Activador = ModeloFormularios::mdlActivadoresVacantes($Activador['Pertenencia']);
											$i++;
										};
									}
									
									foreach ($activadores as $activador) {
										if ($_SESSION['idEmpleado'] == $activador['idEmpleados']) {
											$activacion = 1;
										}
									}
									if ($activacion == 1): 
										if ($vacante['aprobado'] != 2): ?>
											<tr>
												<td><?php echo $vacante['nameVacante'] ?></td>
												<td><?php echo $vacante['nombre_razon_social'] ?></td>
												<td><?php echo $vacante['nameDepto'] ?></td>
												<?php if ($vacante['Jefe_idEmpleados'] == null): ?>
													<td></td>
												<?php else:
												$jefe_aprobado = ControladorEmpleados::ctrVerEmpleados( 'idEmpleados',$vacante['Jefe_idEmpleados']);
												echo "<td>".$jefe_aprobado['lastname']." ".$jefe_aprobado['name']."</td>";
												?>
												<?php endif ?>
												<td><?php echo $vacante['salarioVacante'] ?></td>
											<?php if ($vacante['aprobado'] == 1): ?>
												<td>
													<?php if ($suma[0] >= 1): ?>
													<form action="Vacantes-Postulantes" method="GET">
														<a class="btn btn-outline-secondary rounded" href="Vacantes-Postulantes&Postulantes=<?php echo $vacante['idVacantes'] ?>">
															Postulantes (<?php if ($suma[0] >=1) { echo $suma[0]; }else{ echo "0";} ?>)
														</a>
													</form>
													<?php else: ?>
													<a class="btn btn-outline-secondary rounded disabled" href="">
														Postulantes (0)
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
											<?php elseif($vacante['aprobado'] == 0 && $activacion == 1): ?>
												<td colspan="2">
														<form class="row" id="vacantes-form">
															<input type="hidden" name="idVacantes" value="<?php echo $vacante['idVacantes']; ?>">
															<button class="btn btn-outline-success rounded btn-block" id="aceptar-btn">Aceptar</button>
															<button class="btn btn-outline-danger rounded btn-block" id="rechazar-btn">Rechazar</button>
														</form>
												</td>
											<?php else: ?>
												<td colspan="2" style="text-align: center">
													Pendiente de aprobación 
												</td>
											<?php endif ?>
											</tr>
										<?php endif ?>
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

<script>
	$(document).ready(function() {
		$("#aceptar-btn").click(function() {
			var value = 1;
			enviarDatos(value);
		});

		$("#rechazar-btn").click(function() {
			var value = 2;
			enviarDatos(value);
		});

		function enviarDatos(value) {
			var idVacante = $("input[name='idVacantes']").val();
			var formData = {
				idVacantes: idVacante,
				respuestaVacante: value
			};
			var mensaje = "Vacante activada.";
			var mensaje2 = "activar";

			if (value === 2) {
				mensaje = "Vacante rechazada.";
				mensaje2 = "rechazar";
			}

			$.ajax({
				url: "ajax/ajax.formularios.php",
				type: "POST",
				data: formData,
				success: function(response) {
					$("#form-result").val("");
					if (response === 'ok') {
						$("#form-result").html(`
								<div class='alert alert-success' role="alert" id="alerta">
									<i class="fas fa-check-circle"></i>
									`+mensaje+`
								</div>
						`);
						deleteAlert();
						setTimeout(function() {
								location.href = 'Vacantes';
						}, 1600);
					} else {
						$("#form-result").html(`
								<div class='alert alert-danger' role="alert" id="alerta">
										<i class="fas fa-exclamation-triangle"></i>
										<b>Error</b>, no se pudo `+mensaje2+` la vacante, intenta nuevamente.
								</div>
						`);

						deleteAlert();
					}
				}
			});
		}

		function deleteAlert() {
				setTimeout(function() {
						var alert = $('#alerta');
						alert.fadeOut('slow', function() {
								alert.remove();
						});
				}, 1500);
		}
	});
</script>
