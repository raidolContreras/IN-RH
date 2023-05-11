function calcularTiempoTranscurrido(fecha) {
  var fechaPublicacion = new Date(fecha);
  var tiempoActual = new Date();

  var diferencia = Math.floor((tiempoActual - fechaPublicacion) / 1000); // Diferencia en segundos

  var segundosTranscurridos = diferencia;
  var minutosTranscurridos = Math.floor(diferencia / 60);
  var horasTranscurridas = Math.floor(diferencia / 3600);
  var diasTranscurridos = Math.floor(diferencia / 86400);

  var mensaje;

  if (segundosTranscurridos < 30) {
    mensaje = "Hace unos segundos";
  } else if (minutosTranscurridos < 30) {
    mensaje = "Hace " + segundosTranscurridos + " segundos";
  } else if (minutosTranscurridos >= 30 && minutosTranscurridos <= 59) {
    mensaje = "Hace " + minutosTranscurridos + " minutos";
  } else if (horasTranscurridas >= 1 && horasTranscurridas <= 23) {
    mensaje = "Hace " + horasTranscurridas + " hora(s) con " + (minutosTranscurridos % 60) + " minutos";
  } else {
    mensaje = "Hace " + diasTranscurridos + " días";
  }

  document.getElementById("tiempo-transcurrido").innerHTML = mensaje;
}
