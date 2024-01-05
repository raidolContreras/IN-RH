<?php $postulantes = ControladorFormularios::ctrVerPostulantes(null, null);   ?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="container">
			<div class="card">
				<div class="card-header">
					<p class="titulo-tablero">BASES DE TALENTO</p>
				</div>
				<div class="card-body">
					<div class="table">
						<table>
							<thead>
								<tr>
									<th>Nombre</th>
									<th width="5%">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($postulantes as $postulante): ?>
									<tr>
										<td><?php echo $postulante[0] ?></td>
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