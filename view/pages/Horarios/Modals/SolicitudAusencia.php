<div class="modal fade rounded" id="permiso">
	<div class="modal-dialog modal-dialog-centered modal-lg ">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				
				<p class="titulo-tablero titulo" id="titulo">
					<span class="badge-dot"></span>
				</p>
				<p class="subtitulo-tablero ">Solicitar ausencia</p>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form class="form-container" id="solicitud-permiso-form">

					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="fechaPermiso">Desde:</label>
								<input class="form-control" type="date" id="fechaPermiso" name="fechaPermiso" min="<?php echo date('Y-m-d') ?>">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="fechaFin">Hasta:</label>
								<input class="form-control" type="date" id="fechaFin" name="fechaFin" min="<?php echo date('Y-m-d') ?>" disabled>
							</div>
						</div>
						<div class="col-12" id="description">
							<div class="form-group">
								<label for="descripcion">Descripción:</label>
								<textarea class="form-control" name="descripcion" id="descripcion" rows="5"></textarea>
							</div>
						</div>
					</div>
					<input type="hidden" id="id" name="generarPeticion">
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="solicitud-permiso-btn" type="button" class="btn btn-primary rounded" data-dismiss="modal">Solicitar</button>
				<button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>