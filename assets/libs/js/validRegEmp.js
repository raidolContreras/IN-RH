$(document).ready(function() {
      $("#registro-form").submit(function(event) {
// Obtener valores de los campos
        var nombre = $("#nombre").val();
        var apellidos = $("#apellidos").val();
        var fecha_nacimiento = $("#fecha_nacimiento").val();
        var calle = $("#calle").val();
        var num_exterior = $("#num_exterior").val();
        var num_interior = $("#num_interior").val();
        var colonia = $("#colonia").val();
        var municipio = $("#municipio").val();
        var estado = $("#estado").val();
        var telefono = $("#telefono").val();
        var email = $("#email").val();
// Validar campos
        if (nombre.trim() == "") {
          alert("Por favor, ingrese su(s) nombre(s).");
          $("#nombre").focus();
          return false;
        }            
        if (apellidos.trim() == "") {
          alert("Por favor, ingrese sus apellidos.");
          $("#apellidos").focus();
          return false;
        }

        if (fecha_nacimiento.trim() == "") {
          alert("Por favor, ingrese su fecha de nacimiento.");
          $("#fecha_nacimiento").focus();
          return false;
        }

        if (calle.trim() == "") {
          alert("Por favor, ingrese su calle.");
          $("#calle").focus();
          return false;
        }

        if (num_exterior.trim() == "") {
          alert("Por favor, ingrese su número exterior.");
          $("#num_exterior").focus();
          return false;
        }

        if (colonia.trim() == "") {
          alert("Por favor, ingrese su colonia.");
          $("#colonia").focus();
          return false;
        }

        if (municipio.trim() == "") {
          alert("Por favor, ingrese su municipio.");
          $("#municipio").focus();
          return false;
        }

        if (estado.trim() == "") {
          alert("Por favor, ingrese su estado.");
          $("#estado").focus();
          return false;
        }

        if (telefono.trim() == "") {
          alert("Por favor, ingrese su teléfono.");
          $("#telefono").focus();
          return false;
        }

        if (email.trim() == "") {
          alert("Por favor, ingrese su email.");
          $("#email").focus();
          return false;
        }

// Validar formato de email
        var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!email_regex.test(email)) {
          alert("Por favor, ingrese un email válido.");
          $("#email").focus();
          return false;
        }

// Validar formato de teléfono
        var telefono_regex = /^[0-9]{10}$/;
        if (!telefono_regex.test(telefono)) {
          alert("Por favor, ingrese un teléfono válido de 10 dígitos.");
          $("#telefono").focus();
          return false;
        }

// Validar formato de número de identificación
        var num_identificacion_regex = /^[a-zA-Z0-9]+$/;
        if (!num_identificacion_regex.test($("#num_identificacion").val())) {
          alert("Por favor, ingrese un número de identificación válido (solo letras y números).");
          $("#num_identificacion").focus();
          return false;
        }

// Si todos los campos son válidos, enviar el formulario
        return true;
      });
    });