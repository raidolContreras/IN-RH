const errorMessages = {
	'error-categoria': 'El campo de categoría está vacío. Por favor, selecciona una categoría.',
	'error-nameVendedor': 'El campo del nombre del vendedor está vacío. Por favor, ingresa el nombre del vendedor.',
	'error-divisa': 'El campo de la divisa está vacío. Por favor, selecciona una divisa.',
	'error-importeTotal': 'El campo de importe total está vacío. Por favor, ingresa el importe total.',
	'error-importeIVA': 'El campo del importe del IVA está vacío. Por favor, ingresa el importe del IVA.',
	'error-fechaDocumento': 'El campo de fecha de documento está vacío. Por favor, selecciona la fecha del documento.',
	'error-descripcionGasto': 'El campo de descripción está vacío. Por favor, ingresa una descripción del gasto.',
	'error-folio': 'El campo de motivo está vacío. Por favor, ingresa un motivo del gasto.'
};

Dropzone.autoDiscover = false;

$(document).ready(function() {
	var myDropzone = new Dropzone("#documentos-dropzone", {
		url: "ajax/ajax.formularios.php",
		type: "POST",
		paramName: "file",
		maxFilesize: 10,
		acceptedFiles: ".xlsx,.xls,.pdf",
		addRemoveLinks: true,
		dictRemoveFile: "Eliminar archivo",
		parallelUploads: 100,
		maxFiles: 10,
		uploadMultiple: true,
		autoProcessQueue: false // Habilita la carga automática de archivos
	});

	var idGasto; // Variable para almacenar el ID del gasto

	$("#subirGasto-btn").click(function() {
		var formData = $("#subirGasto-form").serialize(); // Obtener los datos del formulario
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: formData,
			success: function(response) {
				$("#form-result").val("");
				if (response === 'error-categoria' || response === 'error-nameVendedor' || response === 'error-divisa' ||response === 'error-importeTotal' || response === 'error-importeIVA' || response === 'error-fechaDocumento' || response === 'error-descripcionGasto' || response === 'error-folio') {
					showErrorAlert(response);
					deleteAlert();
				}else {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						<i class="fas fa-check-circle"></i>
						Gasto subido exitosamente
						</div>
						`);

					// Almacenar el ID del gasto en la variable idGasto
					idGasto = response;

					myDropzone.processQueue();
					// Vaciar los campos del formulario
					$("#categoria").val("");
					$("#nameVendedor").val("");
					$("#divisa").val("");
					$("#importeTotal").val("");
					$("#importeIVA").val("");
					$("#fechaDocumento").val("");
					$("#descripcionGasto").val("");
					$("#referenciaInterna").val("");

					// Limpiar el Dropzone
					myDropzone.removeAllFiles();
					deleteAlert();
					setTimeout(function() {
						location.href = 'Gastos';
					}, 900);
				}
			}
		});
	});

	$('#eliminarGasto-btn').click(function() {
		var delData = $("#eliminarGasto-form").serialize();
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: delData,
			success: function(response) {
				$("#form-result").val("");
				if (response === 'ok' || response === 'No se pudo eliminar la carpeta o la carpeta no existe.') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Gasto eliminado exitosamente.
						</div>
					`);
					deleteAlert();
					setTimeout(function() {
						location.href = 'Gastos';
					}, 900);
				}
				else {
					$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo eliminar el gasto, intentalo nuevamente.
						</div>
					`);
					deleteAlert();
				}
			}
		});
	});

	$('#eliminarDocumento-btn').click(function() {
		var delDoc = $("#eliminarDocumento-form").serialize();
		var idDoc = document.getElementById("eliminarNameDocumento").value;
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: delDoc,
			success: function(response) {
				$("#form-result").val("");
				if (response === 'ok') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Documento eliminado exitosamente.
						</div>
					`);
					deleteAlert();
					eliminarDiv(idDoc);
					$('#modalEliminarDocumento').modal('hide');
				}
				else {
					$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo eliminar el documento, intentalo nuevamente.
						</div>
					`);
					deleteAlert();
					$('#modalEliminarDocumento').modal('hide');
				}
			}
		});
	});

	// Configuración del evento 'sending' del Dropzone
	myDropzone.on("sending", function(file, xhr, formData) {
		// Solo agregar el campo idGasto si se cumple la condición response !== "error"
		if (idGasto !== 'error') {
			formData.append("idGasto", idGasto);
		}
	});

	// Al hacer clic en el enlace de eliminar documento
	$('.btn-eliminar-documento').click(function(e) {
		e.preventDefault();
		// Obtener los IDs del gasto y el documento que se eliminará
		var documentoId = $(this).data('documento-id');
		var gastosid = $(this).data('gastos-id');
		var eliminarNameDocumento = $(this).data('name');
		
		var eliminarDocumento = $('#eliminarDocumento');
		var eliminarDocumentoGasto = $('#eliminarDocumentoGasto');
		var nameDocumento = $('#eliminarNameDocumento');
		
		// Al hacer clic en el botón "Eliminar" dentro del modal de confirmación
		$('#eliminarDocumento-btn').click(function() {
				// Aquí puedes agregar el código para procesar la eliminación del documento si es necesario
		});

		// Mostrar el modal de confirmación
		$('#modalEliminarDocumento').modal('show');

		eliminarDocumento.val(documentoId);
		eliminarDocumentoGasto.val(gastosid);
		nameDocumento.val(eliminarNameDocumento);

	});

});

function deleteAlert() {
	setTimeout(function() {
		var alert = $('#alerta');
		alert.fadeOut('slow', function() {
			alert.remove();
		});
	}, 1500);
}

// Función para mostrar el mensaje de error
function showErrorAlert(response) {
	const errorMessage = errorMessages[response];
	if (errorMessage) {
		$("#form-result").html(`
			<div class='alert alert-danger' role="alert" id="alerta">
				<i class="fas fa-exclamation-triangle"></i>
				<b>Error</b>, ${errorMessage}
			</div>
		`);
		deleteAlert();
	}
}

function eliminarDiv(divId) {
  var divAEliminar = document.getElementById(divId);
  if (divAEliminar) {
    divAEliminar.remove();
    console.log('El div con ID ' + divId + ' ha sido eliminado.');
  } else {
    console.log('El div con ID ' + divId + ' no existe.');
  }
}

function addDiv(datos) {
	// Parsear el objeto JSON recibido en la función a un objeto de JavaScript
	const documento = JSON.parse(datos);

	// Crear el div con las clases y el ID correspondientes
	const div = document.createElement('div');
	div.className = 'col-lg-6 col-sm-12';
	div.id = documento.nameDocumento;

	// Crear el contenido del div con el código HTML correspondiente
	div.innerHTML = `
		<div class="card card-figure">
			${
				documento.tipo === 'excel'
					? '<div class="row mb-2" style="justify-content: flex-end;">' +`</div>`
					: ''
			}
			<figure class="figure">
				<div class="figure-attachment">
					<span class="fa-stack fa-lg">
						<i class="fa fa-square fa-stack-2x text-primary"></i>
						${
							documento.tipo === 'excel'
								? '<i class="fas fa-file-excel fa-stack-1x fa-inverse"></i>'
								: '<i class="fa fa-file-pdf fa-stack-1x fa-inverse"></i>'
						}
					</span>
				</div>
				<figcaption class="figure-caption">
					<ul class="list-inline d-flex text-muted mb-0">
						<li class="list-inline-item text-truncate mr-auto">
							<span>
								${
									documento.tipo === 'excel'
										? '<i class="fas fa-file-excel"></i>'
										: '<i class="fa fa-file-pdf"></i>'
								}
							</span>
							${documento.nameDocumento}
						</li>
						<li class="list-inline-item">
							<a download="" href="view/Gastos/${documento.Gastos_idGastos}/${documento.nameDocumento}">
								<i class="fas fa-download"></i>
							</a>
						</li>
					</ul>
				</figcaption>
			</figure>
		</div>
	`;

	// Obtener el div existente con el ID específico
	const divContainer = document.getElementById('div' + documento.Gastos_idGastos);

	// Agregar el div creado al contenedor deseado (divContainer)
	divContainer.appendChild(div);
}

// Mostrar el campo de texto cuando se selecciona "Agregar otra opción"
document.getElementById("opciones").addEventListener("change", function () {
  const select = document.getElementById("opciones");
  const otraOpcion = document.getElementById("nfolio");

  if (select.value === "otra") {
    otraOpcion.style.display = "block";
  } else {
    otraOpcion.style.display = "none";
  }
});

function motivo(id){
	$.ajax({
		url: "ajax/ajax.formularios.php",
		type: "POST",
		data: {motivoFinalizar: id},
		success: function(response) {
			$("#form-result").val("");
			if (response === 'ok') {
				$("#form-result").html(`
					<div class='alert alert-success' role="alert" id="alerta">
						<i class="fas fa-check-circle"></i>
						Motivo Finalizado.
					</div>
				`);
				setTimeout(function() {
					location.href = 'Gastos';
				}, 900);
				deleteAlert();
			}
			else {
				$("#form-result").html(`
					<div class='alert alert-danger' role="alert" id="alerta">
						<i class="fas fa-exclamation-triangle"></i>
						<b>Error</b>, no se pudo finalizar el motivo de gasto, intentalo nuevamente.
					</div>
				`);
				deleteAlert();
			}
		}
	});
}