	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style>
	.col-03 {
		font-size: 27px;
	}
	.tabla-asistencia{
		height: 700px;
		overflow-y: scroll;
	}
	.enable-days{
		margin-right: 0 !important;
		margin-left:: 0 !important;
		border-top: 1px solid #dedede;
		height: 80px !important;
			align-content: center;
	}
	.enable-days:first-child{
		margin-right: 0 !important;
		margin-left:: 0 !important;
		border-top: 0px;
	}
	.dia-selected {
		position: relative;
		border-left: 1px solid #73c78e;
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
		padding-bottom: 2px;
		height: 85px !important;
		align-content: center;
		background-color: #f8f9fa;
	}

	.dia-selected::before {
		content: "";
		position: absolute;
		top: 0;
		left: -2px;
		width: 2px;
		height: 100%;
		background-color: #73c78e;
	}
</style>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5">
			<div class="card-body">
				<div class="row">
					<div class="col-xl-5 col-lg-4 col-md-3 col-sm-2 col-1">
						<button class="btn btn-light float-right" id="previous-month" style="font-size: 16px;">
							<i class="fas fa-angle-left"></i>
						</button>
					</div>
					<div class="col-xl-2 col-lg-4 col-md-6 col-sm-8 col-9 text-center">
						<h2 id="mes"></h2>
					</div>
					<div class="col-xl-5 col-lg-4 col-md-3 col-sm-2 col-1">
						<button class="btn btn-light float-left" id="next-month" style="font-size: 16px;">
							<i class="fas fa-angle-right"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="card mx-5 mt-3">
			<div class="card-body">
				<div class="tabla-asistencia" style="" id="dias-mes">
				</div>
			</div>
		</div>
	</div>
</div>


	<script>
$(document).ready(function() {
  // Lista de meses
  var meses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
  ];

  // Obtener la fecha actual
  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  var currentMonthIndex = currentDate.getMonth();
  // Obtener el día actual
  var currentDay = currentDate.getDate();

  // Mostrar el mes y año actual
  showMonth(currentMonthIndex, currentYear);

  // Manejar el evento clic del botón anterior
  $("#previous-month").click(function() {
    if (currentMonthIndex === 0) {
      currentYear--;
      currentMonthIndex = 11;
    } else {
      currentMonthIndex--;
    }
    currentDay = 1; // Restablecer el día al primer día del mes
    showMonth(currentMonthIndex, currentYear);
  });

  // Manejar el evento clic del botón siguiente
  $("#next-month").click(function() {
    if (currentMonthIndex === 11) {
      currentYear++;
      currentMonthIndex = 0;
    } else {
      currentMonthIndex++;
    }
    currentDay = 1; // Restablecer el día al primer día del mes
    showMonth(currentMonthIndex, currentYear);
  });

  // Función para mostrar el mes según el índice dado
  function showMonth(index, year) {
    var month = meses[index];
    $("#mes").text(month + " " + year);

    // Obtener los días del mes actual
    var daysInMonth = getDaysInMonth(index, year);

    // Obtener el primer día de la semana del mes actual
    var firstDayOfWeek = new Date(year, index, 1).getDay();

    // Generar las filas y celdas de la tabla
    var tableBody = $("#dias-mes");
    tableBody.empty();

    var tableHeight = 700; // Altura deseada de la tabla en píxeles
    var rowHeight = 80; // Altura estimada de cada fila en píxeles
    var scrollToDay = currentDay; // Día al que se debe desplazar la tabla

    for (var i = 1; i <= daysInMonth; i++) {
      var day = new Date(year, index, i);
      var dayName = getDayName(day.getDay());

      var celda = $("<div>", {
        class: "row enable-days" + (currentDay === i ? " dia-selected ml-2" : "")
      });

      var dayCell = $("<div>", {
        class: "col-03 ml-3",
        text: padZero(i)
      });

      var datosDate = $("<div>", { class: "row" });
      datosDate.append($("<div>", { class: "col-12", text: dayName }));
      datosDate.append($("<div>", { class: "col-12", text: "Esperando 0h 0min" }));

      var textCell = $("<div>", {
        class: "col-sm-6 col-md-5 col-lg-3 col-xl-2"
      }).append(datosDate);

      celda.append(dayCell, textCell);
      tableBody.append(celda);
    }
  }


	// Función para obtener el nombre del día de la semana
	function getDayName(dayIndex) {
		var days = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
		return days[dayIndex];
	}

	// Función para agregar un cero a la izquierda si el número es menor a 10
	function padZero(number) {
		return number < 10 ? "0" + number : number;
	}

	// Función para obtener la cantidad de días en un mes específico
	function getDaysInMonth(monthIndex, year) {
		if (monthIndex === 1 && isLeapYear(year)) {
			return 29; // Febrero en año bisiesto
		} else {
			return new Date(year, monthIndex + 1, 0).getDate();
		}
	}

	// Función para verificar si un año es bisiesto
	function isLeapYear(year) {
		return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
	}
});

	</script>