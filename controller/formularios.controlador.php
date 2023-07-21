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

	/*---------- Esta función envia los datos para crear el formato del numero teléfonico ---------- */
	static public function ctrNumeroTelefonico($phone){
		$numero = ModeloFormularios::mdlNumeroTelefonico($phone);
		return $numero;
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
	
	static public function ctrRegistrarVacantes($datos){
		$tabla = "vacantes";
		$registro = ModeloFormularios::mdlRegistrarVacantes($tabla,$datos);	
		return $registro;
	}
	
	static public function ctrActivarVacante($datos){
		$tabla = "vacantes";
		$registro = ModeloFormularios::mdlActivarVacante($tabla,$datos);	
		return $registro;
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
					$nivel = 0;
					$_SESSION["validarIngreso"] = "ok";
					$_SESSION["idEmpleado"] = $respuesta["idEmpleados"];
					$_SESSION["genero"] = $respuesta["genero"];
					$_SESSION["name"] = $respuesta["name"];
					$_SESSION["lastname"] = $respuesta["lastname"];
					$_SESSION["status"] = $respuesta["status"];
					$_SESSION["loginEmail"] = $respuesta["email"];
					$_SESSION["cambio_password"] = $respuesta["cambio_password"];
					$_SESSION["idPuesto"] = $respuesta["idPuesto"];
					$_SESSION["idDepartamentos"] = $respuesta["idDepartamentos"];
					$_SESSION["idEmpresas"] = $respuesta["idEmpresas"];
					$_SESSION["Pertenencia"] = $respuesta["Pertenencia"];

					if ($respuesta["idEmpleadoDepa"] == $respuesta["idEmpleados"]) {
						$nivel = 1;
					}
					
					$_SESSION["nivel"] = $nivel;

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

	static public function ctrEmpleadosHasExamenes($empleados,$idExamen){

		$validar = "ok";

		foreach ($empleados as $empleado) {

			if ($validar == "ok") {

				$registrarEmpleadosHorario = ModeloFormularios::mdlregistrarEmpleadosExamenes($empleado,$idExamen);
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

	static public function ctrVerPeticionesDepartamentales($idEmpleados){
		$tabla = "justificantes";
		$buscarDepartamento = ControladorFormularios::ctrVerDepartamentos("Empleados_idEmpleados", $idEmpleados);
		$verPeticiones = ModeloFormularios::mdlVerPeticionesDepartamentales($tabla, "d.Pertenencia", $buscarDepartamento['idDepartamentos']);
		return $verPeticiones;
	}

	static public function ctrAprobarJustificante($idJustificantes){
		$tabla = "justificantes";
		$datos = array(
			"idJustificantes" => $idJustificantes,
			"valor" => 1
		);
		$justificar = ModeloFormularios::mdlJustificarAsistencia($tabla,$datos);
		return $justificar;
	}

	static public function ctrDeclinarJustificante($idJustificantes){
		$tabla = "justificantes";
		$datos = array(
			"idJustificantes" => $idJustificantes,
			"valor" => 2
		);
		$justificar = ModeloFormularios::mdlJustificarAsistencia($tabla,$datos);
		return $justificar;
	}

	static public function ctrAprobarVacaciones($idVacaciones){
		$tabla = "vacaciones";
		$datos = array(
			"idVacaciones" => $idVacaciones,
			"valor" => 1
		);
		$justificar = ModeloFormularios::mdlResponderVacaciones($tabla,$datos);
		return $justificar;
	}

	static public function ctrDeclinarVacaciones($idVacaciones){
		$tabla = "vacaciones";
		$datos = array(
			"idVacaciones" => $idVacaciones,
			"valor" => 2
		);
		$justificar = ModeloFormularios::mdlResponderVacaciones($tabla,$datos);
		return $justificar;
	}

	static public function ctrResponderPermisos($datos){
		$tabla = "empleados_has_permisos";
		$permiso = ModeloFormularios::mdlResponderPermisos($tabla,$datos);
		return $permiso;
	}

	static public function ctrTotalHoras($empleado){

		$nombre = ucwords(mb_strtolower($empleado['lastname']." ".$empleado['name'])); 
		
		$asistencias = ControladorEmpleados::ctrAsistenciasJustificantes($empleado['idEmpleados']);
		$horarios = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("Empleados_idEmpleados", $empleado['idEmpleados']);
		$default = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("h.default", 1);

		$numeroDias = date('t');
// Obtener el número del día actual
		$diaActual = date('j');
// Obtener el mes actual
		$mesActual = date('m');
// Obtener el año actual
		$añoActual = date('Y');
		$datos_asistencia = array();
		$dia_semana = array();
		$horas_totales = 0;
		$horasRegistradas = 0;
		$horasEsperadas = 0;

		foreach ($asistencias as $asistencia) {
			$horaEntrada = $asistencia['entrada'];
			$horaSalida = $asistencia['salida'];
			$dEntrada = $asistencia['entrada_descanso'];
			$dSalida = $asistencia['salida_descanso'];

			$entrada = DateTime::createFromFormat('H:i:s', $horaEntrada);
			$salida = DateTime::createFromFormat('H:i:s', $horaSalida);
			$entrada_descanso = DateTime::createFromFormat('H:i:s', $dEntrada);
			$salida_descanso = DateTime::createFromFormat('H:i:s', $dSalida);

			$intervalo = $entrada->diff($salida);
			$intervalo_descanso = $entrada_descanso->diff($salida_descanso);

			$horasDecimales = $intervalo->h + ($intervalo->i / 60);
			$horasDecimales_descanso = $intervalo_descanso->h + ($intervalo_descanso->i / 60);

			$horas_diarias_totales = $horasDecimales - $horasDecimales_descanso;
			$horas_totales += $horas_diarias_totales;

			$datos_asistencia[] = [
				"fecha_asistencia" => $asistencia['fecha_asistencia'],
				"horas_diarias_totales" => $horas_diarias_totales
			];

		}

		while ($fila = $horarios->fetch(PDO::FETCH_ASSOC)) {
			$dia_semana[] = array(
				"ndia" => $fila['dia_Laborable'],
				"hora_dia" => $fila['numero_Horas']
			);
		}

		if ($dia_semana == []) {
			while ($fila = $default->fetch(PDO::FETCH_ASSOC)) {
				$dia_semana[] = array(
					"ndia" => $fila['dia_Laborable'],
					"hora_dia" => $fila['numero_Horas']
				);
			}
		}
// Generar celdas para cada día del mes
		for ($dia = 1; $dia <= $numeroDias; $dia++) {

			$fechasInformato = date('N', strtotime(sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)));
			foreach ($datos_asistencia as $value){
				if ($value['fecha_asistencia'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {
						$horasRegistradas += $value['horas_diarias_totales'];
				}
			}

			foreach ($dia_semana as $value) {
				if ($value['ndia'] == $fechasInformato) {
					$horasEsperadas += $value['hora_dia'];
				}
			}
		}
		$datos = array(
			"nombre" => $nombre,
			"horasRegistradas" => ModeloExcel::mdlformatearHora($horasRegistradas),
			"horasEsperadas" => ModeloExcel::mdlformatearHora($horasEsperadas)
		);
		return $datos;
	}

	static public function ctrVerPermisosEmpleados($idEmpleados){
		$respuesta = ModeloFormularios::mdlVerPermisosEmpleados($idEmpleados);
		return $respuesta;
	}

	static public function ctrVerSolicutudesPermisosEmpleados($idEmpleados){
		$respuesta = ModeloFormularios::mdlVerSolicutudesPermisosEmpleados($idEmpleados);
		return $respuesta;
	}

	static public function ctrEliminarHorarios(){
		$idHorarios = $_POST['horario'];
		$respuesta = ModeloFormularios::mdlEliminarHorarios($idHorarios);
		return $respuesta;
	}

	static public function ctrCalculoVacacional($aniosLaborados) {
		if ($aniosLaborados >= 1 && $aniosLaborados <= 5) {
			$diasVacaciones = $aniosLaborados * 2 + 10;
		} elseif ($aniosLaborados >= 6 && $aniosLaborados <= 10) {
			$diasVacaciones = 22;
		} elseif ($aniosLaborados >= 11 && $aniosLaborados <= 15) {
			$diasVacaciones = 24;
		} elseif ($aniosLaborados >= 16 && $aniosLaborados <= 20) {
			$diasVacaciones = 26;
		} elseif ($aniosLaborados >= 21 && $aniosLaborados <= 25) {
			$diasVacaciones = 28;
		} elseif ($aniosLaborados >= 26 && $aniosLaborados <= 30) {
			$diasVacaciones = 30;
		} elseif ($aniosLaborados >= 31 && $aniosLaborados <= 35) {
			$diasVacaciones = 32;
		} else {
			$diasVacaciones = 0; // Si los años laborados no están en ninguna de las categorías especificadas
		}

		return $diasVacaciones;
	}

	static public function ctrGenerarPermiso($datos){
		$tabla = 'empleados_has_permisos';
		$generar = ModeloFormularios::mdlGenerarPermiso($tabla,$datos);
		return $generar;
	}

	static public function ctrGenerarVacaciones($datos){

		$empleados_has_permisos = ControladorFormularios::ctrVerPermisosEmpleados($_SESSION['idEmpleado']);
		$tiempoContratado = $empleados_has_permisos[0]['tiempoContrato'];
		$calculo_vacaciones = ControladorFormularios::ctrCalculoVacacional($tiempoContratado);
		$vacaciones = ControladorFormularios::ctrVerSolicitudesVacaciones($_SESSION['idEmpleado']);
		$dias_consumidos = 0;
		$dias_pendientes = 0;
				
		foreach ($vacaciones as $value) {
			if ($value['status_vacaciones'] == 1) {
				if ($value['respuesta'] == 1) {
					$dias_consumidos += $value['dias'];
				}
				if ($value['respuesta'] == null) {
					$dias_pendientes += $value['dias'];
				}
			}
		}
		$dias_disponibles = $calculo_vacaciones - $dias_consumidos - $dias_pendientes;

		$fechaInicio = $datos['fechaPermiso'];
		$fechaFin = $datos['fechaFin'];

		// Convierte las fechas a representación de tiempo
		$tiempoInicio = strtotime($fechaInicio);
		$tiempoFin = strtotime($fechaFin);

		// Calcula la diferencia en segundos
		$diferencia = $tiempoFin - $tiempoInicio;

		// Convierte la diferencia de segundos a días
		$numDias = floor($diferencia / (60 * 60 * 24)) + 1;

		if ($dias_disponibles >= $numDias) {
			$tabla = 'vacaciones';
			$generar = ModeloFormularios::mdlGenerarVacaciones($tabla,$datos);
			return $generar;
		}else{
			return 'dias';
		}

	}

	static public function ctrEliminarSolicitud($idSolicitud){
		$tabla = 'empleados_has_permisos';
		$eliminar = ModeloFormularios::mdlEliminarSolicitud($tabla,$idSolicitud);
		return $eliminar;
	}

	static public function ctrEliminarSolicitudVacaciones($idVacaciones){
		$tabla = 'vacaciones';
		$eliminar = ModeloFormularios::mdlEliminarSolicitudVacaciones($tabla,$idVacaciones);
		return $eliminar;
	}

	static public function ctrVerSolicitudesVacaciones($idEmpleados){
		$vacaciones = ModeloFormularios::mdlVerSolicitudesVacaciones($idEmpleados);
		return $vacaciones;
	}

	static public function ctrVerSolicitudesPermisos($idEmpleados){
		$vacaciones = ModeloFormularios::mdlVerSolicitudesPermisos($idEmpleados);
		return $vacaciones;
	}

	static public function ctrVerTareas($item, $valor){
		$tareas = ModeloFormularios::mdlVerTareas($item, $valor);
		return $tareas;
	}

	static public function ctrAsignarTarea($datos){
		if ($datos['nameTarea'] != '' && $datos['descripcion'] != '' && $datos['Empleados_idEmpleados'] != '' && $datos['vencimiento'] != '') {
			$asignarTarea = ModeloFormularios::mdlAsignarTarea($datos);
		}else{
			$asignarTarea = 'campos vacios';
		}
		return $asignarTarea;
	}

	static public function ctrEntregarTarea($datos){
		if ($datos['idTarea'] != '' && $datos['descripcionEntrega'] != '' && $datos['Empleados_idEmpleados'] != '') {
			$asignarTarea = ModeloFormularios::mdlEntregarTarea($datos);
		}else{
			$asignarTarea = 'campos vacios';
		}
		return $asignarTarea;
	}

	static public function ctrVerDocumentosTareas($idTareas){
		$documentosTareas = ModeloFormularios::mdlVerDocumentosTareas($idTareas);
		return $documentosTareas;
	}

	static public function ctrVerDocumentosEntregas($idTareas){
		$documentosTareas = ModeloFormularios::mdlVerDocumentosEntregas($idTareas);
		return $documentosTareas;
	}

	static public function ctrRegistrarDocumentosTareas($data){
		$registrarDocumentosTareas = ModeloFormularios::mdlRegistrarDocumentosTareas($data);
		return $registrarDocumentosTareas;
	}

	static public function ctrRegistrarDocumentosEntrega($data){
		$registrarDocumentosEntrega = ModeloFormularios::mdlRegistrarDocumentosEntrega($data);
		return $registrarDocumentosEntrega;
	}

	static public function ctrFinalizarTarea($data){
		$finalizarTarea = ModeloFormularios::mdlFinalizarTarea($data);
		return $finalizarTarea;
	}

	static public function ctrCrearExamen($data){

		if ($data['idExamen'] == 0) {
			$respuesta = ModeloFormularios::mdlCrearExamen($data);
		}else{
			$respuesta = ModeloFormularios::mdlActualizarExamenes($data);
		}
		return $respuesta;
	}

	static public function ctrVerEvaluaciones($item, $dato){
		$verExamen = ModeloFormularios::mdlVerEvaluaciones($item, $dato);
		return $verExamen;
	}

	static public function ctrBorrarExamen($idExamen){
		$borrarExamen = ModeloFormularios::mdlBorrarExamen($idExamen);
		return $borrarExamen;
	}

	static public function ctrBorrarPregunta($idPregunta){
		$borrarPregunta = ModeloFormularios::mdlBorrarPregunta($idPregunta);
		return $borrarPregunta;
	}

	static public function ctrCrearPregunta($datos){
		$crearPregunta = ModeloFormularios::mdlCrearPregunta($datos);
		if ($datos['tipo_pregunta'] != 'opcion_multiple' && $datos['tipo_pregunta'] != 'escala') {
			$data = array(
				'respuesta' => $datos['tipo_pregunta'],
				'valor' => 0,
				'idPregunta' => $crearPregunta
			);
			$registarRespuestas = ModeloFormularios::mdlRegistrarRespuestas($data);
		}
		return $crearPregunta;
	}

	static public function ctrVerPreguntas($item, $dato){
		$verPregunta = ModeloFormularios::mdlVerPreguntas($item, $dato);
		return $verPregunta;
	}

	static public function ctrVerPreguntasExamen($item, $dato){
		$verPregunta = ModeloFormularios::mdlVerPreguntasExamen($item, $dato);
		return $verPregunta;
	}

	static public function ctrVerRespuestas($item, $dato){
		$verPregunta = ModeloFormularios::mdlVerRespuestas($item, $dato);
		return $verPregunta;
	}

	static public function ctrVerRespuestasExamen($item, $dato){
		$verPregunta = ModeloFormularios::mdlVerRespuestasExamen($item, $dato);
		return $verPregunta;
	}

	static public function ctrVerEvaluacionesEmpleados($item, $dato){
		$VerEvaluacionesEmpleados = ModeloFormularios::mdlVerEvaluacionesEmpleados($item, $dato);
		return $VerEvaluacionesEmpleados;
	}

	static public function ctrRegistrarRespuestasMultiple($datos){
		$registarRespuestas = 'ok';
		$idPregunta = $datos['idPregunta'];
		foreach ($datos['respuestas'] as $respuestas) {
			if ($registarRespuestas == 'ok') {
				$data = array(
					'respuesta' => $respuestas['respuesta'],
					'valor' => $respuestas['valor'],
					'idPregunta' => $idPregunta
				);
				$registarRespuestas = ModeloFormularios::mdlRegistrarRespuestas($data);
			}
		}
		return $registarRespuestas;
	}

	static public function ctrRegistrarRespuesta($datos){
		$registarRespuestas = ModeloFormularios::mdlRegistrarRespuestas($datos);
		return $registarRespuestas;
	}

	static public function ctrTerminarExamen($datos){
		$buscarEvaluacionAsignada = ModeloFormularios::mdlBuscarEvaluacionAsignada($datos);
		if (!empty($buscarEvaluacionAsignada)) {
			$fecha_inicio = $buscarEvaluacionAsignada['fecha_inicio'];
			$idExamenEmpleados = $buscarEvaluacionAsignada['idEmpleados_has_Examenes'];
			$datosTermino = array(
				"fecha_inicio" => $fecha_inicio,
				"timeMax" => $datos['timeMax'],
				"idExamenEmpleados" => $idExamenEmpleados
			);
			$registarRespuestas = ModeloFormularios::mdlTerminarExamen($datosTermino);
				return $registarRespuestas;
		}else{
			return 'Sin datos';
		}
	}

	static public function ctrFormatearMes($fecha){

		$diaMes = date('N', strtotime($fecha));
		$numeroMes = date('m', strtotime($fecha));
		$hora = date('g:i a', strtotime($fecha));
		$year = date('Y', strtotime($fecha));

		$meses = array(
			'01' => 'enero',
			'02' => 'febrero',
			'03' => 'marzo',
			'04' => 'abril',
			'05' => 'mayo',
			'06' => 'junio',
			'07' => 'julio',
			'08' => 'agosto',
			'09' => 'septiembre',
			'10' => 'octubre',
			'11' => 'noviembre',
			'12' => 'diciembre'
		);
		$dias = array(
			1 => 'Lunes',
			2 => 'Martes',
			3 => 'Miércoles',
			4 => 'Jueves',
			5 => 'Viernes',
			6 => 'Sábado',
			7 => 'Domingo'
		);

		$mes = $meses[$numeroMes];

		$diaSemana = $dias[$diaMes];
		$formato = $diaSemana.", ".$diaMes. " de ".$mes." de ".$year.", ".$hora;

		return $formato;
	}

	static public function ctrFormatearTiempo($minutos){
		if ($minutos != null) {
			$horas = floor($minutos / 60);
			$minutosRestantes = $minutos % 60;

			$formato = "";

			if ($horas > 0) {
				$formato .= $horas . " hora";
				if ($horas > 1) {
					$formato .= "s";
				}
				$formato .= " ";
			}

			if ($minutosRestantes > 0) {
				$formato .= $minutosRestantes . " min";
			}

			return $formato;
		}else{
			return 'Sin limite de tiempo';
		}
	}

	static public function calcularCalificacion($respuestasCorrectas, $totalPreguntas) {
		// Calcular el porcentaje de respuestas correctas
		if ($totalPreguntas == 0) {
			return '';
		}else{
			$porcentajeCorrectas = ($respuestasCorrectas / $totalPreguntas) * 100;

			// Calcular la calificación en base al porcentaje de respuestas correctas
			$calificacion = ($porcentajeCorrectas / 100) * 10;

			// Formatear la calificación con dos decimales y el porcentaje
			$calificacionFormateada = '<strong>' . number_format($calificacion, 2) . '</strong> de un total de 10.00 ('
					. '<strong>' .number_format($porcentajeCorrectas, 0) . '</strong>%)';

			return $calificacionFormateada;
		}
		
	}

	static public function ctrExamenesEmpleados($idExamen){
		$examen = ModeloFormularios::mdlExamenesEmpleados($idExamen);
		return $examen;
	}

	static public function ctrExamenesPreguntas($idExamen){
		$examen = ModeloFormularios::mdlExamenesPreguntas($idExamen);
		return $examen;
	}

	/*---------- Fin de ControladorFormularios ---------- */
}