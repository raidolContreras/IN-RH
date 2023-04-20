<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader  -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Registro Empleados</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page">Registro Empleados</li>
							<li class="breadcrumb-item active" aria-current="page">Información laboral</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
  <div class="card">
    <div class="card-body">
      <form>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="cargo" class="col-form-label text-center font-weight-bold">Cargo:</label>
            <input type="text" class="form-control form-control-lg" id="cargo" name="cargo">
          </div>
          <div class="form-group col-md-6">
            <label for="departamento" class="col-form-label text-center font-weight-bold">Departamento:</label>
            <select class="form-control form-control-lg" id="departamento" name="departamento">
              <option value="">Selecciona una opción</option>
              <option value="contabilidad">Contabilidad</option>
              <option value="fiscal">Fiscal</option>
              <option value="financiero">Financiero</option>
              <option value="marketing">Marketing</option>
              <option value="secretaria">Secretaria</option>
              <option value="sistemas">Sistemas</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="fecha_contratacion" class="col-form-label text-center font-weight-bold">Fecha de contratación:</label>
            <input type="date" class="form-control form-control-lg" id="fecha_contratacion" name="fecha_contratacion">
          </div>
          <div class="form-group col-md-6">
            <label for="num_seguro_social" class="col-form-label text-center font-weight-bold">Número de seguro social:</label>
            <input type="text" class="form-control form-control-lg" id="num_seguro_social" name="num_seguro_social">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="num_empleado" class="col-form-label text-center font-weight-bold">Número de empleado:</label>
            <input type="text" class="form-control form-control-lg" id="num_empleado" name="num_empleado">
          </div>
          <div class="form-group col-md-6">
            <label for="salario" class="col-form-label text-center font-weight-bold">Salario:</label>
            <input type="text" class="form-control form-control-lg" id="salario" name="salario">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="horario_laboral" class="col-form-label text-center font-weight-bold">Horario laboral:</label>
            <input type="text" class="form-control form-control-lg" id="horario_laboral" name="horario_laboral">
          </div>
        </div>
        <div class="form-group row mt-5">
          <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
          </div>
				<a class="btn btn-success p-2 rounded mb-3 float-right" href="Formacion">
					Siguiente<i class="fas fa-arrow-right ml-2"></i>
				</a>
        </div>
      </form>
    </div>
  </div>
</div>

</div>

</div>