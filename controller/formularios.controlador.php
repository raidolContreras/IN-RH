<?php

class ControladorFormularios{

	/*---------- Función hecha para registrar a los empleados---------- */

	static public function ctrRegistrarEmpleados(){
		if (isset($_POST['nombre'])) {

			$datos = array('nombre' => $_POST['nombre'],
				'apellidos' => $_POST['apellidos'],
				'genero' => $_POST['genero'],
				'fecha_nacimiento' => $_POST['fecha_nacimiento'],
				'num_identificacion' => $_POST['num_identificacion'],
				'num_seguro_social' => $_POST['num_seguro_social'],
				'rfc' => $_POST['rfc'],
				'calle' => $_POST['calle'],
				'num_exterior' => $_POST['num_exterior'],
				'num_interior' => $_POST['num_interior'],
				'colonia' => $_POST['colonia'],
				'cp' => $_POST['cp'],
				'municipio' => $_POST['municipio'],
				'estado' => $_POST['estado'],
				'telefono' => $_POST['telefono'],
				'email' => $_POST['email'],
				'emergencia' => $_POST['emergencia'],
				'telefonoE' => $_POST['telefonoE'],
				'parentesco' => $_POST['parentesco']);
			$Registro = ModeloFormularios::mdlRegistrarEmpleados('empleados','emergencia', $datos);
			if ($Registro == 'ok') {
				return 'ok';
			}else{
				return 'error';
			}
		}

	}

