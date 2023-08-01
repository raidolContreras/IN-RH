		<div
		class="modal fade"
		id="delGasto"
		tabindex="-1"
		role="dialog"
		aria-labelledby="exampleModalLabel"
		aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<div class="row" style="flex-direction: column;">
							<p class="titulo-tablero mb-0" id="exampleModalLabel">Eliminar registro de gasto</p>
						</div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p class="text-center">
							Estás a punto de eliminar un registro de gastos de forma permanente. Esta acción no se puede revertir y todos los datos relacionados con este registro se perderán definitivamente.
						</p>
						<p class="text-center">
							Por favor, confirma si deseas continuar con la eliminación.
						</p>
					</div>
					<form id="eliminarGasto-form">
						<input type="hidden" name="eliminarGasto" id="eliminarGasto">
					</form>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-primary rounded" id="eliminarGasto-btn">Eliminar gasto</button>
					</div>
				</div>
			</div>
		</div>
<script>
	$('#delGasto').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('del') // Extract info from data-* attributes
	var modal = $(this)
	modal.find('#eliminarGasto').val(recipient)
})
</script>