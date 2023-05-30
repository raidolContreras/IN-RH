<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="card p-4">
			<form id="NewHorario-form">
				<div class="row mb-2">
					<div class="col-7">
						<label class="col-form-label font-weight-light" for="nameHorario">Añadir un nombre</label>
						<input class="form-control" type="text" name="nameHorario" id="nameHorario">
					</div>
				</div>

				<div class="encabezado pt-4">Selecciona las horas por cada día laboral</div>
				<p class="ajustes-text"><i class="far fa-question-circle"></i> Añade todos los turnos por día para esta plantilla de horario de trabajo.</p>

				<div class="table-in">
					<div class="table-header row">
						<div class="col-1"></div>
						<div class="col-2">DÍAS</div>
						<div class="col-5">HORARIOS DE TRABAJO</div>
						<div class="col-4">HORAS ESPERADAS</div>
					</div>
					<div class="table-body">
							<div class="row">
								<div class="col-1"><input type="checkbox" id="Lunes" value="1" onchange="activarDiv(this)"></div>
								<div class="col-2" id="dia1">Lunes</div>
								<div class="col-5" id="horarios1"></div>
								<div class="col-4" id="horasxdia1"></div>
							</div>
							<div class="row">
								<div class="col-1"><input type="checkbox" id="Martes" value="2" onchange="activarDiv(this)"></div>
								<div class="col-2" id="dia2">Martes</div>
								<div class="col-5" id="horarios2"></div>
								<div class="col-4" id="horasxdia2"></div>
							</div>
							<div class="row">
								<div class="col-1"><input type="checkbox" id="Miércoles" value="3" onchange="activarDiv(this)"></div>
								<div class="col-2" id="dia3">Miércoles</div>
								<div class="col-5" id="horarios3"></div>
								<div class="col-4" id="horasxdia3"></div>
							</div>
							<div class="row">
								<div class="col-1"><input type="checkbox" id="Jueves" value="4" onchange="activarDiv(this)"></div>
								<div class="col-2" id="dia4">Jueves</div>
								<div class="col-5" id="horarios4"></div>
								<div class="col-4" id="horasxdia4"></div>
							</div>
							<div class="row">
								<div class="col-1"><input type="checkbox" id="Viernes" value="5" onchange="activarDiv(this)"></div>
								<div class="col-2" id="dia5">Viernes</div>
								<div class="col-5" id="horarios5"></div>
								<div class="col-4" id="horasxdia5"></div>
							</div>
							<div class="row">
								<div class="col-1"><input type="checkbox" id="Sábado" value="6" onchange="activarDiv(this)"></div>
								<div class="col-2" id="dia6">Sábado</div>
								<div class="col-5" id="horarios6"></div>
								<div class="col-4" id="horasxdia6"></div>
							</div>
							<div class="row">
								<div class="col-1"><input type="checkbox" id="Domingo" value="7" onchange="activarDiv(this)"></div>
								<div class="col-2" id="dia7">Domingo</div>
								<div class="col-5" id="horarios7"></div>
								<div class="col-4" id="horasxdia7"></div>
							</div>
					</div>
				</div>

				<div class="card">
					<div class="card-footer p-0 text-center d-flex justify-content-center ">
						<div class="card-footer-item card-footer-item-bordered">
							<button data-dismiss="modal" class="card-link btn btn-outline-secondary btn-block rounded">Cancelar</button>
						</div>
						<div class="card-footer-item card-footer-item-bordered">
							<button  type="button" id="NewHorario-btn" data-dismiss="modal" class="card-link btn btn-outline-primary disabled btn-block rounded">Enviar</button>
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
    var btnEnviar = document.getElementById("NewHorario-btn");

    if (checkbox.checked) {
      diaElement.classList.add("active");
      horariosElement.classList.add("active");
      horasxdiaElement.classList.add("active");

      horariosElement.innerHTML = "";

      var inputDia = document.createElement("input");
      inputDia.className = "form-control input-dia";
      inputDia.name = "Entrada" + dia;
      inputDia.type = "time";
      inputDia.addEventListener("input", function () {
        calcularHoras(dia);
      });

      var inputDia2 = document.createElement("input");
      inputDia2.className = "form-control input-dia";
      inputDia2.name = "Salida" + dia;
      inputDia2.type = "time";
      inputDia2.addEventListener("input", function () {
        calcularHoras(dia);
      });

      var entrada = document.createElement("div");
      var salida = document.createElement("div");
      var texto = document.createElement("div");

      entrada.className = "col-5";
      salida.className = "col-5";
      texto.className = "col-2";

      var newContent = document.createTextNode(" a ");

      entrada.appendChild(inputDia);
      salida.appendChild(inputDia2);
      texto.appendChild(newContent);

      var divDia = document.createElement("div");
      divDia.className = "row";
      divDia.appendChild(entrada);
      divDia.appendChild(texto);
      divDia.appendChild(salida);
      horariosElement.appendChild(divDia);

      calcularHoras(dia);
      } else {
    diaElement.classList.remove("active");
    horariosElement.classList.remove("active");
    horasxdiaElement.classList.remove("active");

    // Eliminar los elementos creados anteriormente
    horariosElement.innerHTML = "";

    // Limpiar el contenido del elemento horasxdiaElement
    horasxdiaElement.textContent = "";
  }

  verificarCheckboxes();
}

  function verificarCheckboxes() {
    var checkboxes = document.querySelectorAll("input[type='checkbox']");
    var btnEnviar = document.getElementById("NewHorario-btn");

    var todosDesactivados = true;

    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        todosDesactivados = false;
        break;
      }
    }

    if (todosDesactivados) {
      btnEnviar.classList.add("disabled");
    } else {
      btnEnviar.classList.remove("disabled");
    }
  }

  function calcularHoras(dia) {
    var horasxdia = document.getElementById("horasxdia" + dia);
    var inputs = document.querySelectorAll("#horarios" + dia + " input[type='time']");

    var entrada = inputs[0].value.split(":");
    var salida = inputs[1].value.split(":");

    var horaEntrada = parseInt(entrada[0]);
    var minutoEntrada = parseInt(entrada[1]);
    var horaSalida = parseInt(salida[0]);
    var minutoSalida = parseInt(salida[1]);

    var diferenciaHoras = horaSalida - horaEntrada;
    var diferenciaMinutos = minutoSalida - minutoEntrada;

    if (diferenciaMinutos < 0) {
      diferenciaHoras -= 1;
      diferenciaMinutos += 60;
    }
    if (isNaN(diferenciaHoras) || isNaN(diferenciaMinutos)) {
      diferenciaHoras = 0;
      diferenciaMinutos = 0;
    }

    horasxdia.textContent = diferenciaHoras + " horas " + diferenciaMinutos + " min";
  }

  // Verificar checkboxes al cargar la página
  window.onload = function () {
    verificarCheckboxes();
  };
</script>
