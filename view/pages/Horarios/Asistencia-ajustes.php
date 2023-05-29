<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5">
			<div class="card-header encabezado">Configuración del registro de horas</div>
			<div class="row">
				<div class="card-side-nav col-2 lista-ajustes">
					<div><button class="btn btn-in-consulting-link" onClick="cargarContenido('Registros.php')">Horarios de trabajo</button></div>
					<div><button class="btn btn-in-consulting-link">Importar horarios</button></div>
					<div><button class="btn btn-in-consulting-link">Exportar resultados</button></div>
				</div>
				<div class="col-10" id="horarios">
					
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function cargarContenido(pagina) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("horarios").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("POST", "view/pages/Horarios/Registro_horarios/" + pagina, true);
	xmlhttp.send();
}

window.onload = function() {
	cargarContenido('Registros.php');
};
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
