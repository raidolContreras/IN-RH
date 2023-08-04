function generatePDF(gastosData) {
  const { jsPDF } = window.jspdf;

  const doc = new jsPDF({
    orientation: "p",
    unit: "pt",
    format: "letter",
  });

  // Estilo para títulos fijos
  const fixedTitleStyle = {
    fontSize: 12,
    fontWeight: "bold",
    textColor: [0, 51, 102], // Color azul oscuro
  };

  // Estilo para valores fijos
  const fixedValueStyle = {
    fontSize: 10,
    fontWeight: "normal",
    textColor: [51, 51, 51], // Color gris oscuro
  };

  // Estilo para títulos variables
  const variableTitleStyle = {
    fontSize: 10,
    fontWeight: "bold",
    textColor: [51, 51, 51], // Color gris oscuro
  };

  // Estilo para valores variables
  const variableValueStyle = {
    fontSize: 10,
    fontWeight: "normal",
    textColor: [102, 102, 102], // Color gris claro
  };

  // Función para agregar un rectángulo con texto dentro y una sombra
  const addTextBoxWithShadow = (title, value, x, y, width, height, titleStyle, valueStyle) => {
    const shadowOffset = 2;

    // Agregar sombra al rectángulo
    doc.setFillColor(220, 220, 220); // Color de la sombra
    doc.rect(x + shadowOffset, y + shadowOffset, width, height, "F"); // Dibuja la sombra

    // Agregar el rectángulo con el fondo blanco
    doc.setFillColor(255, 255, 255); // Color del rectángulo
    doc.rect(x, y, width, height, "F"); // Dibuja el rectángulo

    // Agregar el contenido del rectángulo
    doc.setTextColor(titleStyle.textColor[0], titleStyle.textColor[1], titleStyle.textColor[2]);
    doc.setFont(titleStyle.fontWeight, "bold"); // Establece el estilo del título
    doc.setFontSize(titleStyle.fontSize); // Establece el tamaño de fuente del título
    doc.text(title, x + 15, y + 30); // Agrega el título alineado a la izquierda

    doc.setTextColor(valueStyle.textColor[0], valueStyle.textColor[1], valueStyle.textColor[2]);
    doc.setFont(valueStyle.fontWeight, "normal"); // Establece el estilo del valor
    doc.setFontSize(valueStyle.fontSize); // Establece el tamaño de fuente del valor
    doc.text(value, x + 15, y + 50); // Agrega el valor alineado a la izquierda
  };

  // Agregar una imagen de encabezado
  const logoImage = new Image();
  logoImage.src = "assets/images/logoinconsulting.png";

  // Fondo de encabezado con degradado y sombra
  const headerHeight = 80; // Aumentamos la altura para dar espacio al logo
  doc.setDrawColor(0, 51, 102); // Color del borde degradado
  doc.setFillColor(255, 255, 255); // Color azul oscuro para el inicio del degradado
  doc.rect(0, 0, doc.internal.pageSize.width, headerHeight, "FD");

  // Título del documento en blanco y sombra
  doc.setTextColor(0, 51, 102);
  doc.setFontSize(24);
  doc.text("Información del gasto", 40, 50); // Ajustamos la posición vertical

  // Agregar logo en el encabezado
  doc.addImage(logoImage, "PNG", 510, 10, 60, 60); // Ajustamos posición y tamaño del logo

  // Agregar pie de página con degradado y sombra
  const footerHeight = 40;
  doc.setDrawColor(102, 102, 102); // Color del borde degradado
  doc.setFillColor(230, 230, 230); // Color gris claro para el inicio del degradado
  doc.rect(0, doc.internal.pageSize.height - footerHeight, doc.internal.pageSize.width, footerHeight, "FD");
  doc.setFontSize(10);
  doc.setTextColor(51, 51, 51);
  doc.text("© " + new Date().getFullYear() + " In Consulting. Todos los derechos reservados.", 40, 775);

  // Agregar la tabla con los datos y sombras
  addTextBoxWithShadow(
    "Empleado que registró:",
    gastosData.nombre,
    55,
    headerHeight + 30,
    250,
    60,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Fecha de creación:",
    gastosData.fecha_creacion,
    330,
    headerHeight + 30,
    240,
    60,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Estatus:",
    gastosData.status,
    330,
    headerHeight + 130,
    240,
    60,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Categoría:",
    gastosData.categoria,
    55,
    headerHeight + 130,
    250,
    60,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Fecha de la factura:",
    gastosData.fechaDocumento,
    330,
    headerHeight + 230,
    240,
    60,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Nombre del vendedor:",
    gastosData.nameVendedor,
    55,
    headerHeight + 230,
    250,
    60,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Importe total:",
    gastosData.importeTotal,
    55,
    headerHeight + 330,
    250,
    60,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Importe del IVA:",
    gastosData.importeIVA,
    330,
    headerHeight + 330,
    240,
    60,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Descripción:",
    gastosData.descripcionGasto,
    55,
    headerHeight + 430,
    515,
    90,
    fixedTitleStyle,
    variableValueStyle
  );
  addTextBoxWithShadow(
    "Referencia interna:",
    gastosData.referenciaInterna,
    55,
    headerHeight + 570,
    515,
    60,
    fixedTitleStyle,
    variableValueStyle
  );

  // Agregar una línea decorativa
  doc.setDrawColor(220, 220, 220); // Color gris claro

  doc.save(gastosData.nameDocPDF);
}


function deleteAlert() {
  setTimeout(() => {
    $("#alerta").fadeOut(500, function () {
      $(this).remove();
    });
  }, 3000);
}

function pdf(gastosid) {
  $.ajax({
    url: "ajax/ajax.formularios.php",
    type: "POST",
    data: { pdfGastos: gastosid },
    success: function (response) {
      $("#form-result").val("");
      if (response !== "error") {
        $("#form-result").html(`
          <div class='alert alert-success' role="alert" id="alerta">
            <i class="fas fa-check-circle"></i>
            Generando PDF.
          </div>
        `);
        const responseObject = JSON.parse(response);
        generatePDF(responseObject);
        deleteAlert();
      } else {
        $("#form-result").html(`
          <div class='alert alert-danger' role="alert" id="alerta">
            <i class="fas fa-exclamation-triangle"></i>
            <b>Error</b>, no se pudo generar el documento, inténtalo nuevamente.
          </div>
        `);
        deleteAlert();
      }
    },
  });
}
