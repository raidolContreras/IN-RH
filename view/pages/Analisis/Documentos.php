<div class="container-fluid dashboard-content ">
	<div class="card col-12 p-4 row">
<?php if (isset($_GET['empresa'])): 
	$documentos = ControladorAnalisis::documentos($_GET['empresa']);
	$docRequeridos = array(
		'Curriculum',
		'Acta de Nacimiento',
		'Comprobante de Domicilio',
		'Identificación Anverso',
		'Identificación Reverso',
		'RFC (Constancia de situación fiscal)',
		'CURP',
		'NSS',
		'Comprobante último grado de estudios',
		'Carta de recomendación (Laboral)',
		'Carta de recomendación (personal)',
		'Estado de cuenta',
		'Carta de no adeudos (infonavit)',
		'Carta de no adeudos (fonacot)'
	);
?>
		<h3>Tabla de Documentos</h3>
		<div class="table-responsive">
			<table id="example" class="table table-bordered table-striped vacaciones-table analisis">
				<thead>
					<tr>
						<th>Nombre</th>
						<?php foreach ($docRequeridos as $docRequerido): ?>
						<th><?php echo $docRequerido ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($documentos as $documento):?>
						<tr>
							<td><?php echo $documento['nombre'] ?></td>
							<?php $i = 2; foreach ($docRequeridos as $docRequerido): ?>
							<td><?php echo $documento[$i] ?></td>
							<?php $i++; endforeach ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
<?php else: 
	$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
?>
		<h3>Selecciona una empresa</h3>
		<div class="table-responsive">
			<table id="example" class="table table-bordered table-striped vacaciones-table analisis">
				<thead>
					<tr>
						<th>Empresa</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($empresas as $empresa):?>
						<tr>
							<td><a class="btn btn-in-consulting" href="Analisis-Documentos&empresa=<?php echo $empresa['idEmpresas'] ?>">
								<span><?php echo $empresa['nombre_razon_social'] ?></span>
							</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
<?php endif ?>
	</div>
</div>