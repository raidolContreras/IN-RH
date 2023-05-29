<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="card p-4">
			<form id="NewHorario-form">
				<div class="row mb-2">
					<div class="col-6">
						<label class="col-form-label font-weight-light" for="nameHorario">Añadir un nombre</label>
						<input class="form-control" type="text" name="nameHorario" id="nameHorario">
					</div>
					<div class="col-6">
						<label class="col-form-label font-weight-light" for="tipo_Horario">Horas esperadas por día</label>
						<select class="form-control" name="tipo_Horario" id="tipo_Horario">
							<option value="1" selected>Fijo</option>
							<option value="2">Flexible</option>
						</select>
					</div>
				</div>

				<div class="encabezado pt-4">Selecciona las horas por cada día laboral</div>
				<p class="ajustes-text"><i class="far fa-question-circle"></i> Añade todos los turnos por día para esta plantilla de horario de trabajo.</p>

				<div class="table-in">
					<div class="table-header row">
						<div class="col-3"></div>
						<div class="col-3">DÍAS</div>
						<div class="col-3">HORARIOS DE TRABAJO</div>
						<div class="col-3">HORAS ESPERADAS</div>
					</div>
					<div class="table-body">
							<div class="row">
								<div class="col-3"><input type="checkbox" id="Lunes" value="1" onchange="activarDiv(this)"></div>
								<div class="col-4" id="dia1">Lunes</div>
								<div class="col-4" id="horarios1"></div>
								<div class="col-4" id="horasxdia1"></div>
							</div>
							<div class="row">
								<div class="col-3"><input type="checkbox" id="Martes" value="2" onchange="activarDiv(this)"></div>
								<div class="col-4" id="dia2">Martes</div>
								<div class="col-4" id="horarios2"></div>
								<div class="col-4" id="horasxdia2"></div>
							</div>
							<div class="row">
								<div class="col-3"><input type="checkbox" id="Miércoles" value="3" onchange="activarDiv(this)"></div>
								<div class="col-4" id="dia3">Miércoles</div>
								<div class="col-4" id="horarios3"></div>
								<div class="col-4" id="horasxdia3"></div>
							</div>
							<div class="row">
								<div class="col-3"><input type="checkbox" id="Jueves" value="4" onchange="activarDiv(this)"></div>
								<div class="col-4" id="dia4">Jueves</div>
								<div class="col-4" id="horarios4"></div>
								<div class="col-4" id="horasxdia4"></div>
							</div>
							<div class="row">
								<div class="col-3"><input type="checkbox" id="Viernes" value="5" onchange="activarDiv(this)"></div>
								<div class="col-4" id="dia5">Viernes</div>
								<div class="col-4" id="horarios5"></div>
								<div class="col-4" id="horasxdia5"></div>
							</div>
							<div class="row">
								<div class="col-3"><input type="checkbox" id="Sábado" value="6" onchange="activarDiv(this)"></div>
								<div class="col-4" id="dia6">Sábado</div>
								<div class="col-4" id="horarios6"></div>
								<div class="col-4" id="horasxdia6"></div>
							</div>
							<div class="row">
								<div class="col-3"><input type="checkbox" id="Domingo" value="7" onchange="activarDiv(this)"></div>
								<div class="col-4" id="dia7">Domingo</div>
								<div class="col-4" id="horarios7"></div>
								<div class="col-4" id="horasxdia7"></div>
							</div>
					</div>
				</div>

				<div class="card">
					<div class="card-footer p-0 text-center d-flex justify-content-center ">
						<div class="card-footer-item card-footer-item-bordered">
							<button data-dismiss="modal" class="card-link btn btn-outline-secondary">Cancelar</button>
						</div>
						<div class="card-footer-item card-footer-item-bordered">
							<button disabled type="button" id="NewHorario-btn" data-dismiss="modal" class="card-link btn btn-outline-primary">Enviar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function activarDiv(checkbox) {
		var dia = checkbox.value;
		var diaElement = document.getElementById("dia" + dia);
		var horariosElement = document.getElementById("horarios" + dia);
		var horasxdiaElement = document.getElementById("horasxdia" + dia);

		if (checkbox.checked) {
			diaElement.classList.add("active");
			horariosElement.classList.add("active");
			horasxdiaElement.classList.add("active");
      		//btnEnviar.classList.remove("disabled");

			horariosElement.innerHTML = "";

			var inputDia = document.createElement("input");
			inputDia.className = "form-control";
			inputDia.value = "--:--";

			var divDia = document.createElement("div");
			divDia.className = "form-control";
			divDia.appendChild(inputDia);

			horariosElement.appendChild(divDia);
		} else {
			diaElement.classList.remove("active");
			horariosElement.classList.remove("active");
			horasxdiaElement.classList.remove("active");
      		//btnEnviar.classList.add("disabled");
		}
	}
</script>
