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
									<button class="btn btn-primary rounded">Actualizar Contraseña</button>
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
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Your Name</label>
                                  <input type="text" class="form-control" id="exampleInputtext" placeholder="Mathew Anderson">
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Location</label>
                                  <select class="form-control" aria-label="Default select example">
                                    <option selected="">United Kingdom</option>
                                    <option value="1">United States</option>
                                    <option value="2">United Kingdom</option>
                                    <option value="3">India</option>
                                    <option value="3">Russia</option>
                                  </select>
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Email</label>
                                  <input type="email" class="form-control" id="exampleInputtext" placeholder="info@modernize.com">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Store Name</label>
                                  <input type="text" class="form-control" id="exampleInputtext" placeholder="Maxima Studio">
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Currency</label>
                                  <select class="form-control" aria-label="Default select example">
                                    <option selected="">India (INR)</option>
                                    <option value="1">US Dollar ($)</option>
                                    <option value="2">United Kingdom (Pound)</option>
                                    <option value="3">India (INR)</option>
                                    <option value="3">Russia (Ruble)</option>
                                  </select>
                                </div>
                                <div class="mb-4">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Phone</label>
                                  <input type="text" class="form-control" id="exampleInputtext" placeholder="+91 12345 65478">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="">
                                  <label for="exampleInputPassword1" class="form-label fw-semibold">Address</label>
                                  <input type="text" class="form-control" id="exampleInputtext" placeholder="814 Howard Street, 120065, India">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                  <button class="btn btn-primary rounded">Save</button>
                                  <button class="btn btn-light-danger text-danger rounded">Cancel</button>
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