<?php 
$empresas = ControladorFormularios::ctrVerEmpresas(null, null);
$departamento = ControladorFormularios::ctrVerDepartamentos(null, null);
?>

<div class="container-fluid dashboard-content ">
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-header tab-regular">
					<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
						<?php if (!isset($_GET['depa'])): ?>
							<li class="nav-item">
								<a class="nav-link active" id="general" href="Departamento" role="tab" aria-controls="card-1" aria-selected="true">General</a>
							</li>
							<?php foreach ($empresas as $empresa): ?>
								<li class="nav-item">
									<a class="nav-link" id="card-tab-<?php echo $empresa['idEmpresas'] ?>" href="Departamento&depa=<?php echo $empresa['idEmpresas'] ?>"><?php echo $empresa['nombre_razon_social'] ?></a>
								</li>
							<?php endforeach ?>
						<?php else: ?>
							<li class="nav-item">
								<a class="nav-link" id="general" href="Departamento">General</a>
							</li>
							<?php foreach ($empresas as $empresa): ?>
									<li class="nav-item">
										<?php if ($_GET['depa'] == $empresa['idEmpresas']): ?>
											<a class="nav-link active" href="Departamento&depa=<?php echo $empresa['idEmpresas'] ?>"><?php echo $empresa['nombre_razon_social'] ?></a>
										<?php else: ?>
											<a class="nav-link" href="Departamento&depa=<?php echo $empresa['idEmpresas'] ?>"><?php echo $empresa['nombre_razon_social'] ?></a>
										<?php endif ?>
									</li>
							<?php endforeach ?>
						<?php endif ?>
					</ul>
				</div>

				<div class="card-body">
					<a href="CrearDepartamentos" class="btb btn-success p-2 rounded mb-3 float-right">
						Crear Departamentos<i class="fas fa-user-plus ml-2"></i>
					</a>
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered depto" style="width:100%">
							<thead>
								<tr>
									<th width="40%">Nombre Depto</th>
									<th width="40%">Encargado</th>
									<th width="20%">empresa</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
							<?php if (!isset($_GET['depa'])): ?>
								<?php foreach ($departamento as $depa): ?>
									<?php 
									if ($depa['Empleados_idEmpleados'] != 0) {
										$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $depa['Empleados_idEmpleados']);
										$nombreEmpleado = ucwords(strtolower($empleado['name']." ".$empleado['lastname']));
									}else{
										$nombreEmpleado = "-";
									}
									$empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']);
									?>

									<tr>
										<?php $depaEspe = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$depa['Pertenencia']); ?>
										<?php if (isset($depaEspe['nameDepto'])): ?>
											<?php $nameDepa = mb_strtoupper($depa['nameDepto']." (".$depaEspe['nameDepto'].")");?>
										<?php else: ?>
											<?php $nameDepa = mb_strtoupper($depa['nameDepto']);?>
										<?php endif ?>

										<td>
											<button type="button" 
												class="btn btn-link" 
												data-toggle="modal" 
												data-target="#Departamento<?php echo $depa['idDepartamentos']; ?>">
												<?php echo $nameDepa ?>
											</button>
										</td>
										<td><?php echo $nombreEmpleado; ?></td>
										<td><?php echo $empresa['nombre_razon_social']." (".$empresa['rfc'].")"; ?></td>
										<td>
											<div class="dropdown">
											  <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											    <i class="fas fa-ellipsis-v"></i>
											  </button>
											  <div class="dropdown-menu mr-0" aria-labelledby="dropdownMenuButton">
											    <a class="dropdown-item" href="EditarDepto&Edicion=<?php echo $depa['idDepartamentos'] ?>"><i class="fas fa-edit"></i> Editar</a>
											    <a class="dropdown-item" href="EliminarDepto&Eliminar=<?php echo $depa['idDepartamentos'] ?>"><i class="fas fa-trash"></i> Eliminar</a>
											  </div>
											</div>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else: ?>
								<?php $depaEspacifico = ControladorFormularios::ctrDeptosEspecial("Empresas_idEmpresas", $_GET['depa']) ?>
								<?php foreach ($depaEspacifico as $depa): ?>
									<?php 
									if ($depa['Empleados_idEmpleados'] != 0) {
										$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $depa['Empleados_idEmpleados']);
										$nombreEmpleado = ucwords(strtolower($empleado['name']." ".$empleado['lastname']));
									}else{
										$nombreEmpleado = "-";
									}
									$empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']);
									?>

									<tr>
										<?php $depaEspe = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$depa['Pertenencia']); ?>
										<?php if (isset($depaEspe['nameDepto'])): ?>
											<?php $nameDepa = mb_strtoupper($depa['nameDepto']." (".$depaEspe['nameDepto'].")");?>
										<?php else: ?>
											<?php $nameDepa = mb_strtoupper($depa['nameDepto']);?>
										<?php endif ?>

										<td>
											<button type="button" 
												class="btn btn-link" 
												data-toggle="modal" 
												data-target="#Departamento<?php echo $depa['idDepartamentos']; ?>">
												<?php echo $nameDepa ?>
											</button>
										</td>
										<td><?php echo $nombreEmpleado; ?></td>
										<td><?php echo $empresa['nombre_razon_social']." (".$empresa['rfc'].")"; ?></td>
										<td>
											<div class="dropdown">
											  <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											    <i class="fas fa-ellipsis-v"></i>
											  </button>
											  <div class="dropdown-menu mr-0" aria-labelledby="dropdownMenuButton">
											    <a class="dropdown-item" href="EditarDepto&Edicion=<?php echo $depa['idDepartamentos'] ?>"><i class="fas fa-edit"></i> Editar</a>
											    <a class="dropdown-item" href="EliminarDepto&Eliminar=<?php echo $depa['idDepartamentos'] ?>"><i class="fas fa-trash"></i> Eliminar</a>
											  </div>
											</div>
										</td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Departamento -->
<?php
if (isset($_GET['depa'])) {
    $departamentos = ControladorFormularios::ctrDeptosEspecial("Empresas_idEmpresas", $_GET['depa']);
} else {
    $departamentos = $departamento;
}

foreach ($departamentos as $depa) {
    $depaEspe = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $depa['Pertenencia']);
    $nameDepa = mb_strtoupper($depa['nameDepto']);
    if (isset($depaEspe['nameDepto'])) {
        $nameDepa .= " (" . $depaEspe['nameDepto'] . ")";
    }

    $empleadosDepartamento = ControladorEmpleados::ctrVerEmpleadosDeptos($depa['idDepartamentos']);
    ?>
    <div class="modal fade" id="Departamento<?php echo $depa['idDepartamentos']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><?php echo $nameDepa ?></h3>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Puesto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($empleadosDepartamento as $empDepto): ?>
                                            <tr>
                                                <td>
                                                    <a href="Empleado&perfil=<?php echo $empDepto['idEmpleados'] ?>">
                                                        <?php echo $empDepto['name'] . " " . $empDepto['lastname'] ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $empDepto['namePuesto'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer p-0 text-center d-flex justify-content-center">
                            <div class="card-footer-item card-footer-item-bordered">
                                <button data-dismiss="modal" class="card-link btn btn-outline-secondary">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
