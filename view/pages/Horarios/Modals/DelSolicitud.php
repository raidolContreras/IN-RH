<div class="modal fade rounded" id="eliminar">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p class="titulo-tablero titulo" id="titulo">
					<span class="badge-dot"></span>
				</p>
				<p class="subtitulo-tablero ">Eliminar solicitud</p>
			</div>
			<div class="modal-body">
				¿Estás seguro de eliminar la solicitud?
				<form id="solicitud-eliminar-form">
					<input type="hidden" name="eliminarSolicitud" id="eliminarSolicitud">
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="solicitud-eliminar-btn" type="button" class="btn btn-danger rounded" data-dismiss="modal">Eliminar</button>
				<button type="button" class="btn btn-primary rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>