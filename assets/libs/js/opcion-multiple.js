function generarInputs() {
  $(".btn-registrar-respuestas").show();
  nRespuestas = document.getElementById('nRespuestas').value;
  var respuestasContainer = document.getElementById('respuesta-form');
  respuestasContainer.innerHTML = ''; // Limpiar el contenedor antes de generar los nuevos inputs

  for (var i = 1; i <= nRespuestas; i++) {
    // Crear el elemento de input de respuesta
    var respuestaInput = document.createElement('input');
    respuestaInput.type = 'text';
    respuestaInput.className = 'form-control';
    respuestaInput.name = 'Respuesta' + i;
    respuestaInput.id = 'Respuesta' + i;
    respuestaInput.required = true;

    var div = document.createElement('div');
    div.className = 'row';
    div.classList.add('col-xl-6'); 
    div.classList.add('mt-3'); 

    var divText = document.createElement('div');
    divText.className = 'col-xl-8';

    var divCheckbox = document.createElement('div');
    divCheckbox.className = 'col-xl-4';

    // Crear el elemento de etiqueta para la respuesta
    var respuestaLabel = document.createElement('label');
    respuestaLabel.htmlFor = 'Respuesta' + i;
    respuestaLabel.innerText = 'Respuesta n° ' + i;

    // Crear el elemento de input para marcar como correcta
    var correctaInput = document.createElement('input');
    correctaInput.type = 'checkbox';
    correctaInput.className = 'form-control';
    correctaInput.name = 'Correcta' + i;
    correctaInput.addEventListener('change', function () {
      cambiarColorInputs();
    }); // Agregar el evento de cambio para detectar cuando se marca o desmarca como correcta

    // Crear el elemento de etiqueta para marcar como correcta
    var correctaLabel = document.createElement('label');
    correctaLabel.htmlFor = 'Correcta' + i;
    correctaLabel.innerText = 'Marcar como correcta';

    // Crear el contenedor para la respuesta y la marca de correcta
    var respuestaContainer = document.createElement('div');
    respuestaContainer.className = 'form-row';

    divText.appendChild(respuestaLabel);
    divText.appendChild(respuestaInput);

    divCheckbox.appendChild(correctaLabel);
    divCheckbox.appendChild(correctaInput);

    div.appendChild(divCheckbox);
    div.appendChild(divText);


    // Agregar el contenedor de respuesta al contenedor principal
    respuestasContainer.appendChild(div);
  }

}

function cambiarColorInputs() {
  var inputsRespuesta = document.querySelectorAll('input[name^="Correcta"]');
  inputsRespuesta.forEach(function (input) {
    var respuestaInput = document.getElementById('Respuesta' + input.name.slice(-1));

    if (input.checked) {
      respuestaInput.style.borderColor = 'green'; // Cambiar el color del borde a verde si está marcado como correcta
    } else {
      respuestaInput.style.borderColor = 'red'; // Cambiar el color del borde a rojo si no está marcado como correcta
    }
  });
}