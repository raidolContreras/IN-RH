<div class="modal fade rounded" id="eliminarV">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p class="titulo-tablero titulo" id="tituloV">
					<span class="badge-dot"></span>
				</p>
				<p class="subtitulo-tablero ">Eliminar solicitud</p>
			</div>
			<div class="modal-body">
				¿Estás seguro de eliminar la solicitud?
				<form id="solicitud-eliminarV-form">
					<input type="hidden" name="eliminarVSolicitud" id="eliminarVSolicitud">
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="solicitud-eliminarV-btn" type="button" class="btn btn-danger rounded" data-dismiss="modal">Eliminar</button>
				<button type="button" class="btn btn-primary rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>