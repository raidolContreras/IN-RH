<?php

function generarPassword() {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $password = '';

    for ($i = 0; $i < 8; $i++) {
        $indice = rand(0, strlen($caracteres) - 1);
        $password .= $caracteres[$indice];
    }

    return $password;
}

class ControladorFormularios{

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
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"])) {

				$datos = array("name" => $_POST["name"],
						"idEmpleado" => $_POST["jefe"],
						"idEmpresa" => $_POST["empresa"],
						"Pertenencia" => $_POST["Pertenencia"]
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
	static public function ctrVerDepartamentos($item, $valor){

		$tabla = "departamentos";

		$respuesta = ModeloFormularios::mdlVerDepartamentos($tabla, $item, $valor);

		return $respuesta;

	}
	static public function ctrVerPertenenciasDepartamentos($item, $valor){

		$tabla = "departamentos";

		$respuesta = ModeloFormularios::mdlVerPertenenciasDepartamentos($tabla, $item, $valor);

		return $respuesta;

	}
	static public function ctrDeptosEspecial($item, $valor){

		$tabla = "departamentos";

		$respuesta = ModeloFormularios::mdlDeptosEspecial($tabla, $item, $valor);

		return $respuesta;

	}
	static public function ctrDeptosEspecial2($item, $valor){

		$tabla = "departamentos";

		$respuesta = ModeloFormularios::mdlDeptosEspecial2($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrActualizarDepto(){

		if (isset($_POST['name'])) {
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"])) {

				$datos = array("name" => $_POST["name"],
						"idEmpleado" => $_POST["jefe"],
						"idEmpresa" => $_POST["empresa"],
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

	static public function ctrEliminarNoticia(){
		if (isset($_POST['idNoticia'])) {
			$respuesta = ModeloFormularios::mdlEliminarNoticia('noticias', $_POST['idNoticia']);
			if ($respuesta == "ok") {
				return $respuesta;
			}else{
				return "error";
			}
		}
	}

	static public function ctrRegistrarPuestos(){

		if (isset($_POST['name'])) {
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"])){
				$tabla = "puesto";
				$datos = array("namePuesto" => $_POST['name'],
							   "salario" => $_POST['salario'],
							   "salario_integrado" => $_POST['salario_integrado'],
							   "Empleados_idEmpleados" => $_POST['empleado'],
							   "Departamentos_idDepartamentos" => $_POST['departamento']);
				$registro = ModeloFormularios::mdlRegistrarPuestos($tabla,$datos);
				if ($registro == 'ok') {
					return 'ok';
				}else{
					return 'Error';
				}

			}else{
				return "2";
			}
		}
	}
	
	static public function ctrRegistrarVacantes(){

		if (isset($_POST['name'])) {
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"])){
				$tabla = "vacantes";
				$datos = array("nameVacante" => $_POST['name'],
							   "salarioVacante" => $_POST['salario'],
							   "Departamentos_idDepartamentos" => $_POST['departamento'],
							   "requisitos" => $_POST['requisitos']);
				$registro = ModeloFormularios::mdlRegistrarVacantes($tabla,$datos);
				if ($registro == 'ok') {
					return 'ok';
				}else{
					return 'Error';
				}

			}else{
				return "2";
			}
		}
	}
	
	static public function ctrActualizarVacantes($idVacante){

		if (isset($_POST['name'])) {
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"])){
				$tabla = "vacantes";
				$datos = array("nameVacante" => $_POST['name'],
							   "salarioVacante" => $_POST['salario'],
							   "Departamentos_idDepartamentos" => $_POST['departamento'],
							   "requisitos" => $_POST['requisitos'],
							   "idVacante" => $idVacante);
				$registro = ModeloFormularios::mdlActualizarVacantes($tabla,$datos);
				if ($registro == 'ok') {
					return 'ok';
				}else{
					return 'Error';
				}

			}else{
				return "2";
			}
		}
	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function ctrVerPuestos($item, $valor){

		$tabla = "puesto";

		$respuesta = ModeloFormularios::mdlVerTabla($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrVerVacantes($item, $valor){

		$tabla = "vacantes";

		$respuesta = ModeloFormularios::mdlVerTabla($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrEliminarVacante(){

		if (isset($_POST['vacante'])) {
			$tabla = "vacantes";
			$idVacantes = $_POST['vacante'];
			$respuesta = ModeloFormularios::mdlEliminarVacante($tabla, $idVacantes);

			return $respuesta;
		}
	}

	static public function ctrVerPostulantes($item, $valor){

		$tabla = "postulantes";

		$respuesta = ModeloFormularios::mdlVerPostulantes($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrSumaPostulantes($item, $valor){

		$tabla = "suma";

		$respuesta = ModeloFormularios::mdlVerPostulantes($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrRegistrarPostulante(){
		$patron = "/^(\+52)?(044|045)?([0-9]{10})$/";
		if (isset($_POST['nombre'])) {
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidos"])) {
				if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					if (preg_match($patron, $_POST['telefono'])) {
						$tabla = "postulantes";
						$datos = array("namePostulante" => $_POST["nombre"],
									 "lastnamePostulante" => $_POST["apellidos"],
									 "phonePostulante" => $_POST["telefono"],
									 "emailPostulante" => $_POST["email"],
									 "Vacantes_idVacantes" => $_POST["Oferta"],
									 "nameDocPost" => $_POST["archivo"],
									 "File" => $_FILES['file']);
						$registro = ModeloFormularios::mdlRegistroPostulante($tabla, $datos);
						if ($registro != "error") {
						 		$ctrSubirPDF = ControladorFormularios::ctrSubirPDFPostulante($registro,$datos);
						 		if ($ctrSubirPDF == "ok") {
						 			return $ctrSubirPDF;
						 		}else{
						 			return "Error: 5";
						 		}
						 }else{
						 	return "Error: 4";
						 } 
					}else{
						return "Error: 3";
					}
				}else{
					return "Error: 2";
				}
			}else{
				return "Error: 1";
			}
		}
	}

	/*---------- Función hecha para subir pdf---------- */
	static public function ctrSubirPDFPostulante($idPostulante, $datos){
		if (isset($datos['nameDocPost'])) {
			if ($datos['File']['error'] > 0) {
			  echo 'Error al cargar el archivo: ' . $datos['File']['error'] . '<br>';
			}else{

				// Crear la carpeta con el id del empleado
				$postulante = $idPostulante;
				$carpetaEmpleado = "view/pdfs/postulantes/" . $postulante;
				if (!file_exists($carpetaEmpleado)) {
					mkdir($carpetaEmpleado);
				}

				if (isset($datos['File']) && $datos['File']["error"] == 0) {
					// Obtener los datos del archivo
					$pdf = $datos['File'];
					$pdfName = $datos['nameDocPost'];

					// Obtener la extensión del archivo
					$extension = pathinfo($pdf["name"], PATHINFO_EXTENSION);

					// Renombrar el archivo con el nombre del campo, más la extensión
					$pdfFileName = $pdfName . "." . $extension;

					// Guardar el archivo en la carpeta del empleado
					$uploadPath = $carpetaEmpleado . "/" . $pdfFileName;
					move_uploaded_file($pdf["tmp_name"], $uploadPath);
				}
				$tabla = "documento_postulante";
				$data = array("nameDocPost" => $datos['nameDocPost'],
											"Postulantes_idPostulantes" => $idPostulante);
				$respuesta = ModeloFormularios::mdlRegistroPDFPostulante($tabla, $data); 
				if ($respuesta=='ok') {
					return 'ok';
				}else{
					return 'error';
				}
			}
		}
	}

	static public function generarCalendario(){
		$calendary = "
		";
				// Obtener el día actual
				$hoy = getdate();
				$dia_actual = $hoy['mday'];
				$mes_actual = $hoy['mon'];
				$anio_actual = $hoy['year'];
				
				// Generar los días del mes
				$dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $anio_actual);
				$primer_dia = mktime(0, 0, 0, $mes_actual, 1, $anio_actual);
				$dia_semana = date('N', $primer_dia);
				$contador = 0;
				
				for ($fila = 1; $fila <= 6; $fila++) {
					$calendary .= '<tr>';
					for ($columna = 1; $columna <= 7; $columna++) {
						if ($contador < $dia_semana || $contador >= $dias_mes + $dia_semana) {
							$calendary .= '<td></td>';
						} else {
							$dia = $contador - $dia_semana + 1;
							if ($dia == $dia_actual) {
								$calendary .= '<td style="background-color: yellow;">' . $dia . '</td>';
							} else {
								$calendary .= '<td>' . $dia . '</td>';
							}
						}
						$contador++;
					}
					$calendary .= '</tr>';
				}
				$calendary .= "
			</tbody>
		</table>";
		return $calendary;
	}

	static public function ctrAgendarCitas($idPostulante, $fechaReunion){
		$tabla = "reuniones";
		$datos = array("fechaReunion" => $fechaReunion,
					   "Postulantes_idPostulantes" => $idPostulante);
		$agendar = ModeloFormularios::mdlAgendarCitas($tabla, $datos);
		if ($agendar == "ok") {
			return "ok";

		}else{
			return "Error";
		}
	}

	static public function ctrVerReuniones($item, $valor){

		$tabla = "reuniones";

		$respuesta = ModeloFormularios::mdlVerReuniones($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrContarReuniones($item, $valor){

		$tabla = "reuniones";

		$respuesta = ModeloFormularios::mdlContarReuniones($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrCalificarReunion($tabla, $datos){

		$respuesta = ModeloFormularios::mdlCalificarReunion($tabla, $datos);
		return $respuesta;
	}

	static public function ctrEliminarPostulante($item, $valor){
		$tabla = "postulantes";
		$respuesta = ModeloFormularios::mdlEliminarPostulante($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrLogin(){

		if (isset($_POST['loginEmail'])) {
			$loginEmail = $_POST['loginEmail'];
			$loginPass = $_POST['loginPass'];
			$tabla = "empleados";
			$item = "email";
			$valor = $loginEmail;

			$respuesta = ModeloFormularios::mdlVerEmpleados($tabla, $item, $valor);

			$encriptarPassword = crypt($loginPass, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			if($respuesta["email"] == $loginEmail && $respuesta["password"] == $encriptarPassword){

				if ($respuesta["status"] == 1) {
					$_SESSION["validarIngreso"] = "ok";
					$_SESSION["idEmpleado"] = $respuesta["idEmpleados"];
					$_SESSION["genero"] = $respuesta["genero"];
					$_SESSION["name"] = $respuesta["name"];
					$_SESSION["lastname"] = $respuesta["lastname"];
					$_SESSION["status"] = $respuesta["status"];
					$_SESSION["loginEmail"] = $respuesta["email"];
					$_SESSION["cambio_password"] = $respuesta["cambio_password"];

					if ($respuesta['cambio_password'] == 0) {
						return 'Cambio';
					}else{
						return 'ok';
					}

				}else{
					return 'Error: status';
				}

			}else{
			
				return 'Error: datos';
			}
		}

	}

	static public function ctrEmpleadoMes($empleadoMes, $mensaje, $publicado){

		$tabla = 'empleado_mes';

		$datos = array("Empleados_idEmpleados" => $empleadoMes,
						"mensaje" => $mensaje,
						"Publicado_idEmpleados" => $publicado);

		$registrar = ModeloFormularios::mdlEmpleadoMes($tabla,$datos);

		if ($registrar == 'ok') {
			return $registrar;
		}else{
			return 'Error';
		}
	}

	static public function ctrSeleccionarEmpleadoMes(){
		$tabla = 'empleado_mes';
		$buscar = ModeloFormularios::mdlSeleccionarEmpleadoMes($tabla);
		return $buscar;
	}

	static public function ctrCrearNoticia(){
		if (isset($_POST['fecha_fin'])) {
			$tabla = 'noticias';
			$datos = array("fecha_fin" => $_POST['fecha_fin'],
						   "mensaje" => $_POST['mensaje_noticia'],
						   "Empleados_idEmpleados" => $_POST['publicado'],
						   "foto_noticia" => $_POST['foto_noticia']);
			$noticia = ModeloFormularios::mdlCrearNoticia($tabla,$datos);

			if ($_POST['foto_noticia'] == 1 && $noticia > 0) {

				if (isset($_FILES["image_upload"]) && $_FILES["image_upload"]["error"] == 0) {

					// Obtener los datos del archivo
					$imagen = $_FILES["image_upload"];
					$imageName = $noticia;

					// Obtener la extensión del archivo
					$extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);

					// Renombrar la imagen con el nombre y apellidos proporcionados, más la extensión
					$imageFileName = $imageName . "." . $extension;

					// Guardar la imagen original en el servidor
					$uploadPath = "view/noticias/" . $imageFileName;
					move_uploaded_file($imagen["tmp_name"], $uploadPath);

					// Obtener la ruta para la imagen en miniatura
					$thumbnailPath = "view/noticias/thumbnails/" . $imageFileName;

					// Cargar la imagen original
					$originalImage = imagecreatefromstring(file_get_contents($uploadPath));

					// Obtener las dimensiones originales de la imagen
					$originalWidth = imagesx($originalImage);
					$originalHeight = imagesy($originalImage);

					// Calcular las nuevas dimensiones para la imagen en miniatura
					$maxSize = 350;
					$scale = min($maxSize / $originalWidth, $maxSize / $originalHeight);
					$newWidth = round($scale * $originalWidth);
					$newHeight = round($scale * $originalHeight);

					// Crear la imagen en miniatura
					$thumbnailImage = imagecreatetruecolor($newWidth, $newHeight);
					imagecopyresampled($thumbnailImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

					// Guardar la imagen en miniatura en el servidor
					imagepng($thumbnailImage, $thumbnailPath);

					$imagen = ModeloFormularios::mdlImagenNoticia($noticia,$imageFileName);
					return $imagen;

				}
			}elseif($noticia > 0){
				return 'ok';
			}else{
				return 'Error';
			}
		}
	}

	static public function ctrActualizarNoticia()
{
	if (isset($_POST['fecha_fin'])) {
		$tabla = 'noticias';
		$datos = array(
			"fecha_fin" => $_POST['fecha_fin'],
			"mensaje" => $_POST['mensaje_noticia'],
			"Empleados_idEmpleados" => $_POST['publicado'],
			"foto_noticia" => $_POST['foto_noticia'],
			"idNoticias" => $_POST['noticia']
		);
		$noticia = ModeloFormularios::mdlActualizarNoticia($tabla, $datos);

		if ($_POST['foto_noticia'] == 1) {
			if (isset($_FILES["image_upload"]) && $_FILES["image_upload"]["error"] == 0) {
				// Obtener los datos del archivo
				$imagen = $_FILES["image_upload"];
				$imageName = $_POST['noticia'];

				// Obtener la extensión del archivo
				$extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);

				// Renombrar la imagen con el nombre y apellidos proporcionados, más la extensión
				$imageFileName = $imageName . "." . $extension;

				// Guardar la imagen original en el servidor
				$uploadPath = "view/noticias/" . $imageFileName;
				if (move_uploaded_file($imagen["tmp_name"], $uploadPath)) {
					// Obtener la ruta para la imagen en miniatura
					$thumbnailPath = "view/noticias/thumbnails/" . $imageFileName;

					// Cargar la imagen original
					$originalImage = imagecreatefromstring(file_get_contents($uploadPath));

					// Obtener las dimensiones originales de la imagen
					$originalWidth = imagesx($originalImage);
					$originalHeight = imagesy($originalImage);

					// Calcular las nuevas dimensiones para la imagen en miniatura
					$maxSize = 350;
					$scale = min($maxSize / $originalWidth, $maxSize / $originalHeight);
					$newWidth = round($scale * $originalWidth);
					$newHeight = round($scale * $originalHeight);

					// Crear la imagen en miniatura
					$thumbnailImage = imagecreatetruecolor($newWidth, $newHeight);
					imagecopyresampled($thumbnailImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

					// Guardar la imagen en miniatura en el servidor
					imagepng($thumbnailImage, $thumbnailPath);

					$imagen = ModeloFormularios::mdlImagenNoticia($_POST['noticia'], $imageFileName);
					return $imagen;
				} else {
					return 'Error al mover la imagen';
				}
			}else{
				return 'ok';
			}
		} elseif ($noticia > 0) {
			return 'ok';
		} else {
			return 'Error';
		}
	}
}

	static public function ctrVerNoticias($item, $valor){
		$tabla = 'noticias';
		$respuesta = ModeloFormularios::mdlVerNoticias($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrRegistrarEmpresas($tabla, $datos){
		$respuesta = ModeloFormularios::mdlRegistrarEmpresas($tabla, $datos);
		return $respuesta;
	}

	static public function ctrActualizarEmpresas($tabla, $datos){
		$respuesta = ModeloFormularios::mdlActualizarEmpresas($tabla, $datos);
		return $respuesta;
	}

	static public function ctrVerEmpresas($item,$valor){
		$tabla = 'empresas';
		$buscar = ModeloFormularios::mdlVerEmpresas($tabla,$item,$valor);
		return $buscar;
	}

	static public function generarArchivoCSV($empresaId,$nameEmpresa)
    {
        $datosEmpresa = ModeloFormularios::obtenerDatosEmpresa($empresaId);

        if (!empty($datosEmpresa)) {
            $directorio = "assets/organigrama/".$nameEmpresa;
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }

            $archivo = fopen($directorio . "/org.csv", "w");

            $encabezado = array("id", "name", "area", "profileUrl", "imageUrl", "positionName", "parentId");
            fputcsv($archivo, $encabezado);

            foreach ($datosEmpresa as $fila) {
			    $parentId = ($fila["parentId"] == 0 ? '' : $fila["parentId"]);

			    $datos = array(
			        $fila["id"],
			        $fila["name"],
			        $fila["area"],
			        $fila["profileUrl"],
			        $fila["imageUrl"],
			        $fila["positionName"],
			        $parentId
			    );

			    // Eliminar las comillas de cada valor
			    $datosSinComillas = array_map(function ($valor) {
			        return str_replace('"', '', $valor);
			    }, $datos);

			    fputcsv($archivo, $datosSinComillas);
			}


            fclose($archivo);

            return "ok";
        } else {
            return "Error";
        }
    }

    static public function ctrEmpleadosEspecial($item,$valor){
    	$tabla = "empleados";
    	$respuesta = ModeloFormularios::mdlEmpleadosEspecial($tabla,$item,$valor);
    	return $respuesta;
    }

    static public function ctrForgotPasswordEmail($datos){

    	$busqueda = ControladorEmpleados::ctrCambioPasswordOlvidado("Empleados_idEmpleados", $datos['idEmpleados']);
    	if (isset($busqueda[0]) && $busqueda[0] == $datos['idEmpleados']) {
    		return 'existente';
    	}else{
	    	$respuesta = ModeloFormularios::mdlForgotPasswordEmail($datos);
	    	return $respuesta;
    	}
    }

    static public function ctrGuardarHorario($nameHorario, $horarios){
    	$tabla = "horarios";
    	$registrarNombreHorario = ModeloFormularios::mdlGuardarHorario($tabla,$nameHorario,$horarios);
    	return $registrarNombreHorario;
    }

    static public function ctrSeleccionarHorarios($item,$valor){
    	$tabla = "horarios";
    	if ($item == "Horarios_idHorarios") {
    		$tabla = "dia_horario";
    	}
    	$horarios = ModeloFormularios::mdlSeleccionarHorarios($tabla,$item,$valor);
    	return $horarios;
    }

    static public function ctrCambiarHorarioDefault($idHorarios){
    	$tabla = "horarios";
    	$cambio = ModeloFormularios::mdlCambiarHorarioDefault($tabla,$idHorarios);
    	return $cambio;
    }

    static public function ctrVerEmpleadosHorarios($item,$valor){
    	$tabla = "empleados_has_horarios";
    	$empleadosHorarios = ModeloFormularios::mdlVerEmpleadosHorarios($tabla,$item,$valor);
    	return $empleadosHorarios;
    }

    static public function ctrEmpleadosHasHorarios($empleados,$idHorario){

    	$tabla = "empleados_has_horarios";

    	$validar = "cambio";

    	foreach ($empleados as $empleado) {

    		if ($validar == "cambio") {

				$registrarEmpleadosHorario = ModeloFormularios::mdlregistrarEmpleadosHorario($tabla,$empleado,$idHorario);
				$validar = $registrarEmpleadosHorario;

    		}
    	}
    	return $validar;

    }

    static public function ctrActualizarHorario($datos){
    	$tabla = "horarios";
    	$actualizarNombreHorario = ModeloFormularios::mdlActualizarNombreHorario($tabla, $datos);
    	if ($actualizarNombreHorario == 'ok') {
    		$tabla = "dia_horario";
    		$actualizarDiasLaborables = ModeloFormularios::mdlActualizarDiasLaborables($tabla, $datos);
    		return $actualizarDiasLaborables;
    	}else{
    		return 'error';
    	}
    }

    static public function ctrRegistrarDiaFestivo($datos){
    	$tabla = "festivos";
    	$registrar_dia_festivo = ModeloFormularios::mdlRegistrarDiaFestivo($tabla, $datos);
    	return $registrar_dia_festivo;
    }

    static public function ctrRegistrarPermisos($datos){
    	$tabla = "permisos";
    	$registrar_Permiso = ModeloFormularios::mdlRegistrarPermisos($tabla, $datos);
    	return $registrar_Permiso;
    }

    static public function ctrVerPermisos($item,$valor){
    	$tabla = "permisos";
    	$ver_Permiso = ModeloFormularios::mdlVerPermisos($tabla,$item,$valor);
    	return $ver_Permiso;
    }

    static public function ctrCrearJustificante($datos){
    	$tabla = "justificantes";
    	$registrar = ModeloFormularios::mdlCrearJustificante($tabla,$datos);
    	return $registrar;
    }

    static public function ctrVerAsistencia($item,$valor){
    	$tabla = "asistencias";
    	$asistencia = ModeloFormularios::mdlVerAsistencia($tabla,$item,$valor);
    	return $asistencia;
    }

    static public function ctrVerPeticiones($idEmpleados){
    	$tabla = "justificantes";
    	$buscarDepartamento = ControladorFormularios::ctrVerDepartamentos("Empleados_idEmpleados", $idEmpleados);
    	$verPeticiones = ModeloFormularios::mdlVerPeticiones($tabla, "p.Departamentos_idDepartamentos", $buscarDepartamento['idDepartamentos']);
    	return $verPeticiones;
    }

	/*---------- Fin de ControladorFormularios ---------- */
}