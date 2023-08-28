<div class="modal fade rounded" id="Incapacidad">
	<div class="modal-dialog modal-dialog-centered modal-lg ">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				
				<p class="titulo-tablero titulo" id="titulo">
					<span class="badge-dot"></span>Registrar Incapacidad
				</p>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form class="form-container" id="incapacidad-permiso-form">

					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="ramo_seguro">Ramo de Seguro:</label>
								<select name="ramo_seguro" id="ramo_seguro" class="form-control">
									<option value="">Selecciona un ramo de seguro</option>
									<option value="1">Riesgos de trabajo</option>
									<option value="2">Enfermedad General</option>
									<option value="3">Maternidad</option>
									<option value="4">Licencia 140 Bis</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="tipo_riesgo">Tipo de Riesgo:</label>
								<select name="tipo_riesgo" id="tipo_riesgo" class="form-control" disabled>
									<option>Selecciona un tipo de riesgo</option>
									<option value="1">Accidente de Trabajo</option>
									<option value="2">Accidente de Trayecto</option>
									<option value="3">Enfermedad Profesional</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="secuela_consecuencia">Secuela o Consecuencia:</label>
								<select name="secuela_consecuencia" id="secuela_consecuencia" class="form-control" disabled>
									<option>Selecciona una opción</option>
									<option value="Ninguna">Ninguna</option>
									<option value="Incapacidad Temporal">Incapacidad Temporal</option>
									<option value="Valuación Inicial Provisional">Valuación Inicial Provisional</option>
									<option value="Valuación Inicial Definitiva">Valuación Inicial Definitiva</option>
									<option value="Defunción">Defunción</option>
									<option value="Recaida">Recaida</option>
									<option value="Valuación Post. Al a Fecha de Alta">Valuación Post. Al a Fecha de Alta</option>
									<option value="Revocación Provisional">Revocación Provisional</option>
									<option value="Recaida sin alta medica">Recaida sin alta medica</option>
									<option value="Revaluación definitiva">Revaluación definitiva</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="control_incapacidad">Control de la Incapacidad:</label>
								<select name="control_incapacidad" id="control_incapacidad" class="form-control">
									<option value="">Selecciona una opción</option>
									<option value="1">Unica</option>
									<option value="2">Inicial</option>
									<option value="3">Subsecuente</option>
									<option value="4">Alta Medica o ST-2</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="fecha_inicio">Fecha de Inicio:</label>
								<input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="fecha_termino">Fecha de Termino:</label>
								<input type="date" id="fecha_termino" class="form-control" disabled>
								<input type="hidden" name="fecha_termino" id="fecha_termino_envio">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label for="folio">Folio:</label>
								<input type="text" name="folio" id="folio" class="form-control">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label for="dias">Días:</label>
								<input type="number" name="dias" id="dias" class="form-control">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label for="porcentaje">Porcentaje:</label>
								<input class="form-control" type="number" id="porcentaje" name="porcentaje" step="0.01" min="0" max="100">
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="incapacidad-permiso-btn" type="button" class="btn btn-primary rounded">Solicitar</button>
				<button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>