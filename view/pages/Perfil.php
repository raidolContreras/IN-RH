<?php $empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $_SESSION['idEmpleado']); ?>
<div class="container-fluid dashboard-content ">
	<div class="row">
		<div class="container">
			<div class="card rounded-card card-info">
				<h2 class="mx-4 my-5">Configuración de cuenta</h2>
			</div>
			<div class="card">
				<div class="row rounded-card">
					<div class="col-xl-6 col-md-12 my-4">
						<div class="card-into-card rounded-card px-4">
							<h5 class="card-title mb-1 mt-3">Cambiar foto de perfil</h5>
							<p class="card-subtitle mb-4">Cambia tu foto de perfil desde aquí</p>
							<div class="text-center">
							<?php if (!empty($foto)): ?>
								<img src="view/fotos/thumbnails/<?php echo $foto['namePhoto'] ?>" alt="" class="user-avatar-xxl2 rounded-circle">
							<?php else: ?>
								<?php if ($_SESSION['genero'] == 1): ?>
									<span style="background-color: #29CEE8; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; justify-content: center; align-items: center;">
									<?php else: ?>
										<span style="background-color: #F56CC1; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; justify-content: center; align-items: center;">
										<?php endif ?>
										<p class="mt-1" style="color: white;"><?php echo $perfil; ?></p>
									</span>
								<?php endif ?>
								<div class="align-items-center justify-content-center my-4 gap-3">
									<button class="btn btn-primary rounded">Actualizar</button>
								</div>
								<p class="mb-0">Permitido JPG, GIF o PNG. Tamaño máximo de 800K</p>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-md-12 my-4">
						<div class="card-into-card rounded-card px-4">
							<h5 class="card-title mb-1 mt-3">Cambiar contraseña</h5>
							<p class="card-subtitle mb-4">Para cambiar su contraseña por favor confirme aquí</p>
							<form>
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
									<button type="button" class="btn btn-primary rounded">Actualizar Contraseña</button>
								</div>
							</form>
						</div>
					</div>
					<div class="col-xl-12 col-md-12 my-4">
						<div class="card-into-card rounded-card px-4">
							<h5 class="card-title mb-1 mt-3">Detalles personales</h5>
							<p class="card-subtitle mb-4">Para cambiar sus datos personales, edite y guarde desde aquí</p>
							<form>
							<div class="row">
								<div class="col-lg-6">
								<div class="mb-4">
									<label for="nombre">Nombre(s)</label>
									<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $empleado['name'] ?>" required>
								</div>
								<div class="mb-4">
									<label for="genero">Género</label>
									<select class="form-control" id="genero" name="genero" required>
										<?php if ($empleado['genero'] == 1): ?>
											<option value="1" selected>Masculino</option>
											<option value="0">Femenino</option>
										<?php else: ?>
											<option value="1">Masculino</option>
											<option value="0" selected>Femenino</option>
										<?php endif ?>
									</select>
								</div>
								</div>
								<div class="col-lg-6">
								<div class="mb-4">
									<label for="apellidos">Apellidos</label>
									<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $empleado['lastname'] ?>" required>
								</div>
								<div class="mb-4">
									<label for="fecha_nacimiento">Fecha de nacimiento</label>
									<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $empleado['fNac'] ?>" required>
								</div>
								</div>
								
								<div class="form-group card p-3 col-12">
									<label for="direccion">Dirección</label>
									<div class="row">
										<div class="col-md-9">
											<input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" value="<?php echo $empleado['street'] ?>" required>
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" id="num_exterior" name="num_exterior" placeholder="Núm. Ext." value="<?php echo $empleado['numE'] ?>" required>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-3">
											<?php if ($empleado['numI'] != ''): ?>
												<input type="text" class="form-control" id="num_interior" name="num_interior" placeholder="Núm. Int." value="<?php echo $empleado['numI'] ?>">
											<?php else: ?>
												<input type="text" class="form-control" id="num_interior" name="num_interior" placeholder="Núm. Int.">
											<?php endif ?>
										</div>
										<div class="col-md-6">
											<input type="text" class="form-control" id="colonia" name="colonia" placeholder="Colonia" value="<?php echo $empleado['colonia'] ?>" required>
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" id="cp" name="cp" placeholder="C.P." value="<?php echo $empleado['CP'] ?>" required>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-6">
											<select class="form-control" id="estado" name="estado" required>
												<option>Selecciona un estado</option>
												<?php foreach ($estadosArray as $key => $estado): ?>
													<?php if ($empleado['estado'] == $estado['clave']): ?>
														<option value="<?php echo $estado['clave'] ?>" selected><?php echo $estado['nombre'] ?></option>
													<?php else: ?>
														<option value="<?php echo $estado['clave'] ?>"><?php echo $estado['nombre'] ?></option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
										</div>
										<div class="col-md-6">
											<select class="form-control" id="municipio" name="municipio" required>
												<option value="<?php echo $empleado['municipio'] ?>"><?php echo $empleado['municipio'] ?></option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-12">
								<div class="d-flex align-items-center justify-content-end mt-4 gap-3">
									<button class="btn btn-primary rounded">Actualizar</button>
									<button class="btn btn-light-danger text-danger rounded">Cancelar</button>
								</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>