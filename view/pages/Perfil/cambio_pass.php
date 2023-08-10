<div class="col-xl-6 col-md-12 my-4">
	<div class="card-into-card rounded-card px-4">
		<h5 class="card-title mb-1 mt-3">Cambiar contraseña</h5>
		<p class="card-subtitle mb-4">Para cambiar su contraseña por favor confirme aquí</p>
		<form id="cambiopass-form">
			<div class="mb-4">
				<label for="currentPassword" class="form-label fw-semibold">Contraseña actual</label>
				<input type="password" class="form-control" id="currentPassword" name="currentPassword">
			</div>
			<div class="mb-4">
				<label for="passwordNew" class="form-label fw-semibold">Nueva contraseña</label>
				<input type="password" class="form-control" id="passwordNew" name="passwordNew">
			</div>
			<div class="mb-4">
				<label for="confirmPassword" class="form-label fw-semibold">Confirmar Contraseña</label>
				<input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
			</div>
			<div class="">
				<button type="button" class="btn btn-primary rounded" id="cambiopass-btn">Actualizar Contraseña</button>
			</div>
		</form>
	</div>
</div>

<script src="assets/libs/js/cambiopass.js"></script>