<div class="row mr-4 ml-2 mt-3">
    <div class="card-header encabezado">
        Importar horarios
    </div>
    <div class="card-body">
        <p class="ajustes-text">Para descargar el archivo csv de ejemplo, haz clic en el siguiente enlace. Este archivo te servirá de guía para el formato que debes usar. Recuerda que el archivo debe estar separado por comas.
        <a class="btn btn-in-consulting" href="/Documentación/Ejemplo.csv" download="Ejemplo.csv">
            <i class="fas fa-download"></i> <span>Descargar ejemplo</span>
        </a></p>

        <div>
            <form id="csvForm" enctype="multipart/form-data" class="mt-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="csvFile" accept=".csv" id="csvFileInput">
                    <label class="custom-file-label" for="csvFileInput">Seleccionar archivo CSV</label>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-2">Cargar archivo</button>
            </form>

            <div id="csvFields" class="mt-4"></div>

            <button id="confirmBtn" class="btn btn-outline-secondary" style="display: none;">Aceptar</button>

            <div id="message" class="mt-4"></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#csvForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'ajax/controlador_csv.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                // Mostrar los campos del encabezado para su confirmación
                showCSVFields(response);
                $('#confirmBtn').show();
            },
            error: function(xhr, status, error) {
                $('#message').text('Error: ' + error);
            }
        });
    });

    $('#confirmBtn').click(function() {
        // Procesar los datos del archivo CSV
        processCSVData();
    });
});

function showCSVFields(fields) {
    var csvFieldsDiv = $('#csvFields');
    csvFieldsDiv.empty();

    var table = $('<table>').addClass('table');
    var thead = $('<thead>');
    var tbody = $('<tbody>');

    // Crea la fila de encabezado
    var headerRow = $('<tr>');
    $.each(fields.fields, function(index, field) {
        headerRow.append($('<th>').text(field));
    });
    thead.append(headerRow);

    // Crea las filas de datos
    $.each(fields.data, function(index, row) {
        var dataRow = $('<tr>');
        $.each(row, function(_, value) {
            dataRow.append($('<td>').text(value));
        });
        tbody.append(dataRow);
    });

    // Agrega el encabezado y el cuerpo a la tabla
    table.append(thead);
    table.append(tbody);

    csvFieldsDiv.append(table);
}

function processCSVData() {
    $.ajax({
        url: 'ajax/controlador_csv.php',
        type: 'POST',
        data: { action: 'insertData' },
        success: function(response) {
            $('#message').parent().after(`
				<div class="alert alert-success" role="alert" id="alerta">Los datos se han subido exitosamente.</div>
		`);
			deleteAlert();
        },
        error: function(xhr, status, error) {
            $('#message').text('Error: ' + error);
        }
    });
}

function deleteAlert() {
  setTimeout(function() {
    var alert = $('#alerta');
    alert.fadeOut('slow', function() {
      alert.remove();
    });
  }, 1500);
}
</script>
