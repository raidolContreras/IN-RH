<?php
$organigrama = ControladorFormularios::ctrOrganigrama();

$departamentoPresi = ControladorFormularios::ctrVerDepartamentos("Pertenencia", 0);
$datosPresi = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $departamentoPresi['Empleados_idEmpleados']);
$puestoPresi = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $datosPresi['idEmpleados']);

$nombrePresi = $datosPresi['name'];
$tituloPresi = $puestoPresi['namePuesto'];
?>

<link rel="stylesheet" href="assets/libs/vendor/OrgChart/css/jquery.orgchart.css">
<link rel="stylesheet" href="assets/libs/vendor/OrgChart/css/style.css">
<div id="chart-container"></div>

<script type="text/javascript" src="assets/libs/vendor/OrgChart/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/libs/vendor/OrgChart/js/jquery.mockjax.min.js"></script>
<script type="text/javascript" src="assets/libs/vendor/OrgChart/js/jquery.orgchart.js"></script>
<script type="text/javascript">
	$(function() {
	
		$.mockjax({
			url: '/orgchart/initdata',
			responseTime: 1000,
			contentType: 'application/json',
			responseText: {
				'name': '<?php echo $nombrePresi; ?>', 
				'title': '<?php echo $tituloPresi; ?>',
				'children': [
					<?php foreach ($organigrama as  $value): ?>
						<?php 
							if ($datosPresi['idEmpleados'] != $value['idEmpleados']) {
								$name = $value['name'];
								$namePuesto = $value['namePuesto'];
								$depa = $value['Departamentos_idDepartamentos'];

								$departamento = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $depa);
								$jefeDirecto = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $departamento['Empleados_idEmpleados']);

								if (isset($jefeDirecto[0])) {
									if ($jefeDirecto[0] == $value['idEmpleados']) {
										$sumaDepto = ControladorFormularios::ctrContarDepartamento($depa);
										if ($sumaDepto[0] > 1) {
											
											$puestosChildren = ControladorFormularios::ctrVerPuestosOrganigrama($value['idEmpleados'], $depa);

											// Construir el arreglo de datos para los hijos
											$childrenData = [];
											foreach ($puestosChildren as $pChildren) {
												$children = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $pChildren['Empleados_idEmpleados']);
												$puestoChildren = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $children['idEmpleados']);
												$childrenName = $children['name'];
												$childrenTitle = isset($puestoChildren['namePuesto']) ? $puestoChildren['namePuesto'] : '';

												$childrenData[] = [
													'name' => $childrenName,
													'title' => $childrenTitle
												];
											}

											// Construir el arreglo de datos para el empleado actual
											$data = [
												'name' => $name,
												'title' => $namePuesto,
												'children' => $childrenData
											];
											echo json_encode($data, JSON_UNESCAPED_UNICODE).",";

										}else{
											// Construir el arreglo de datos para el empleado actual
											$data = [
												'name' => $name,
												'title' => $namePuesto
											];
											echo json_encode($data, JSON_UNESCAPED_UNICODE).",";
										}
									}
								}else{
									// Construir el arreglo de datos para el empleado actual
									$data = [
										'name' => $name,
										'title' => $namePuesto
									];
									echo json_encode($data, JSON_UNESCAPED_UNICODE).",";
								}
							}
						?>
					<?php endforeach ?>
				]
			}
		});

		$('#chart-container').orgchart({
			'data' : '/orgchart/initdata',
			'nodeContent': 'title'
		});

	});
</script>
