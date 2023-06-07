<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5">
			<div class="card-header encabezado">Configuración del registro de horas</div>
			<div class="row">
				<div class="card-side-nav col-2 lista-ajustes">
					<div><a href="Asistencia-ajustes" class="btn btn-block btn-in-consulting-link">Horarios de trabajo</a></div>
					<div><a href="Asistencia-permisos" class="btn btn-block btn-in-consulting-link">Permisos</a></div>
					<div><a href="Asistencia-importar" class="btn btn-block btn-in-consulting-link active">Importar horarios</a></div>
					<div><a href="Asistencia-exportar" class="btn btn-block btn-in-consulting-link">Exportar resultados</a></div>
				</div>
				<div class="col-10" id="horarios">
					<?php include "subir_csv.php" ?>
				</div>
			</div>
		</div>
	</div>
</div>