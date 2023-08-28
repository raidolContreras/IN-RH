<div class="modal fade rounded" id="eliminarI">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p class="titulo-tablero titulo" id="tituloI">
					<span class="badge-dot"></span>
				</p>
				<p class="subtitulo-tablero ">Ocultar incapacidad</p>
			</div>
			<div class="modal-body">
				¿Deseas ocultar la incapacidad?
				<form id="solicitud-eliminarI-form">
					<input type="hidden" name="eliminarISolicitud" id="eliminarISolicitud">
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="solicitud-eliminarI-btn" type="button" class="btn btn-danger rounded" data-dismiss="modal">Eliminar</button>
				<button type="button" class="btn btn-primary rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>