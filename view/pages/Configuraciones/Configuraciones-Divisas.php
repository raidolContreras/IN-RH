<?php if (!empty($rol) && $rol['Configuracion_Divisas'] == 1): ?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="card-header encabezado">CONFIGURACIÓN DEL SISTEMA</div>
			<div class="row">
				<?php require_once "view/pages/navs/sidenav_configuracion.php"; ?>
				<div class=" col-xl-10 col-lg-9 col-md-8 col-9" id="horarios">
					<div class="row mr-4 ml-2 mt-3">
						<div class="card-header encabezado m-0 p-0">
							Gestionar divisas
						</div>
						<div class="card-header encabezado m-0 p-0">
							<button type="button" class="btn btn-in-consulting float-right" data-toggle="modal" data-target="#exampleModal">
								<i class="fas fa-plus-circle"></i> <span>Dar de alta Divisa</span>
							</button>
						</div>
					</div>
<?php $divisas = ControladorFormularios::ctrVerDivisa(null, null); ?>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Diminutivo</th>
										<th width="10"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($divisas as $divisa): ?>
									<tr>
										<td><?php echo $divisa['nameDivisa']; ?></td>
										<td><?php echo $divisa['divisa']; ?></td>
										<td>
											<button
												class="btn btn-in-consulting-danger"
												data-toggle="modal"
												data-target="#eliminar"
												data-id="<?php echo $divisa['idDivisa']; ?>"
												data-name="<?php echo $divisa['nameDivisa']."(".$divisa['divisa'].")"; ?>">
												<i class="fas fa-times-circle"></i>
											</button>
										</td>
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
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir divisa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addDivisa-form">
        	<div>
        		<label for="nameDivisa">Nombre de la divisa</label>
        		<input type="text" class="form-control" Name="nameDivisa" id="nameDivisa">
        	</div>
        	<div>
        		<label for="divisa">Diminutivo</label>
        		<input type="text" class="form-control" Name="divisa" id="divisa" maxlength="3" minlength="3">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="addDivisa-btn">Añadir</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="eliminar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar divisa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	Estas seguro que deseas eliminar la divisa (<span id="current"></span>)?.
      	Esto puede generar conflicto con los gastos y nominas que posean dicha divisa.
      	<form id="eliminarDivisa-form">
	      	<input type="hidden" name="eliminarDivisa">
	      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="eliminarDivisa-btn">Eliminar</button>
      </div>
    </div>
  </div>
</div>
<script>

$('#eliminar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('name')
  var id = button.data('id')
  var modal = $(this)
  modal.find('.modal-title').text('Eliminar divisa: ' + recipient)
  modal.find('#current').text('Eliminar divisa: ' + recipient)
  modal.find('.modal-body input').val(id)
})

	$(document).ready(function() {
		$("#addDivisa-btn").click(function() {
			var formData = $("#addDivisa-form").serialize(); // Obtener los datos del formulario
			$.ajax({
				url: "ajax/ajax.formularios.php",
				type: "POST",
				data: formData,
				success: function(response) {
					$("#form-result").val("");
					if (response === 'ok') {
						$("#form-result").html(`
							<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Divisa creada
							</div>
							`);
						deleteAlert();
						setTimeout(function() {
							location.href = 'Configuraciones-Divisas';
						}, 900);
					} else {
						$("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo crear la divisa, intenta nuevamente.
							</div>
							`);

						deleteAlert();
					}
				}
			});
		});
		$("#eliminarDivisa-btn").click(function() {
			var delData = $("#eliminarDivisa-form").serialize(); // Obtener los datos del formulario
			$.ajax({
				url: "ajax/ajax.formularios.php",
				type: "POST",
				data: delData,
				success: function(response) {
					$("#form-result").val("");
					if (response === 'ok') {
						$("#form-result").html(`
							<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Divisa eliminada
							</div>
							`);
						deleteAlert();
						setTimeout(function() {
							location.href = 'Configuraciones-Divisas';
						}, 900);
					} else {
						$("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo eliminar la divisa, intenta nuevamente.
							</div>
							`);
						deleteAlert();
					}
				}
			});
		});
	});

	function deleteAlert() {
		setTimeout(function() {
			var alert = $('#alerta');
			alert.fadeOut('slow', function() {
				alert.remove();
			});
		}, 1000);
	}

</script>
<?php else: ?>
	<script>
		window.location.href="Inicio";
	</script>
<?php endif ?>