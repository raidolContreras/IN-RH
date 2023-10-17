<?php if (!empty($rol) && $rol['Configuracion_Categorias'] == 1): ?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="card-header encabezado">CONFIGURACIÓN DEL SISTEMA</div>
			<div class="row">
				<?php require_once "view/pages/navs/sidenav_configuracion.php"; ?>
				<div class=" col-xl-10 col-lg-9 col-md-8 col-9" id="horarios">
					<div class="row mr-4 ml-2 mt-3">
						<div class="card-header encabezado m-0 p-0">
							Gestionar categorías
						</div>
						<div class="card-header encabezado m-0 p-0">
							<button type="button" class="btn btn-in-consulting float-right" data-toggle="modal" data-target="#exampleModal">
								<i class="fas fa-plus-circle"></i> <span>Dar de alta categoría</span>
							</button>
						</div>
					</div>
<?php $categorias = ControladorFormularios::ctrVerCategoria(null, null); ?>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Categorias</th>
										<th width="10"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($categorias as $categoria): ?>
									<tr>
										<td><?php echo $categoria['nameCategoria']; ?></td>
										<td>
											<button
												class="btn btn-in-consulting-danger"
												data-toggle="modal"
												data-target="#eliminar"
												data-id="<?php echo $categoria['idCategoria']; ?>"
												data-name="<?php echo $categoria['nameCategoria']; ?>">
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
        <h5 class="modal-title" id="exampleModalLabel">Añadir categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addCategoria-form">
        	<div>
        		<label for="nameDivisa">Nombre de la categoria</label>
        		<input type="text" class="form-control" Name="nameCategoria" id="nameCategoria">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="addCategoria-btn">Añadir</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="eliminar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	Estas seguro que deseas eliminar la categoria (<span id="current"></span>)?.
      	Esto puede generar conflicto con los gastos y nominas que posean dicha categoria.
      	<form id="eliminarCategoria-form">
	      	<input type="hidden" name="eliminarCategoria">
	      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="eliminarCategoria-btn">Eliminar</button>
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
  modal.find('.modal-title').text('Eliminar categoria: ' + recipient)
  modal.find('#current').text('Eliminar categoria: ' + recipient)
  modal.find('.modal-body input').val(id)
})

	$(document).ready(function() {
		$("#addCategoria-btn").click(function() {
			var formData = $("#addCategoria-form").serialize(); // Obtener los datos del formulario
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
							Categoria creada
							</div>
							`);
						deleteAlert();
						setTimeout(function() {
							location.href = 'Configuraciones-Categorias';
						}, 900);
					} else {
						$("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo crear la categoria, intenta nuevamente.
							</div>
							`);

						deleteAlert();
					}
				}
			});
		});
		$("#eliminarCategoria-btn").click(function() {
			var delData = $("#eliminarCategoria-form").serialize(); // Obtener los datos del formulario
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
							Categoria eliminada
							</div>
							`);
						deleteAlert();
						setTimeout(function() {
							location.href = 'Configuraciones-Categorias';
						}, 900);
					} else {
						$("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo eliminar la categoria, intenta nuevamente.
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