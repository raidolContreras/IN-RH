<?php
require_once "conexion.php";
class ModeloFormularios{

	/*---------- Función hecha para registrar a los empleados---------- */
	static public function mdlRegistrarEmpleados($tabla1, $table2, $datos){

		$pdo=Conexion::conectar();
		$stmt = $pdo->prepare("INSERT INTO $tabla1(name, lastname, genero, fNac, phone, email, password, identificacion, CURP, NSS, RFC, street, numE, numI, colonia, CP, municipio, estado) VALUES (:nombre, :apellidos, :genero, :fecha_nacimiento, :telefono, :email, :passwordEncriptado, :num_identificacion, :curp, :num_seguro_social, :rfc, :calle, :num_exterior, :num_interior, :colonia, :cp, :municipio, :estado)");

		$stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(':apellidos', $datos['apellidos'], PDO::PARAM_STR);
		$stmt->bindParam(':genero', $datos['genero'], PDO::PARAM_STR);
		$stmt->bindParam(':fecha_nacimiento', $datos['fecha_nacimiento'], PDO::PARAM_STR);
		$stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_INT);
		$stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
		$stmt->bindParam(':passwordEncriptado', $datos['passwordEncriptado'], PDO::PARAM_STR);
		$stmt->bindParam(':num_identificacion', $datos['num_identificacion'], PDO::PARAM_STR);
		$stmt->bindParam(':curp', $datos['curp'], PDO::PARAM_STR);
		$stmt->bindParam(':num_seguro_social', $datos['num_seguro_social'], PDO::PARAM_INT);
		$stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
		$stmt->bindParam(':calle', $datos['calle'], PDO::PARAM_STR);
		$stmt->bindParam(':num_exterior', $datos['num_exterior'], PDO::PARAM_STR);
		$stmt->bindParam(':num_interior', $datos['num_interior'], PDO::PARAM_STR);
		$stmt->bindParam(':colonia', $datos['colonia'], PDO::PARAM_STR);
		$stmt->bindParam(':cp', $datos['cp'], PDO::PARAM_INT);
		$stmt->bindParam(':municipio', $datos['municipio'], PDO::PARAM_STR);
		$stmt->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);
		$id_empleado = 0;
		if($stmt->execute()){

			$id_empleado = $pdo->lastInsertId(); //obtener el ID del empleado recién insertado
		}

		if ($id_empleado == 0) {

			echo $consulta->errorInfo()[2];
		}
		else{

			$horarioEmpleado = ModeloFormularios::mdlregistrarEmpleadosHorario('empleados_has_horarios',$id_empleado, $datos['horario']);
			
			if ($datos['postulante'] != 0) {

				$RegistroPostulante = ControladorFormularios::ctrVerPostulantes('idPostulantes', $datos['postulante']);
				$CerrarVacante = ModeloFormularios::mdlEliminarVacante('vacantes', $RegistroPostulante['Vacantes_idVacantes']);
				$vacante = ControladorFormularios::ctrVerVacantes('idVacantes', $RegistroPostulante['Vacantes_idVacantes']);

				$puesto = array("namePuesto" => $datos['namePuesto'],
								"salario" => $datos['salarioPuesto'],
								"salario_integrado" => $datos['salario_integrado'],
								"Empleados_idEmpleados" => $id_empleado,
								"Departamentos_idDepartamentos" => $vacante['Departamentos_idDepartamentos']
								);

				$registrarPuesto = ModeloFormularios::mdlRegistrarPuestos('puesto', $puesto);

				if ($registrarPuesto == 'ok') {

					echo 'Usuario registrado en el puesto';
					$carpetaEmpleado = "view/pdfs/" . $id_empleado;
					if (!file_exists($carpetaEmpleado)) {

						mkdir($carpetaEmpleado);
					}

					$currentLocation = 'view/pdfs/postulantes/'.$datos['postulante']."/curriculum.pdf";
					$newLocation = $carpetaEmpleado."/curriculum.pdf";
					$moved = rename($currentLocation, $newLocation);
					if($moved){

						echo "File moved successfully";
						$regDoc = array("fileName" => 'curriculum', "idEmpleado" => $id_empleado);
						$registroDocumento = ModeloFormularios::mdlRegistroPDFEmpleado('documento', $regDoc);
						if ($registroDocumento == 'ok') {

							echo 'Curriculum Registrado';
						}

					}

				}

			} else{
				$puesto = array("namePuesto" => $datos['namePuesto'],
								"salario" => $datos['salarioPuesto'],
								"salario_integrado" => $datos['salario_integrado'],
								"Empleados_idEmpleados" => $id_empleado,
								"Departamentos_idDepartamentos" => $datos['Departamentos_idDepartamentos']
								);

				$registrarPuesto = ModeloFormularios::mdlRegistrarPuestos('puesto', $puesto);
			}

			$Registro = ModeloFormularios::mdlEmergencia($table2, $id_empleado, $datos);
			$correo = ModeloFormularios::correoVerificacion($datos);
			if ($datos['jefe_Departamento'] == 1) {
				
				$datosDepto = array(
					"idDepartamentos" => $datos['Departamentos_idDepartamentos'],
					"idEmpleados" => $id_empleado
				);
				
				$updateDataDepto = ModeloEmpleados::mdlActualizarjefatura('departamentos', $datosDepto);
			}
			if ($correo == 'enviado') {
				return "ok";
			}
			else{
				echo 'No enviado';
				print_r(Conexion::conectar()->errorInfo());
			}

		}

		$stmt->closeCursor();
		$stmt = null;
	}

	/*---------- Función hecha para registrar a los numeros de emergencia---------- */
	static public function mdlEmergencia($table2, $id_empleado, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $table2(nameEmer, parentesco, phoneEmer, Empleados_idEmpleados) VALUES (:emergencia, :parentesco, :telefonoE, $id_empleado)");
		$stmt->bindParam(':emergencia', $datos['emergencia'], PDO::PARAM_STR);
		$stmt->bindParam(':telefonoE', $datos['telefonoE'], PDO::PARAM_INT);
		$stmt->bindParam(':parentesco', $datos['parentesco'], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarHistorial($tabla, $datos, $idEmpleado){

		if ($datos['noResponder'] == 0) {

			$salario = $datos['salario'];
		}
		else{

			$salario = null;
		}

		if ($datos['trabajo_actual'] == 0) {

			$fecha_fin = $datos['fecha_fin'];
		}
		else{

			$fecha_fin = null;
		}

		$sql = 'INSERT INTO historial_laboral(empresa, puesto, noResponder, salario, fecha_inicio, trabajo_actual, fecha_fin, motivos, logros, Empleados_idEmpleados) VALUES (:empresa, :puesto, :noResponder, :salario, :fecha_inicio, :trabajo_actual, :fecha_fin, :motivos, :logros, :Empleados_idEmpleados)';
		$pdo = Conexion::conectar();
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':empresa', $datos['empresa'], PDO::PARAM_STR);
		$stmt->bindParam(':puesto', $datos['puesto'], PDO::PARAM_STR);
		$stmt->bindParam(':noResponder', $datos['noResponder'], PDO::PARAM_STR);
		$stmt->bindParam(':salario', $salario, PDO::PARAM_STR);
		$stmt->bindParam(':fecha_inicio', $datos['fecha_inicio'], PDO::PARAM_STR);
		$stmt->bindParam(':trabajo_actual', $datos['trabajo_actual'], PDO::PARAM_STR);
		$stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
		$stmt->bindParam(':motivos', $datos['motivos'], PDO::PARAM_STR);
		$stmt->bindParam(':logros', $datos['logros'], PDO::PARAM_STR);
		$stmt->bindParam(':Empleados_idEmpleados', $idEmpleado, PDO::PARAM_STR);
		if($stmt->execute()){

			if ($datos['accion'] == 'otro') {

				return 'otro';
			}
			else{

				return 'terminar';
			}

		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function mdlVerEmpleados($tabla, $item, $valor){

		if($item == null && $valor == null){

			$sql = "SELECT *
			FROM empleados e 
			INNER JOIN emergencia m ON e.idEmpleados = m.Empleados_idEmpleados ORDER BY idEmpleados DESC;";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();
		}
		else{

			$stmt = Conexion::conectar()->prepare("SELECT * 
				FROM empleados e 
				INNER JOIN emergencia m ON e.idEmpleados = m.Empleados_idEmpleados 
				WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	/*---------- Esta función crea el formato del numero teléfonico ---------- */
	static public function mdlNumeroTelefonico($number){

		$number = preg_replace('/[^0-9]/', '', $number); // Elimina cualquier caracter que no sea un numero
		$length = strlen($number);
		if($length == 10){
		 // Formato de 10 digitos
			$number = preg_replace('/([0-9]{
				3}
				)([0-9]{
				3}
				)([0-9]{
				4}
			)/', '($1) $2-$3', $number);
		}
		elseif($length == 11){
		 // Formato de 11 digitos (con codigo de pais)
			$number = preg_replace('/([0-9]{
				1}
				)([0-9]{
				3}
				)([0-9]{
				3}
				)([0-9]{
				4}
			)/', '+$1 ($2) $3-$4', $number);
		}

		return $number;
	}

	static public function mdlSeleccionarHisrory($tabla, $idEmpleado){

		$sql = "SELECT * FROM $tabla WHERE Empleados_idEmpleados = :id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":id", $idEmpleado, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	/*---------- Función hecha para Registrar las fotos de Empleados---------- */
	static public function mdlRegistroFotoEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (namePhoto, Empleados_idEmpleados) VALUES (:imageName, :idEmpleado)");
		$stmt->bindParam(":imageName", $datos["imageName"], PDO::PARAM_STR);
		$stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_STR);
		if ($stmt->execute()) {

			return "ok";
		}
		 else {

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	/*---------- Función hecha para ver las fotos---------- */
	static public function mdlVerFotos($tabla, $item, $valor){

		if($item == null && $valor == null){

			$sql = "SELECT * FROM $tabla";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();
		}
		else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistroPDFEmpleado($tabla, $datos){

		$sql = "INSERT INTO $tabla (nameDoc, Empleados_idEmpleados) VALUES (:fileName, :idEmpleado);";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_STR);
		$stmt->bindParam(":fileName", $datos["fileName"], PDO::PARAM_STR);
		if ($stmt->execute()) {

			return "ok";
		}
		 else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*---------- Función hecha para ver las fotos---------- */
	static public function mdlVerDocumentos($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt -> fetchAll();
		$stmt->close();
		$stmt = null;
	}

	/*---------- Función hecha para ver las fotos---------- */
	static public function mdlVerDocumento($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT nameDoc FROM $tabla WHERE nameDoc = '$item' AND Empleados_idEmpleados = $valor");
		$stmt->execute();
		return $stmt -> fetch();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlImprimirDivs($validar,$nameDoc,$id,$nombreDocumento){

		// Si el archivo existe, mostrar un mensaje de éxito
		$div = '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">';
		$div .= '<div class="row centrado">';
		$div .= '<div class="form-group col-xl-8 col-lg-8 col-md-6 col-sm-6 col-12">';
		$div .= "<label>$nombreDocumento</label>";
		$div .= '<div class="alert alert-success center">';
		$div .= "$nombreDocumento ya en sistema";
		$div .= '</div>';
		$div .= '</div>';
		$div .= '</div>';
		$div .= '</div>';
		// Si el archivo no existe, mostrar el formulario para subirlo
		$div2 = '<form method="POST" enctype="multipart/form-data" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">';
		$div2 .= '<div class="row centrado">';
		$div2 .= '<div class="form-group col-xl-8 col-lg-8 col-md-6 col-sm-6 col-12">';
		$div2 .= "<label for=\"$nameDoc\">$nombreDocumento</label>";
		$div2 .= "<input type=\"file\" accept=\".pdf\" class=\"form-control-file\" id=\"$nameDoc\" name=\"file\" required>";
		$div2 .= '</div>';
		$div2 .= '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">';
		$div2 .= "<input type=\"hidden\" name=\"archivo\" value=\"$nameDoc\">";
		$div2 .= "<input type=\"hidden\" name=\"empleado\" value=\"$id\">";
		$div2 .= '<button type="submit" class="btn btn-outline-secondary rounded btn-block">Enviar</button>';
		$div2 .= '</div>';
		$div2 .= '</div>';
		$div2 .= '</form>';
		if ($validar == 1) {

			return $div;
		}
		else{

			return $div2;
		}

	}

	static public function mdlRegistrarDeptos($tabla, $datos){

		if ($datos['idEmpleado'] == "Sin empleado") {
			$sql = "INSERT INTO $tabla (nameDepto, Empresas_idEmpresas, Pertenencia) VALUES (:nameDepto, :Empresas_idEmpresas, :Pertenencia);";
			
			$stmt = Conexion::conectar()->prepare($sql);
		}else{
			$sql = "INSERT INTO $tabla(nameDepto, Empleados_idEmpleados, Empresas_idEmpresas, Pertenencia) VALUES (:nameDepto, :Empleados_idEmpleados, :Empresas_idEmpresas, :Pertenencia)";
			
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":Empleados_idEmpleados", $datos['idEmpleado'], PDO::PARAM_INT);
		}

		$stmt->bindParam(":nameDepto", $datos['name'], PDO::PARAM_STR);
		$stmt->bindParam(":Empresas_idEmpresas", $datos['idEmpresa'], PDO::PARAM_INT);
		$stmt->bindParam(":Pertenencia", $datos['Pertenencia'], PDO::PARAM_INT);
		if ($stmt->execute()) {

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function mdlVerEmpleadosDisponibles($tabla,$item){

		$sql = "SELECT * FROM $tabla 
				WHERE status = 1 
				AND idEmpleados NOT IN (SELECT Empleados_idEmpleados FROM $item)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt -> fetchAll();
		$stmt->close();
		$stmt = null;
	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function mdlVerDepartamentos($tabla, $item, $valor){

		if ($item == null && $valor == null) {

			$sql = "SELECT * FROM departamentos WHERE status = 1 ORDER BY idDepartamentos;";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();
		}
		else{

			$sql = "SELECT * FROM $tabla WHERE $item = :$item AND status = 1 ORDER BY idDepartamentos";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function mdlDeptosEspecial($tabla, $item, $valor){

		$sql = "SELECT * FROM $tabla WHERE $item = :$item AND status = 1 ORDER BY idDepartamentos";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}
	static public function mdlDeptosEspecial2($tabla, $item, $valor){

		$sql = "SELECT d.nameDepto as name, d.idDepartamentos as id, de.nameDepto as Pertenencia
				FROM $tabla d
				LEFT JOIN $tabla de on de.idDepartamentos = d.Pertenencia
				WHERE d.$item = :$item AND d.status = 1";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizarDepto($tabla, $datos){

		$sql = "UPDATE $tabla SET nameDepto=:nameDepto ,Empleados_idEmpleados=:Empleados_idEmpleados, Empresas_idEmpresas=:Empresas_idEmpresas WHERE idDepartamentos = :idDepartamentos";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":nameDepto", $datos['name'], PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['idEmpleado'], PDO::PARAM_INT);
		$stmt->bindParam(":Empresas_idEmpresas", $datos['idEmpresa'], PDO::PARAM_INT);
		$stmt->bindParam(":idDepartamentos", $datos['idDepto'], PDO::PARAM_INT);
		if ($stmt->execute()) {

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	
	static public function mdlEliminarDepto($tabla, $idDepto){

		$sql = "UPDATE $tabla SET status=0, Empleados_idEmpleados=0 WHERE idDepartamentos = :idDepartamentos";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idDepartamentos", $idDepto, PDO::PARAM_INT);
		if ($stmt->execute()) {

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarPuestos($tabla, $datos){

		$sql = "INSERT INTO $tabla(namePuesto, salario, salario_integrado, Empleados_idEmpleados, Departamentos_idDepartamentos) VALUES (:namePuesto, :salario, :salario_integrado, :Empleados_idEmpleados, :Departamentos_idDepartamentos)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":namePuesto", $datos['namePuesto'], PDO::PARAM_STR);
		$stmt->bindParam(":salario", $datos['salario'], PDO::PARAM_STR);
		$stmt->bindParam(":salario_integrado", $datos['salario_integrado'], PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['Empleados_idEmpleados'], PDO::PARAM_STR);
		$stmt->bindParam(":Departamentos_idDepartamentos", $datos['Departamentos_idDepartamentos'], PDO::PARAM_STR);
		if ($stmt->execute()) {

			return 'ok';
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarVacantes($tabla, $datos){

		$color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
		$sql = "INSERT INTO $tabla(nameVacante, salarioVacante, requisitos, Departamentos_idDepartamentos, color) VALUES (:nameVacante, :salarioVacante, :requisitos, :Departamentos_idDepartamentos, :color)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":nameVacante", $datos['nameVacante'], PDO::PARAM_STR);
		$stmt->bindParam(":salarioVacante", $datos['salarioVacante'], PDO::PARAM_STR);
		$stmt->bindParam(":requisitos", $datos['requisitos'], PDO::PARAM_STR);
		$stmt->bindParam(":Departamentos_idDepartamentos", $datos['Departamentos_idDepartamentos'], PDO::PARAM_STR);
		$stmt->bindParam(":color", $color, PDO::PARAM_STR);
		if ($stmt->execute()) {

			return 'ok';
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizarVacantes($tabla, $datos){

		$sql = "UPDATE vacantes SET nameVacante=:nameVacante,salarioVacante=:salarioVacante,requisitos=:requisitos,Departamentos_idDepartamentos=:Departamentos_idDepartamentos WHERE idVacantes = :idVacante";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":nameVacante", $datos['nameVacante'], PDO::PARAM_STR);
		$stmt->bindParam(":salarioVacante", $datos['salarioVacante'], PDO::PARAM_STR);
		$stmt->bindParam(":requisitos", $datos['requisitos'], PDO::PARAM_STR);
		$stmt->bindParam(":Departamentos_idDepartamentos", $datos['Departamentos_idDepartamentos'], PDO::PARAM_STR);
		$stmt->bindParam(":idVacante", $datos['idVacante'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	/*---------- Función hecha para ver a los empleados---------- */
	static public function mdlVerTabla($tabla, $item, $valor){

		if ($item == null && $valor == null) {

			if ($tabla == "puesto") {

				$sql = "SELECT * FROM $tabla 
				JOIN empleados ON empleados.idEmpleados = $tabla.Empleados_idEmpleados 
				JOIN departamentos ON $tabla.Departamentos_idDepartamentos = departamentos.idDepartamentos 
				WHERE $tabla.status = 1;";
			}
			elseif ($tabla == "vacantes") {

				$sql = "SELECT * FROM $tabla 
				JOIN departamentos ON $tabla.Departamentos_idDepartamentos = departamentos.idDepartamentos 
				WHERE $tabla.status = 1;";
			}

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();
		}
		else{

			$sql = "SELECT * FROM $tabla WHERE $item = :$item";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarVacante($tabla, $idVacantes){

		$sql = "UPDATE $tabla SET status = 0 WHERE idVacantes=$idVacantes";
		$stmt = Conexion::conectar()->prepare($sql);
		if ($stmt->execute()) {

			return 'ok';
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerPostulantes($tabla, $item, $valor){

		if ($item == null && $valor == null) {

			$sql = "SELECT * FROM $tabla 
			JOIN Vacantes ON $tabla.Vacantes_idVacantes = Vacantes.idVacantes 
			WHERE $tabla.statusPostulante = 1;";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();
		}
		elseif ($tabla == "suma") {

			$sql = "SELECT SUM(1) FROM postulantes WHERE statusPostulante = 1 AND $item = :$item;";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
			
		}
		elseif ($item == "Vacantes_idVacantes") {

			$sql = "SELECT * FROM $tabla WHERE statusPostulante = 1 AND $item = :$item;";
			$stmt = Conexion::conectar()->prepare($sql);
			
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();
			
		}
		else{

			$sql = "SELECT * FROM $tabla WHERE $item = :$item";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistroPostulante($tabla, $datos){

		$pdo=Conexion::conectar();
		$sql = "INSERT INTO $tabla(namePostulante, lastnamePostulante, phonePostulante, emailPostulante, Vacantes_idVacantes) VALUES (:namePostulante, :lastnamePostulante, :phonePostulante, :emailPostulante, :Vacantes_idVacantes)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":namePostulante", $datos['namePostulante'], PDO::PARAM_STR);
		$stmt->bindParam(":lastnamePostulante", $datos['lastnamePostulante'], PDO::PARAM_STR);
		$stmt->bindParam(":phonePostulante", $datos['phonePostulante'], PDO::PARAM_STR);
		$stmt->bindParam(":emailPostulante", $datos['emailPostulante'], PDO::PARAM_STR);
		$stmt->bindParam(":Vacantes_idVacantes", $datos['Vacantes_idVacantes'], PDO::PARAM_STR);
		if ($stmt->execute()) {

			$idPostulante = $pdo->lastInsertId(); //obtener el ID del empleado recién insertado
			if ($idPostulante == 0) {

				echo $consulta->errorInfo()[2];
				return "error";
			}
			else{

				$Registro = $idPostulante;
				return $Registro;
			}

		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistroPDFPostulante($tabla, $datos){

		$pdo=Conexion::conectar();
		$sql = "INSERT INTO documento_postulante(nameDocPost, Postulantes_idPostulantes) VALUES (:nameDocPost, :Postulantes_idPostulantes)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":nameDocPost", $datos['nameDocPost'], PDO::PARAM_STR);
		$stmt->bindParam(":Postulantes_idPostulantes", $datos['Postulantes_idPostulantes'], PDO::PARAM_STR);
		if ($stmt->execute()) {

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlAgendarCitas($tabla, $datos){

		$pdo=Conexion::conectar();
		$sql = "INSERT INTO $tabla(fechaReunion, Postulantes_idPostulantes) VALUES (:fechaReunion, :Postulantes_idPostulantes)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":fechaReunion", $datos['fechaReunion'], PDO::PARAM_STR);
		$stmt->bindParam(":Postulantes_idPostulantes", $datos['Postulantes_idPostulantes'], PDO::PARAM_STR);
		if ($stmt->execute()) {

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
		
	}

	static public function mdlVerReuniones($tabla, $item, $valor){

		if ($item == "idReuniones") {

			$sql = "SELECT *
					FROM $tabla 
					WHERE $item = :$item";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}
		else{

			$sql = "SELECT * 
					FROM $tabla 
					WHERE $item = :$item";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		}

	}

	static public function mdlContarReuniones($tabla, $item, $valor){

		$sql = "SELECT COUNT(*) FROM $tabla WHERE $item = :$item AND status = 0";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt -> fetch();
		$stmt->close();
		$stmt = null;
	}

	/*
	Esta función actualiza la calificación y comentarios de una reunión y establece el estado de la reunión como "calificada". También actualiza el color del postulante en la tabla "postulantes".
	Parámetros:
	$tabla: nombre de la tabla en la que se almacenarán los datos.
	$datos: un array que contiene los datos de la reunión a calificar.
	La función prepara una consulta SQL que actualiza los campos de la tabla "reuniones" y "postulantes" y vincula los parámetros a los valores de las variables. La función utiliza dos consultas SQL separadas, una para actualizar la tabla "reuniones" y otra para actualizar la tabla "postulantes".
	La función devuelve "ok" si la actualización fue exitosa o imprime el mensaje de error devuelto por la base de datos en caso contrario.
	*/
	
	static public function mdlCalificarReunion($tabla, $datos){

		$sql = "UPDATE $tabla SET pregunta1=:pregunta1, pregunta2=:pregunta2, pregunta3=:pregunta3, pregunta4=:pregunta4, comentariosReunion=:comentariosReunion, status = 1 WHERE idReuniones = :idReuniones AND status = 0;";
		$sql .= "UPDATE postulantes SET colorPostulante=:pregunta4 WHERE idPostulantes = :idPostulantes;";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt -> bindParam(":pregunta1", $datos['pregunta1'], PDO::PARAM_INT);
		$stmt -> bindParam(":pregunta2", $datos['pregunta2'], PDO::PARAM_INT);
		$stmt -> bindParam(":pregunta3", $datos['pregunta3'], PDO::PARAM_INT);
		$stmt -> bindParam(":pregunta4", $datos['pregunta4'], PDO::PARAM_INT);
		$stmt -> bindParam(":comentariosReunion", $datos['comentariosReunion'], PDO::PARAM_STR);
		$stmt -> bindParam(":idReuniones", $datos['idReuniones'], PDO::PARAM_INT);
		$stmt -> bindParam(":idPostulantes", $datos['idPostulantes'], PDO::PARAM_INT);
		if ($stmt->execute()) {

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarPostulante($tabla, $item, $valor){

		$sql = "UPDATE $tabla SET statusPostulante=0 WHERE $item = :valor";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
		if ($stmt->execute()) {

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}


	static public function correoVerificacion($datos){

		$mensaje = '<div><img style="display: block; margin-left: auto; margin-right: auto;" src="https://asociacionmexicanadeperiodontologia.com/logoinconsulting.png" alt="" width="112" height="112"></div>';
		if ($datos['genero'] == 0) {

			$mensaje .= '<div>
			<div><strong>Estimada '.ucwords($datos["nombre"]." ".$datos["apellidos"]).'</strong></div>
			<div> </div> 
			<div>Bienvenida a IN Consulting, una empresa líder en el sector de la consultoría estratégica. Estamos muy contentos de contar contigo en nuestro equipo y esperamos que tu experiencia con nosotros sea gratificante y enriquecedora.</div>
			<div> </div>';
		}
		else{

			$mensaje .= '<div>
			<div><strong>Estimado '.ucwords($datos["nombre"]." ".$datos["apellidos"]).'</strong></div>
			<div> </div> 
			<div>Bienvenido a IN Consulting, una empresa líder en el sector de la consultoría estratégica. Estamos muy contentos de contar contigo en nuestro equipo y esperamos que tu experiencia con nosotros sea gratificante y enriquecedora.</div>
			<div> </div>';
		}

		$mensaje .= '<div>Tu contraseña temporal es la siguiente: <strong>'.$datos['password'].'</strong>. </div>
		<div> </div>
		<div>Ingresa con tu correo y contraseña a la siguiente dirección: <a href="http://inconsulting.porscheclubmorelia.com/">inconsulting</a> y cambia la contraseña por una más segura y personal. </div>
		<div> </div>
		<div>Esperamos que te sientas cómodo/a y motivado/a en tu nuevo puesto. Si tienes cualquier pregunta o sugerencia, no dudes en contactarnos.</div>
		<div> </div>
		<div style="text-align: center;"><strong>Atentamente:</strong></div>
		<div style="text-align: center;"> </div>
		<div style="text-align: center;"><em>El equipo de IN Consulting</em></div>
		</div>';
		$destinatario = $datos['email'];
		$asunto = 'Bienvenido a IN Consulting';
// Configuración de cabeceras del correo
		$cabeceras = "From: noreply@inconsulting.porscheclubmorelia.com\r\n";
		$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
// Envío del correo electrónico
		if (mail($destinatario, $asunto, $mensaje, $cabeceras)) {

			return 'enviado';
		}
		 else {

			return 'no enviado';
		}

	}

	static public function mdlEmpleadoMes($tabla,$datos){
		$sql = "INSERT INTO $tabla(Empleados_idEmpleados, mensaje, Publicado_idEmpleados) VALUES (:Empleados_idEmpleados, :mensaje, :Publicado_idEmpleados)";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Empleados_idEmpleados", $datos['Empleados_idEmpleados'], PDO::PARAM_INT);
		$stmt->bindParam(":mensaje", $datos['mensaje'], PDO::PARAM_STR);
		$stmt->bindParam(":Publicado_idEmpleados", $datos['Publicado_idEmpleados'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlSeleccionarEmpleadoMes($tabla){

		$stmt = Conexion::conectar()->prepare("
			SELECT * FROM $tabla
			JOIN empleados ON empleados.idEmpleados = $tabla.Empleados_idEmpleados
			ORDER BY fecha_publicacion DESC LIMIT 1");
		$stmt->execute();
		return $stmt -> fetch();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlCrearNoticia($tabla, $datos){
		$pdo = Conexion::conectar();
		$stmt = $pdo->prepare("INSERT INTO $tabla(Empleados_idEmpleados, mensaje, fecha_fin, foto_noticia) VALUES (:Empleados_idEmpleados, :mensaje, :fecha_fin, :foto_noticia)");

		$stmt->bindParam(":Empleados_idEmpleados", $datos['Empleados_idEmpleados'], PDO::PARAM_INT);
		$stmt->bindParam(":mensaje", $datos['mensaje'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos['fecha_fin'], PDO::PARAM_STR);
		$stmt->bindParam(":foto_noticia", $datos['foto_noticia'], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return $pdo->lastInsertId();
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerNoticias($tabla, $item, $valor){

		if ($item == null && $valor == null) {
			$sql = "SELECT * FROM $tabla WHERE fecha_fin+1 > CURDATE()";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();
		}else{
			$sql = "SELECT * FROM $tabla WHERE $item = :$item";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlImagenNoticia($id, $name){
		$sql = "UPDATE noticias SET name_foto=:name_foto WHERE idNoticias=:idNoticias";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":name_foto", $name, PDO::PARAM_STR);
		$stmt->bindParam(":idNoticias", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {

			return "ok";
		}
		else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarEmpresas($tabla, $datos){
		$sql = "INSERT INTO $tabla
		(registro_patronal, rfc, nombre_razon_social, regimen, actividad_economica, calle, numero, numero_interior, colonia, cp, entidad, poblacion_municipio, telefono, convenio_reembolso, delegacion_imss, subdelegacion, clave_subdelegacion, dia_inicio_afiliacion,  mes_inicio_afiliacion, anio_inicio_afiliacion) 
		VALUES (:registro_patronal,:rfc,:nombre_razon_social,:regimen,:actividad_economica,:calle,:numero,:numero_interior,:colonia,:cp,:entidad,:poblacion_municipio,:telefono,:convenio_reembolso,:delegacion_imss,:subdelegacion,:clave_subdelegacion,:dia_inicio_afiliacion, :mes_inicio_afiliacion,:anio_inicio_afiliacion)";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":registro_patronal", $datos['registro_patronal'], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datos['rfc'], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_razon_social", $datos['nombre_razon_social'], PDO::PARAM_STR);
		$stmt->bindParam(":regimen", $datos['regimen'], PDO::PARAM_INT);
		$stmt->bindParam(":actividad_economica", $datos['actividad_economica'], PDO::PARAM_STR);
		$stmt->bindParam(":calle", $datos['calle'], PDO::PARAM_STR);
		$stmt->bindParam(":numero", $datos['numero'], PDO::PARAM_STR);
		$stmt->bindParam(":numero_interior", $datos['numero_interior'], PDO::PARAM_STR);
		$stmt->bindParam(":colonia", $datos['colonia'], PDO::PARAM_STR);
		$stmt->bindParam(":cp", $datos['cp'], PDO::PARAM_INT);
		$stmt->bindParam(":entidad", $datos['entidad'], PDO::PARAM_STR);
		$stmt->bindParam(":poblacion_municipio", $datos['poblacion_municipio'], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_INT);
		$stmt->bindParam(":convenio_reembolso", $datos['convenio_reembolso'], PDO::PARAM_STR);
		$stmt->bindParam(":delegacion_imss", $datos['delegacion_imss'], PDO::PARAM_STR);
		$stmt->bindParam(":subdelegacion", $datos['subdelegacion'], PDO::PARAM_STR);
		$stmt->bindParam(":clave_subdelegacion", $datos['clave_subdelegacion'], PDO::PARAM_STR);
		$stmt->bindParam(":dia_inicio_afiliacion", $datos['dia_inicio_afiliacion'], PDO::PARAM_INT);
		$stmt->bindParam(":mes_inicio_afiliacion", $datos['mes_inicio_afiliacion'], PDO::PARAM_STR);
		$stmt->bindParam(":anio_inicio_afiliacion", $datos['anio_inicio_afiliacion'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
	}

	static public function mdlActualizarEmpresas($tabla, $datos){
		$sql = "UPDATE $tabla SET 
		        registro_patronal = :registro_patronal,
		        rfc = :rfc,
		        nombre_razon_social = :nombre_razon_social,
		        regimen = :regimen,
		        actividad_economica = :actividad_economica,
		        calle = :calle,
		        numero = :numero,
		        numero_interior = :numero_interior,
		        colonia = :colonia,
		        cp = :cp,
		        entidad = :entidad,
		        poblacion_municipio = :poblacion_municipio,
		        telefono = :telefono,
		        convenio_reembolso = :convenio_reembolso,
		        delegacion_imss = :delegacion_imss,
		        subdelegacion = :subdelegacion,
		        clave_subdelegacion = :clave_subdelegacion,
		        dia_inicio_afiliacion = :dia_inicio_afiliacion,
		        mes_inicio_afiliacion = :mes_inicio_afiliacion,
		        anio_inicio_afiliacion = :anio_inicio_afiliacion
		        WHERE idEmpresas = :actualizarEmpresa";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":registro_patronal", $datos['registro_patronal'], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datos['rfc'], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_razon_social", $datos['nombre_razon_social'], PDO::PARAM_STR);
		$stmt->bindParam(":regimen", $datos['regimen'], PDO::PARAM_INT);
		$stmt->bindParam(":actividad_economica", $datos['actividad_economica'], PDO::PARAM_STR);
		$stmt->bindParam(":calle", $datos['calle'], PDO::PARAM_STR);
		$stmt->bindParam(":numero", $datos['numero'], PDO::PARAM_STR);
		$stmt->bindParam(":numero_interior", $datos['numero_interior'], PDO::PARAM_STR);
		$stmt->bindParam(":colonia", $datos['colonia'], PDO::PARAM_STR);
		$stmt->bindParam(":cp", $datos['cp'], PDO::PARAM_INT);
		$stmt->bindParam(":entidad", $datos['entidad'], PDO::PARAM_STR);
		$stmt->bindParam(":poblacion_municipio", $datos['poblacion_municipio'], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_INT);
		$stmt->bindParam(":convenio_reembolso", $datos['convenio_reembolso'], PDO::PARAM_STR);
		$stmt->bindParam(":delegacion_imss", $datos['delegacion_imss'], PDO::PARAM_STR);
		$stmt->bindParam(":subdelegacion", $datos['subdelegacion'], PDO::PARAM_STR);
		$stmt->bindParam(":clave_subdelegacion", $datos['clave_subdelegacion'], PDO::PARAM_STR);
		$stmt->bindParam(":dia_inicio_afiliacion", $datos['dia_inicio_afiliacion'], PDO::PARAM_INT);
		$stmt->bindParam(":mes_inicio_afiliacion", $datos['mes_inicio_afiliacion'], PDO::PARAM_STR);
		$stmt->bindParam(":anio_inicio_afiliacion", $datos['anio_inicio_afiliacion'], PDO::PARAM_INT);
		$stmt->bindParam(":actualizarEmpresa", $datos['actualizarEmpresa'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
	}

	static public function mdlVerEmpresas($tabla,$item,$valor){
		if ($item == null && $valor == null) {
			$stmt = Conexion::conectar()->prepare("SELECT e.*, COUNT(em.idEmpleados) AS totalEmpleados
													FROM empresas e
													LEFT JOIN departamentos d ON e.idEmpresas = d.Empresas_idEmpresas
													LEFT JOIN puesto p ON d.idDepartamentos = p.Departamentos_idDepartamentos
													LEFT JOIN empleados em ON p.Empleados_idEmpleados = em.idEmpleados AND em.status = 1
													GROUP BY e.idEmpresas;
												");
			$stmt->execute();
			return $stmt->fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;

	}

	static public function obtenerDatosEmpresa($empresaId)
    {
        $conexion = Conexion::conectar();

        $sql = "SELECT e.idEmpleados AS id, CONCAT(e.name, ' ', e.lastname) AS name, d.nameDepto AS area, 
				    CONCAT('Empleado&perfil=', e.idEmpleados) AS profileUrl, p.namePuesto AS positionName, 
				    CASE 
				        WHEN d.Empleados_idEmpleados = e.idEmpleados THEN
				            (SELECT Empleados_idEmpleados FROM departamentos WHERE idDepartamentos = d.Pertenencia)
				        ELSE
				            (SELECT Empleados_idEmpleados FROM departamentos WHERE idDepartamentos = p.Departamentos_idDepartamentos)
				    END AS parentId,
				    CASE 
				        WHEN f.namePhoto IS NULL THEN 'assets/images/general.jpg'
				        ELSE CONCAT('view/fotos/thumbnails/', f.namePhoto)
				    END AS imageUrl
				FROM empleados e
				INNER JOIN puesto p ON e.idEmpleados = p.Empleados_idEmpleados
				INNER JOIN departamentos d ON p.Departamentos_idDepartamentos = d.idDepartamentos
				LEFT JOIN foto_empleado f ON f.Empleados_idEmpleados = e.idEmpleados
				WHERE d.Empresas_idEmpresas = :empresaId AND e.status = 1;
				";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':empresaId', $empresaId);
        $stmt->execute();

        $datosEmpresa = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $datosEmpresa;
    }

    static public function mdlEmpleadosEspecial($tabla,$item,$valor){
    	$sql = "SELECT * 
					FROM $tabla e
					LEFT JOIN puesto p on p.Empleados_idEmpleados = e.idEmpleados
					LEFT JOIN departamentos d ON d.idDepartamentos = p.Departamentos_idDepartamentos
					LEFT JOIN empresas em ON d.Empresas_idEmpresas = em.idEmpresas
				WHERE em.$item = :$item ORDER BY e.idEmpleados";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
    }

    static public function mdlForgotPasswordEmail($datos){

		$mensaje = '<div><img style="display: block; margin-left: auto; margin-right: auto;" src="https://asociacionmexicanadeperiodontologia.com/logoinconsulting.png" alt="" width="112" height="112"></div>';
		if ($datos['genero'] == 0) {

			$mensaje .= '<div>
			<div><strong>Estimada '.ucwords($datos["name"]).'</strong></div>
			<div> </div> 
			<div>Le escribimos para informarle que hemos recibido una solicitud para restablecer su contraseña. Si usted ha solicitado este cambio, por favor haga clic en el siguiente enlace para completar el proceso:</div>
			<div> </div>';
		}
		else{

			$mensaje .= '<div>
			<div><strong>Estimado '.ucwords($datos["name"]).'</strong></div>
			<div> </div> 
			<div>Le escribimos para informarle que hemos recibido una solicitud para restablecer su contraseña. Si usted ha solicitado este cambio, por favor haga clic en el siguiente enlace para completar el proceso:</div>
			<div> </div>';
		}

		$mensaje .= '<div><a href="'.$datos["link"].'">'.$datos["link"].'</a></div>
		<div> </div>
		<div>Si usted no ha solicitado este cambio, por favor ignore este mensaje y no haga clic en el enlace. Su contraseña actual seguirá siendo válida.</div>
		<div> </div>
		<div>Gracias por confiar en IN Consulting.</div>
		<div> </div>
		<div style="text-align: center;"><strong>Atentamente:</strong></div>
		<div style="text-align: center;"> </div>
		<div style="text-align: center;"><em>El equipo de IN Consulting</em></div>
		</div>';
		$destinatario = $datos['email'];
		$asunto = 'Recuperación de contraseña';
// Configuración de cabeceras del correo
		$cabeceras = "From: noreply@inconsulting.porscheclubmorelia.com\r\n";
		$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
// Envío del correo electrónico
		if (mail($destinatario, $asunto, $mensaje, $cabeceras)) {
			$stmt = Conexion::conectar()->prepare("INSERT INTO solicitud_cambio_password(Empleados_idEmpleados, forgot) VALUES (:Empleados_idEmpleados, :forgot)");
			$stmt->bindParam(":Empleados_idEmpleados", $datos['idEmpleados'], PDO::PARAM_INT);
			$stmt->bindParam(":forgot", $datos['emailEncript'], PDO::PARAM_STR);
			if ($stmt->execute()) {
				return 'ok';
			}
			$stmt->close();
			$stmt = null;
		}
		 else {

			return 'no enviado';
		}

    }

    static public function mdlGuardarHorario($tabla,$nameHorario,$horarios){

    	$pdo = Conexion::conectar();
    	$sql = "INSERT INTO $tabla (nameHorario) VALUES (:nameHorario)";
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(":nameHorario", $nameHorario, PDO::PARAM_STR);
		
		$idHorario = 0;

		if($stmt->execute()){
			$idHorario = $pdo->lastInsertId(); //obtener el ID del empleado recién insertado
		}

		if ($idHorario == 0) {
			echo $consulta->errorInfo()[2];
		}else{
			$i=0;
			$tabla = "dia_horario";
			foreach ($horarios as $key => $value) {

				$timestamp_entrada = strtotime($value['entrada']);
				$timestamp_salida = strtotime($value['salida']);

				$diferencia_segundos = $timestamp_salida - $timestamp_entrada;
				$diferencia_horas = $diferencia_segundos / 3600;

				$diferencia = round($diferencia_horas, 2);

				$datos = array(
					"Horarios_idHorarios" => $idHorario,
					"dia_Laborable" => $key,
					"hora_Entrada" => $value['entrada'],
					"hora_Salida" => $value['salida'],
					"numero_Horas" => $diferencia
				);
				$registrar_dias = ModeloFormularios::mdlRegistrarDiasHorario($tabla,$datos);
				$i++;
			}
			if ($i >= 1) {
				return "ok";
			}

		}

		$stmt->close();
		$stmt = null;
		

    }

    static public function mdlRegistrarDiasHorario($tabla,$datos){
    	$pdo = Conexion::conectar();
    	$sql = "INSERT INTO $tabla (Horarios_idHorarios, dia_Laborable, hora_Entrada, hora_Salida, numero_Horas) VALUES (:Horarios_idHorarios, :dia_Laborable, :hora_Entrada, :hora_Salida, :numero_Horas)";
		$stmt = $pdo->prepare($sql);

    	$stmt->bindParam(":Horarios_idHorarios", $datos['Horarios_idHorarios'], PDO::PARAM_INT);
    	$stmt->bindParam(":dia_Laborable", $datos['dia_Laborable'], PDO::PARAM_INT);
    	$stmt->bindParam(":hora_Entrada", $datos['hora_Entrada'], PDO::PARAM_STR);
    	$stmt->bindParam(":hora_Salida", $datos['hora_Salida'], PDO::PARAM_STR);
    	$stmt->bindParam(":numero_Horas", $datos['numero_Horas'], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}

		$stmt->close();
		$stmt = null;
    }

    static public function mdlSeleccionarHorarios($tabla,$item,$valor){
	    if ($item == null && $valor == null) {	
	    	$sql = "SELECT h.idHorarios, h.nameHorario, h.default, SUM(dh.numero_Horas) 
					FROM $tabla h
					JOIN dia_horario dh ON dh.Horarios_idHorarios = h.idHorarios
					GROUP BY h.idHorarios, h.nameHorario, h.default";

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();

		}else{
			$sql = "SELECT * FROM $tabla WHERE $item = :$item";

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt -> fetchAll();

		}

		$stmt->close();
		$stmt = null;
    }

    static public function mdlCambiarHorarioDefault($tabla,$idHorarios){
    	$sql = "UPDATE $tabla SET horarios.default = 0 WHERE horarios.default = 1;";
    	$sql .= "UPDATE $tabla SET horarios.default = 1 WHERE idHorarios = :idHorarios;";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idHorarios", $idHorarios, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
    }

    static public function mdlVerEmpleadosHorarios($tabla,$item,$valor){
    	$sql = "SELECT * from $tabla WHERE $item = :$item";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt -> fetchAll();
		$stmt->close();
		$stmt = null;
    }

    static public function mdlBorrarEmpleadosHorarios($tabla,$idHorario){

    	$sql = "DELETE FROM $tabla WHERE Horarios_idHorarios = :idHorario";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idHorario", $idHorario, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "eliminado";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;

    }

    static public function mdlregistrarEmpleadosHorario($tabla,$empleado,$idHorario){

    	$sql = "INSERT INTO $tabla (Empleados_idEmpleados, Horarios_idHorarios) VALUES (:empleado,:idHorario)";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":empleado", $empleado, PDO::PARAM_INT);
		$stmt->bindParam(":idHorario", $idHorario, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "cambio";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
    }

    static public function mdlActualizarEmpleadoHorario($tabla, $empleado, $idHorario){

    	$sql = "UPDATE $tabla SET Horarios_idHorarios=:idHorario WHERE Empleados_idEmpleados = :empleado";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":empleado", $empleado, PDO::PARAM_INT);
		$stmt->bindParam(":idHorario", $idHorario, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "cambio";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;

    }

    static public function mdlActualizarNombreHorario($tabla, $datos){
    	$sql = "UPDATE $tabla SET nameHorario=:nameHorario WHERE idHorarios = :idHorarios";

    	$stmt = Conexion::conectar()->prepare($sql);
    	$stmt->bindParam(":nameHorario",$datos['nameHorario'],PDO::PARAM_STR);
    	$stmt->bindParam(":idHorarios",$datos['idHorarios'],PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;

    }

    static public function mdlActualizarDiasLaborables($tabla, $datos){
    	$sql = "DELETE FROM $tabla WHERE Horarios_idHorarios = :Horarios_idHorarios";

    	$stmt = Conexion::conectar()->prepare($sql);
    	$stmt->bindParam(":Horarios_idHorarios",$datos['idHorarios'],PDO::PARAM_INT);
		if ($stmt->execute()) {
			$i=0;
			$idHorarios = $datos['idHorarios'];
			$tabla = "dia_horario";
			foreach ($datos['horarios'] as $key => $value) {

				$timestamp_entrada = strtotime($value['entrada']);
				$timestamp_salida = strtotime($value['salida']);

				$diferencia_segundos = $timestamp_salida - $timestamp_entrada;
				$diferencia_horas = $diferencia_segundos / 3600;

				$diferencia = round($diferencia_horas, 2);

				$datos = array(
					"Horarios_idHorarios" => $idHorarios,
					"dia_Laborable" => $key,
					"hora_Entrada" => $value['entrada'],
					"hora_Salida" => $value['salida'],
					"numero_Horas" => $diferencia
				);
				$registrar_dias = ModeloFormularios::mdlRegistrarDiasHorario($tabla,$datos);
				$i++;
			}
			if ($i >= 1) {
				return "ok";
			}
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;

    }

    static public function mdlRegistrarDiaFestivo($tabla, $datos){
    	$sql = "INSERT INTO $tabla(nameFestivo, fechaFestivo, fechaFin) VALUES (:nameFestivo,:fechaFestivo,:fechaFin)";

    	$stmt = Conexion::conectar()->prepare($sql);
    	$stmt->bindParam(":nameFestivo",$datos['nameFestivo'],PDO::PARAM_STR);
    	$stmt->bindParam(":fechaFestivo",$datos['fechaFestivo'],PDO::PARAM_STR);
    	$stmt->bindParam(":fechaFin",$datos['fechaFin'],PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
    }

    static public function mdlRegistrarPermisos($tabla, $datos){
    	$sql = "INSERT INTO $tabla(namePermisos,colorPermisos) VALUES (:namePermisos,:colorPermisos)";

    	$stmt = Conexion::conectar()->prepare($sql);
    	$stmt->bindParam(":namePermisos",$datos['namePermisos'],PDO::PARAM_STR);
    	$stmt->bindParam(":colorPermisos",$datos['colorPermisos'],PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
    }

    static public function mdlVerPermisos($tabla,$item,$valor){
	    if ($item == null && $valor == null) {	
	    	$sql = "SELECT * FROM $tabla";

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();

		}else{
			$sql = "SELECT * FROM $tabla WHERE $item = :$item";

			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt -> fetchAll();

		}

		$stmt->close();
		$stmt = null;
    }

	/*---------- Fin de ModeloFormularios ---------- */
}
