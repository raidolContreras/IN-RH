
$(document).ready(function() {
  $(".exportarExcel-btn").click(function() {
    var formData = $(this).closest('.exportarExcel-form').serialize();

    $.ajax({
      url: "ajax/ajax.formularios.php",
      type: "POST",
      data: formData,
      success: function(response) {
        if (response !== '"Error"') {
          var respuesta = response.replace(/"/g, '');
          $("#form-result").html(`
            <div class='alert alert-success' role="alert" id="alerta">
              <i class="fas fa-check-circle"></i>
              <strong class="mx-2">¡Éxito!</strong>
            </div>
          `);

          window.location.href = "view/Asistencias/" + respuesta + ".xlsx";
          deleteAlert();
        } else {
          $("#form-result").html(`
            <div class='alert alert-danger' role="alert" id="alerta">
              <i class="fas fa-exclamation-triangle"></i>
              <strong class="mx-2">Error!</strong> No se pudo generar el Excel, intenta nuevamente
            </div>
          `);
          deleteAlert();
        }
      }
    });
  });

  $(".btn-in-consulting-link").click(function() {
    $(".btn-in-consulting-link").removeClass("activo");
    $(this).addClass("activo");
    var id = $(this).data("id");
    // Realizar las operaciones correspondientes con el ID seleccionado
  });
});

$(document).ready(function() {
  $(".exportarExcelEmpresas-btn").click(function() {
    var formData = $(this).closest('.exportarExcelEmpresas-form').serialize();

    $.ajax({
      url: "ajax/ajax.formularios.php",
      type: "POST",
      data: formData,
      success: function(response) {
        if (response !== '"Error"') {
          var respuesta = response.replace(/"/g, '');
          $("#form-result").html(`
            <div class='alert alert-success' role="alert" id="alerta">
              <i class="fas fa-check-circle"></i>
              <strong class="mx-2">¡Éxito!</strong>
            </div>
          `);

          window.location.href = "view/Asistencias/" + respuesta + ".xlsx";
          deleteAlert();
        } else {
          $("#form-result").html(`
            <div class='alert alert-danger' role="alert" id="alerta">
              <i class="fas fa-exclamation-triangle"></i>
              <strong class="mx-2">Error!</strong> No se pudo generar el Excel, intenta nuevamente
            </div>
          `);
          deleteAlert();
        }
      }
    });
  });

  $(".btn-in-consulting-link").click(function() {
    $(".btn-in-consulting-link").removeClass("activo");
    $(this).addClass("activo");
    var id = $(this).data("id");
    // Realizar las operaciones correspondientes con el ID seleccionado
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