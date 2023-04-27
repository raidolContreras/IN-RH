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
		if (isset($_POST['archivo'])) {
			if ($_FILES['file']['error'] > 0) {
			  echo 'Error al cargar el archivo: ' . $_FILES['file']['error'] . '<br>';
			}else{

				// Crear la carpeta con el id del empleado
				$empleadoId = $_POST['empleado'];
				$carpetaEmpleado = "view/pdfs/" . $empleadoId;
				if (!file_exists($carpetaEmpleado)) {
					mkdir($carpetaEmpleado);
				}

				if (isset($_FILES['file']) && $_FILES['file']["error"] == 0) {
					// Obtener los datos del archivo
					$pdf = $_FILES['file'];
					$pdfName = $_POST['archivo'];

					// Obtener la extensión del archivo
					$extension = pathinfo($pdf["name"], PATHINFO_EXTENSION);

					// Renombrar el archivo con el nombre del campo, más la extensión
					$pdfFileName = $pdfName . "." . $extension;

					// Guardar el archivo en la carpeta del empleado
					$uploadPath = $carpetaEmpleado . "/" . $pdfFileName;
					move_uploaded_file($pdf["tmp_name"], $uploadPath);
				}

				// Guardar los datos en la base de datos
				$datos = array("fileName" => $_POST['archivo'],
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


	}

	static public function ctrVerDocumentos($item, $valor){

		$tabla = "documento";

		$respuesta = ModeloFormularios::mdlVerDocumentos($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrVerDocumento($item, $valor){

		$tabla = "documento";

		$respuesta = ModeloFormularios::mdlVerDocumento($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrImprimirDivs($validar,$nameDoc,$id,$nombreDocumento){
		$respuesta = ModeloFormularios::mdlImprimirDivs($validar,$nameDoc,$id,$nombreDocumento);
		return $respuesta;
	}

	static public function ctrRegistrarDeptos(){
		if (isset($_POST['name'])) {
			$description = "";
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"])) {
				if (isset($_POST['description']) && preg_match('/^[0-9a-zA-Z ]+$/', $_POST["description"])) {
					$description = $_POST["description"];
				}

				$datos = array("name" => $_POST["name"],
						"description" => $description,
						"idEmpleado" => $_POST["jefe"]
											);
				$tabla = "departamentos";
				$respuesta = ModeloFormularios::mdlRegistrarDeptos($tabla, $datos);

				if ($respuesta == "ok") {
					return $respuesta;
				}else{
					return "error";
				}
			}

		}

	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function ctrVerEmpleadosDisponibles(){

		$tabla = "empleados";

		$respuesta = ModeloFormularios::mdlVerEmpleadosDisponibles($tabla);

		return $respuesta;

	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function ctrVerDepartamentos($item, $valor){

		$tabla = "departamentos";

		$respuesta = ModeloFormularios::mdlVerDepartamentos($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrActualizarDepto(){

		if (isset($_POST['name'])) {
			$description = "";
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"])) {
				if (isset($_POST['description']) && preg_match('/^[0-9a-zA-Z ]+$/', $_POST["description"])) {
					$description = $_POST["description"];
				}

				$datos = array("name" => $_POST["name"],
						"description" => $description,
						"idEmpleado" => $_POST["jefe"],
						"idDepto" => $_POST["idDepto"]
											);
				$tabla = "departamentos";
				$respuesta = ModeloFormularios::mdlActualizarDepto($tabla, $datos);

				if ($respuesta == "ok") {
					return $respuesta;
				}else{
					return "error";
				}
			}

		}

	}

	static public function ctrEliminarDepto(){
		if (isset($_POST['idDepto'])) {
			$respuesta = ModeloFormularios::mdlEliminarDepto('departamentos', $_POST['idDepto']);
			if ($respuesta == "ok") {
				return $respuesta;
			}else{
				return "error";
			}
		}
	}

	/*---------- Fin de ControladorFormularios ---------- */
}