	static public function ctrRegistrarHistorial($idEmpleado){
		if (isset($_POST['empresa']) && isset($_POST['puesto'])) {
			if ($_POST['empresa'] != '' && $_POST['puesto'] != '') {
				if (isset($_POST['noResponder'])) {
					$noResponder = 1;
					$salario = null;
				}else{
					$noResponder = 0;
				}
				if (isset($_POST['trabajo_actual'])) {
					$trabajo_actual = 1;
				}else{
					$trabajo_actual = 0;
				}
				$tabla = 'historial_laboral';
				$datos = array('empresa' => $_POST['empresa'],
					'puesto' => $_POST['puesto'],
					'noResponder' => $noResponder,
					'salario' => $salario,
					'fecha_inicio' => $_POST['fecha_inicio'],
					'trabajo_actual' => $trabajo_actual,
					'fecha_fin' => $_POST['fecha_fin'],
					'motivos' => $_POST['motivos'],
					'logros' => $_POST['logros'],
					'accion' => $_POST['accion']);

				$Registro = ModeloFormularios::mdlRegistrarHistorial($tabla, $datos, $idEmpleado);

				if ($Registro == 'otro') {
					return 'otro';
				}elseif ($Registro == 'terminar') {
					return 'terminar';
				}else{
					return 'error';
				}

			}
		}
	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function ctrVerEmpleados($item, $valor){

		$tabla = "empleados";

		$respuesta = ModeloFormularios::mdlVerEmpleados($tabla, $item, $valor);

		return $respuesta;

	}

	/*---------- Esta función envia los datos para crear el formato del numero teléfonico ---------- */
	static public function ctrNumeroTelefonico($phone){
		$numero = ModeloFormularios::mdlNumeroTelefonico($phone);
		return $numero;
	}

	/*---------- Esta función envia los datos para crear el formato del numero teléfonico ---------- */
	static public function ctrSeleccionarHisrory($idEmpleado){
		$tabla = 'historial_laboral';
		$history = ModeloFormularios::mdlSeleccionarHisrory($tabla, $idEmpleado);
		return $history;
	}

	static public function ctrFecha($fecha){
		setlocale(LC_TIME, 'es_ES');
		$originalDate = $fecha;
		$newDate = strftime("%b' %y", strtotime($originalDate));
		return $newDate;
	}

	static public function ctrEliminarEmpleado(){
		if (isset($_POST['Editar'])) {
			$tabla = 'empleados';
			$eliminar = ModeloFormularios::mdlEliminarEmpleado($tabla, $_POST['Editar']);
			if ($eliminar == 'ok') {
				return 'ok';
			}else{
				return 'error';
			}
		}
	}


	/*---------- Esta función Sube una foto, y guarda un tumbnails para optimización de la pagina ---------- */
	static public function ctrSubirFoto(){

		if (isset($_FILES["image-upload"]) && $_FILES["image-upload"]["error"] == 0) {
// Obtener los datos del archivo
			$imagen = $_FILES["image-upload"];
			$tabla = "foto_empleado";
			$imageName = $_POST["name"] . " " . $_POST["lastname"];

// Obtener la extensión del archivo
			$extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);

// Renombrar la imagen con el nombre y apellidos proporcionados, más la extensión
			$imageFileName = $imageName . "." . $extension;

// Guardar la imagen original en el servidor
			$uploadPath = "view/fotos/" . $imageFileName;
			move_uploaded_file($imagen["tmp_name"], $uploadPath);

// Obtener la ruta para la imagen en miniatura
			$thumbnailPath = "view/fotos/thumbnails/" . $imageFileName;

// Cargar la imagen original
			$originalImage = imagecreatefromstring(file_get_contents($uploadPath));

// Obtener las dimensiones originales de la imagen
			$originalWidth = imagesx($originalImage);
			$originalHeight = imagesy($originalImage);

// Calcular las nuevas dimensiones para la imagen en miniatura
			$maxSize = 150;
			$scale = min($maxSize / $originalWidth, $maxSize / $originalHeight);
			$newWidth = round($scale * $originalWidth);
			$newHeight = round($scale * $originalHeight);

// Crear la imagen en miniatura
			$thumbnailImage = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresampled($thumbnailImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

// Guardar la imagen en miniatura en el servidor
			imagepng($thumbnailImage, $thumbnailPath);

// Guardar los datos en la base de datos
			$datos = array("imageName" => $imageFileName,
				"idEmpleado" => $_POST['idEmpleado']
			);
			$respuesta = ModeloFormularios::mdlRegistroFotoEmpleado($tabla, $datos);

			return $respuesta;
		}
	}

	/*---------- Función hecha para Buscar las Fotos---------- */
	static public function ctrVerFotos($item, $valor){

		$tabla = "foto_empleado";

		$respuesta = ModeloFormularios::mdlVerFotos($tabla, $item, $valor);

		return $respuesta;

	}

/*---------- Función hecha para subir pdf---------- */
	static public function ctrSubirPDF(){
		if (isset($_POST['name'])) {
			if ($_FILES['curriculum']['error'] > 0) {
			  echo 'Error al cargar el archivo: ' . $_FILES['curriculum']['error'] . '<br>';
			}

		// Crear la carpeta con el id del empleado
			$empleadoId = $_POST['empleado'];
			$carpetaEmpleado = "view/pdfs/" . $empleadoId;
			if (!file_exists($carpetaEmpleado)) {
				mkdir($carpetaEmpleado);
			}

		// Array con los nombres de los campos
			$campos = array("curriculum", "acta-nacimiento", "comprobante-domicilio", "identificacion-anverso", "identificacion-reverso", "rfc", "curp", "nss", "comprobante-estudios", "recomendacion-laboral", "recomendacion-personal");

		// Array para almacenar los nombres de los archivos subidos
			$pdfNames = array();

		// Recorremos los campos y subimos cada archivo
			foreach ($campos as $campo) {
				if (isset($_FILES[$campo]) && $_FILES[$campo]["error"] == 0) {
		// Obtener los datos del archivo
					$pdf = $_FILES[$campo];
					$pdfName = $campo;

		// Obtener la extensión del archivo
					$extension = pathinfo($pdf["name"], PATHINFO_EXTENSION);

		// Renombrar el archivo con el nombre del campo, más la extensión
					$pdfFileName = $pdfName . "." . $extension;

		// Guardar el archivo en la carpeta del empleado
					$uploadPath = $carpetaEmpleado . "/" . $pdfFileName;
					move_uploaded_file($pdf["tmp_name"], $uploadPath);

		// Guardar el nombre del archivo en el array
					array_push($pdfNames, $pdfFileName);
				}
			}

		// Guardar los datos en la base de datos
			$datos = array("curriculum" => "curriculum",
				"acta_nacimiento" => "acta_nacimiento",
				"comprobante_domicilio" => "comprobante_domicilio",
				"identificacion_anverso" => "identificacion_anverso",
				"identificacion_reverso" => "identificacion_reverso",
				"rfc" => "rfc",
				"curp" => "curp",
				"nss" => "nss",
				"comprobante_estudios" => "comprobante_estudios",
				"recomendacion_laboral" => "recomendacion_laboral",
				"recomendacion_personal" => "recomendacion_personal",
				"idEmpleado" => $_POST['empleado']
			);
			$tabla = "documento";

			$respuesta = ModeloFormularios::mdlRegistroPDFEmpleado($tabla, $datos);

			if ($respuesta=='ok') {
				return 'ok';
			}else{
				return 'error';
			}
		}

	}

	static public function ctrVerDocumentos($item, $valor){

		$tabla = "documento";

		$respuesta = ModeloFormularios::mdlVerDocumentos($tabla, $item, $valor);

		return $respuesta;

	}


	/*---------- Fin de ControladorFormularios ---------- */
}