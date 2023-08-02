<?php
require_once "conexion.php";
class ModeloFormularios{
	/*---------- Función hecha para registrar a los empleados---------- */
	static public function mdlRegistrarEmpleados($tabla1, $table2, $datos){
		$pdo=Conexion::conectar();
		$stmt = $pdo->prepare("INSERT INTO $tabla1(name, lastname, genero, fNac, phone, email, password, identificacion, CURP, NSS, RFC, street, numE, numI, colonia, CP, municipio, estado, fecha_contratado) VALUES (:nombre, :apellidos, :genero, :fecha_nacimiento, :telefono, :email, :passwordEncriptado, :num_identificacion, :curp, :num_seguro_social, :rfc, :calle, :num_exterior, :num_interior, :colonia, :cp, :municipio, :estado, :fecha_contratado)");

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
		$stmt->bindParam(':fecha_contratado', $datos['fecha_contratado'], PDO::PARAM_STR);
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
			INNER JOIN emergencia m ON e.idEmpleados = m.Empleados_idEmpleados ORDER BY lastname ASC;";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt -> fetchAll();
		}
		else{
			$stmt = Conexion::conectar()->prepare("SELECT *, d.Empleados_idEmpleados AS idEmpleadoDepa, e.status AS eStatus
			FROM empleados e
			INNER JOIN emergencia m ON e.idEmpleados = m.Empleados_idEmpleados
			LEFT JOIN puesto p ON e.idEmpleados = p.Empleados_idEmpleados
			LEFT JOIN departamentos d ON d.idDepartamentos = p.Departamentos_idDepartamentos
			LEFT JOIN empresas em ON em.idEmpresas = d.Empresas_idEmpresas
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
	static public function mdlVerPertenenciasDepartamentos($tabla, $item, $valor){
		$sql = "SELECT * FROM $tabla WHERE $item = :$item AND status = 1";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt -> fetchAll();

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
		$sql = "UPDATE $tabla SET nameDepto=:nameDepto, Empleados_idEmpleados=:Empleados_idEmpleados, Empresas_idEmpresas=:Empresas_idEmpresas WHERE idDepartamentos = :idDepartamentos";
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

	
	static public function mdlEliminarNoticia($tabla, $idNoticia){
		$sql = "DELETE FROM $tabla WHERE idNoticias = :idNoticias";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idNoticias", $idNoticia, PDO::PARAM_INT);
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

		$sql = "INSERT INTO $tabla(nameVacante, salarioVacante, requisitos, Empresas_idEmpresas, Departamentos_idDepartamentos, Empleados_idEmpleados, color) VALUES (:nameVacante, :salarioVacante, :requisitosVacante, :empresaVacante, :departamentoVacante, :idEmpleados, :color)";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":nameVacante", $datos['nameVacante'], PDO::PARAM_STR);
		$stmt->bindParam(":salarioVacante", $datos['salarioVacante'], PDO::PARAM_STR);
		$stmt->bindParam(":requisitosVacante", $datos['requisitosVacante'], PDO::PARAM_STR);
		$stmt->bindParam(":empresaVacante", $datos['empresaVacante'], PDO::PARAM_INT);
		$stmt->bindParam(":departamentoVacante", $datos['departamentoVacante'], PDO::PARAM_INT);
		$stmt->bindParam(":idEmpleados", $datos['idEmpleados'], PDO::PARAM_INT);
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

	static public function mdlActivarVacante($tabla, $datos){
		$sql = "UPDATE $tabla SET aprobado = :aprobado, Jefe_idEmpleados = :Jefe_idEmpleados WHERE idVacantes = :idVacante";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":aprobado", $datos['aprobado'], PDO::PARAM_INT);
		$stmt->bindParam(":Jefe_idEmpleados", $datos['Jefe_idEmpleados'], PDO::PARAM_INT);
		$stmt->bindParam(":idVacante", $datos['idVacantes'], PDO::PARAM_INT);

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
				$sql = "SELECT * FROM vacantes v
				JOIN departamentos d ON v.Departamentos_idDepartamentos = d.idDepartamentos 
				JOIN empresas e ON e.idEmpresas = v.Empresas_idEmpresas 
				WHERE v.status = 1;";
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

static public function mdlActualizarNoticia($tabla, $datos)
{
	$pdo = Conexion::conectar();
	$stmt = $pdo->prepare("UPDATE noticias SET mensaje=:mensaje,fecha_fin=:fecha_fin,foto_noticia=:foto_noticia WHERE idNoticias = :idNoticias");

	$stmt->bindParam(":mensaje", $datos['mensaje'], PDO::PARAM_STR);
	$stmt->bindParam(":fecha_fin", $datos['fecha_fin'], PDO::PARAM_STR);
	$stmt->bindParam(":foto_noticia", $datos['foto_noticia'], PDO::PARAM_INT);
	$stmt->bindParam(":idNoticias", $datos['idNoticias'], PDO::PARAM_INT);
	if ($stmt->execute()) {
		return $stmt->rowCount();
	} else {
		print_r($stmt->errorInfo());
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

static public function mdlImagenNoticia($id, $name)
{
	$pdo = Conexion::conectar();
	$sql = "UPDATE noticias SET name_foto=:name_foto WHERE idNoticias=:idNoticias";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":name_foto", $name, PDO::PARAM_STR);
	$stmt->bindParam(":idNoticias", $id, PDO::PARAM_INT);
	if ($stmt->execute()) {
		return "ok";
	} else {
		print_r($stmt->errorInfo());
	}
	$stmt->close();
	$stmt = null;
}

	static public function mdlRegistrarEmpresas($tabla, $datos){
		$sql = "INSERT INTO $tabla
		(registro_patronal, rfc, nombre_razon_social, regimen, actividad_economica, calle, numero, numero_interior, colonia, cp, entidad, poblacion_municipio, telefono, convenio_reembolso, delegacion_imss, subdelegacion, clave_subdelegacion, dia_inicio_afiliacion, mes_inicio_afiliacion, anio_inicio_afiliacion) 
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

		$sql = "SELECT DISTINCT e.idEmpleados AS id, CONCAT(e.name, ' ', e.lastname) AS name, d.nameDepto AS area, 
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
				WHERE em.$item = :$item ORDER BY e.lastname";
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

	static public function mdlBorrarEmpleadosExamenes($idExamen){
		$sql = "DELETE FROM empleados_has_examenes WHERE idExamen = :idExamen";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idExamen", $idExamen, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "eliminado";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlregistrarEmpleadosHorario($tabla,$empleado,$idHorario){
		$sql = "DELETE FROM $tabla WHERE Empleados_idEmpleados = :empleado;";
		$sql .= "INSERT INTO $tabla (Empleados_idEmpleados, Horarios_idHorarios) VALUES (:empleado,:idHorario);";

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

	static public function mdlregistrarEmpleadosExamenes($empleado,$idExamen){
		$sql = "DELETE FROM empleados_has_examenes WHERE idExamen = :idExamen AND idEmpleado = :empleado;";

		$sql .= "INSERT INTO empleados_has_examenes (idExamen, idEmpleado, fecha_inicio, fecha_fin, tiempo_utilizado) VALUES (:idExamen, :empleado, NULL, NULL, 0);";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idExamen", $idExamen, PDO::PARAM_INT);
		$stmt->bindParam(":empleado", $empleado, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
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

	static public function mdlCrearJustificante($tabla,$datos){
		$sql = "INSERT INTO $tabla(Comentario, Empleados_idEmpleados, Asistencias_idAsistencias) VALUES (:Comentario, :Empleados_idEmpleados, :Asistencias_idAsistencias)";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":Comentario",$datos['Comentario'],PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados",$datos['Empleados_idEmpleados'],PDO::PARAM_INT);
		$stmt->bindParam(":Asistencias_idAsistencias",$datos['Asistencias_idAsistencias'],PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerPeticiones($tabla, $item, $valor){
		$sql = "SELECT * FROM $tabla j
				JOIN puesto p ON p.Empleados_idEmpleados = j.Empleados_idEmpleados
				WHERE $item = :idDepartamentos";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idDepartamentos", $valor, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerPeticionesDepartamentales($tabla, $item, $valor){
		$sql = "SELECT j.* FROM $tabla j
				LEFT JOIN departamentos d ON d.Empleados_idEmpleados = j.Empleados_idEmpleados
				WHERE $item = :Pertenencia";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":Pertenencia", $valor, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerAsistencia($tabla,$item,$valor){
		$sql = "SELECT * FROM $tabla WHERE $item = :$item";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		
		$stmt->close();
		$stmt = null;
	}

	static public function mdlJustificarAsistencia($tabla,$datos){
		$sql = "UPDATE $tabla SET status_justificante=:status_justificante WHERE idJustificantes = :idJustificantes";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idJustificantes",$datos['idJustificantes'],PDO::PARAM_INT);
		$stmt->bindParam(":status_justificante",$datos['valor'],PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlResponderVacaciones($tabla,$datos){
		$date = date('Y-m-d h:i:s', time());
		$sql = "UPDATE $tabla SET fecha_respuesta=:fecha_respuesta, respuesta=:respuesta WHERE idVacaciones = :idVacaciones";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":fecha_respuesta",$date,PDO::PARAM_STR);
		$stmt->bindParam(":respuesta",$datos['valor'],PDO::PARAM_INT);
		$stmt->bindParam(":idVacaciones",$datos['idVacaciones'],PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlResponderPermisos($tabla,$datos){
		$sql = "UPDATE $tabla SET statusPermiso=:statusPermiso WHERE idEm_has_Per = :idEm_has_Per";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":statusPermiso",$datos['valor'],PDO::PARAM_INT);
		$stmt->bindParam(":idEm_has_Per",$datos['idEm_has_Per'],PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarHorarios($idHorarios){
		$sql = "DELETE FROM horarios WHERE idHorarios = :idHorarios;";
		$sql .= "DELETE FROM empleados_has_horarios WHERE Horarios_idHorarios = :idHorarios;";
		$sql .= "DELETE FROM dia_horario WHERE Horarios_idHorarios = :idHorarios;";

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

	static public function mdlVerPermisosEmpleados($idEmpleados){
		$sql = "SELECT 
				e.idEmpleados,
				FLOOR(TIMESTAMPDIFF(MONTH, e.fecha_contratado, CURDATE()) / 12) AS tiempoContrato,
				eh.idEm_has_Per AS idPermiso,
				CONCAT(e.lastname, ' ', e.name) AS nombre,
				CONCAT(DATE_FORMAT(eh.fechaPermiso, '%d/%m/%Y'), ' - ', DATE_FORMAT(eh.fechaFin, '%d/%m/%Y'), ' (', TIMESTAMPDIFF(DAY, eh.fechaPermiso, eh.fechaFin)+1, ' días)') AS rango,
				eh.statusPermiso,
				eh.descripcion,
				p.namePermisos AS permiso
				FROM 
				empleados e
				LEFT JOIN empleados_has_permisos eh ON eh.Empleados_idEmpleados = e.idEmpleados
				LEFT JOIN permisos p ON p.idPermisos = eh.Permisos_idPermisos
				WHERE e.idEmpleados = :idEmpleados;";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idEmpleados", $idEmpleados, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerSolicutudesPermisosEmpleados($idEmpleados){
		$sql = "SELECT 
				e.idEmpleados,
				FLOOR(TIMESTAMPDIFF(MONTH, e.fecha_contratado, CURDATE()) / 12) AS tiempoContrato,
				eh.idEm_has_Per AS idPermiso,
				CONCAT(e.lastname, ' ', e.name) AS nombre,
				CONCAT(DATE_FORMAT(eh.fechaPermiso, '%d/%m/%Y'), ' - ', DATE_FORMAT(eh.fechaFin, '%d/%m/%Y'), ' (', TIMESTAMPDIFF(DAY, eh.fechaPermiso, eh.fechaFin)+1, ' días)') AS rango,
				eh.statusPermiso,
				eh.descripcion,
				p.namePermisos AS permiso
				FROM 
				empleados e
				RIGHT JOIN empleados_has_permisos eh ON eh.Empleados_idEmpleados = e.idEmpleados
				LEFT JOIN permisos p ON p.idPermisos = eh.Permisos_idPermisos
				WHERE e.idEmpleados = :idEmpleados;";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idEmpleados", $idEmpleados, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		
		$stmt->close();
		$stmt = null;
	}

	static public function mdlGenerarPermiso($tabla,$datos){
		$sql = "INSERT INTO $tabla (fechaPermiso, fechaFin, descripcion, Empleados_idEmpleados, Permisos_idPermisos) VALUES (:fechaPermiso, :fechaFin, :descripcion, :Empleados_idEmpleados, :Permisos_idPermisos);";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":fechaPermiso",$datos['fechaPermiso'],PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin",$datos['fechaFin'],PDO::PARAM_STR);
		$stmt->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados",$datos['idEmpleados'],PDO::PARAM_INT);
		$stmt->bindParam(":Permisos_idPermisos",$datos['idPeticiones'],PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlGenerarVacaciones($tabla,$datos){
		$sql = "INSERT INTO $tabla (Empleados_idEmpleados, Jefe_idEmpleados, fecha_inicio_vacaciones, fecha_fin_vacaciones) VALUES (:Empleados_idEmpleados,:Jefe_idEmpleados,:fecha_inicio_vacaciones,:fecha_fin_vacaciones)";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":Empleados_idEmpleados",$datos['idEmpleados'],PDO::PARAM_INT);
		$stmt->bindParam(":Jefe_idEmpleados",$datos['jefeDepartamento'],PDO::PARAM_INT);
		$stmt->bindParam(":fecha_inicio_vacaciones",$datos['fechaPermiso'],PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin_vacaciones",$datos['fechaFin'],PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "vacaciones generadas";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarSolicitud($tabla,$idSolicitud){
		$sql = "DELETE FROM $tabla WHERE idEm_has_Per = :idSolicitud";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idSolicitud",$idSolicitud,PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "eliminado";
		}else{
			return "error";
		}
		
		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarSolicitudVacaciones($tabla,$idVacaciones){
		$sql = "UPDATE $tabla SET status_vacaciones=0 WHERE idVacaciones = :idVacaciones";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idVacaciones",$idVacaciones,PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "eliminado";
		}else{
			return "error";
		}
		
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerSolicitudesVacaciones($idEmpleados){
		$sql = "SELECT 
				e.idEmpleados, e.lastname, e.name, v.idVacaciones, v.respuesta, v.Jefe_idEmpleados as jefe, v.fecha_solicitud as solicitud, v.fecha_respuesta, v.fecha_aprobacion as aprobacion, e.fecha_contratado as contratado, v.status_vacaciones, v.fecha_inicio_vacaciones AS inicio, v.fecha_fin_vacaciones AS fin,
				CONCAT(e.lastname, ' ', e.name) AS nombre,
				CONCAT(DATE_FORMAT(v.fecha_inicio_vacaciones, '%d/%m/%Y'), ' - ', DATE_FORMAT(v.fecha_fin_vacaciones, '%d/%m/%Y'), ' (', TIMESTAMPDIFF(DAY, v.fecha_inicio_vacaciones, v.fecha_fin_vacaciones)+1, ' días)') AS rango,
				TIMESTAMPDIFF(DAY, v.fecha_inicio_vacaciones, v.fecha_fin_vacaciones)+1 AS dias
				FROM 
				empleados e
				LEFT JOIN vacaciones v ON v.Empleados_idEmpleados = e.idEmpleados
				WHERE e.idEmpleados =:idEmpleados;";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idEmpleados", $idEmpleados, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerSolicitudesPermisos($idEmpleados){
		$sql = "SELECT *, TIMESTAMPDIFF(DAY, ep.fechaPermiso, ep.fechaFin)+1 AS rango
				FROM empleados_has_permisos ep
				RIGHT JOIN permisos p ON p.idPermisos = ep.Permisos_idPermisos
				WHERE Empleados_idEmpleados = :idEmpleados;";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idEmpleados", $idEmpleados, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		
		$stmt->close();
		$stmt = null;
	}

	static public function mdlAsignarTarea($datos){
		$pdo =Conexion::conectar();
		$sql = "INSERT INTO tareas(nameTarea, descripcion, Empleados_idEmpleados, Vencimiento, Jefe_idEmpleados) VALUES (:nameTarea,:descripcion,:Empleados_idEmpleados,:Vencimiento,:Jefe_idEmpleados)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":nameTarea", $datos['nameTarea'], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['Empleados_idEmpleados'], PDO::PARAM_INT);
		$stmt->bindParam(":Vencimiento", $datos['vencimiento'], PDO::PARAM_STR);
		$stmt->bindParam(":Jefe_idEmpleados", $datos['Jefe_idEmpleados'], PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return $pdo->lastInsertId();
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEntregarTarea($datos){
		$pdo =Conexion::conectar();
		$sql_busqueda = 'SELECT * FROM tarea_entregas WHERE Tareas_idTareas = :idTarea';

		$stmt_busqueda = $pdo->prepare($sql_busqueda);
		$stmt_busqueda->bindParam(":idTarea", $datos['idTarea'], PDO::PARAM_INT);
		
		$stmt_busqueda->execute();

		if (empty($stmt_busqueda->fetchAll())) {
			$sql = "INSERT INTO tarea_entregas(Tareas_idTareas, descripcion) VALUES (:idTarea, :descripcionEntrega);";

		}else{
			$sql = "UPDATE tarea_entregas SET descripcion = :descripcionEntrega WHERE Tareas_idTareas = :idTarea;";
		}

		$sql .= "UPDATE tareas SET status_tarea=1, fecha_envio = CURRENT_TIMESTAMP WHERE idTareas = :idTarea AND Empleados_idEmpleados=:Empleados_idEmpleados;";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idTarea", $datos['idTarea'], PDO::PARAM_INT);
		$stmt->bindParam(":descripcionEntrega", $datos['descripcionEntrega'], PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['Empleados_idEmpleados'], PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt_busqueda->close();
		$stmt_busqueda = null;
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerTareas($item, $valor){
		$fechaLimite = date('Y-m-d', strtotime('-60 days'));

		if ($item == null && $valor == null) {
			$sql = "SELECT * FROM tareas ORDER BY idTareas WHERE fecha_creacion >= :fechaLimite;";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":fechaLimite", $fechaLimite);
			$stmt->execute();
			return $stmt -> fetchAll();
		}
		else{
			$sql = "SELECT * FROM tareas WHERE $item = :$item AND fecha_creacion >= :fechaLimite ORDER BY idTareas";
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->bindParam(":fechaLimite", $fechaLimite);
			$stmt->execute();
			return $stmt -> fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerDocumentosTareas($idTareas){
		$sql = "SELECT * FROM documento_tarea WHERE Tareas_idTareas = :idTareas ORDER BY idDocumentoTarea";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idTareas", $idTareas, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt -> fetchAll();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerDocumentosEntregas($idTareas){
		$sql = "SELECT * FROM documentos_tarea_entregas WHERE Tareas_idTareas = :idTareas ORDER BY idDocumentoTareaEntregas";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idTareas", $idTareas, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt -> fetchAll();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarDocumentosTareas($data){
		$pdo =Conexion::conectar();
		$sql = "INSERT INTO documento_tarea(Tareas_idTareas, tipo, nameDocumento) VALUES (:Tareas_idTareas,:tipo,:nameDocumento)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":Tareas_idTareas", $data['Tareas_idTareas'], PDO::PARAM_INT);
		$stmt->bindParam(":tipo", $data['tipo'], PDO::PARAM_STR);
		$stmt->bindParam(":nameDocumento", $data['nameDocumento'], PDO::PARAM_STR);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarDocumentosEntrega($data){
		$pdo =Conexion::conectar();
		$sql = "INSERT INTO documentos_tarea_entregas(Tareas_idTareas, tipo, nameDocumento) VALUES (:Tareas_idTareas,:tipo,:nameDocumento)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":Tareas_idTareas", $data['Tareas_idTareas'], PDO::PARAM_INT);
		$stmt->bindParam(":tipo", $data['tipo'], PDO::PARAM_STR);
		$stmt->bindParam(":nameDocumento", $data['nameDocumento'], PDO::PARAM_STR);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlFinalizarTarea($data){
		$pdo =Conexion::conectar();
		$sql = "UPDATE tareas SET opinion = :opinion, status_tarea = 2 WHERE Jefe_idEmpleados = :Jefe_idEmpleados AND idTareas = :idTarea;";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":opinion", $data['opinion'], PDO::PARAM_STR);
		$stmt->bindParam(":idTarea", $data['idTarea'], PDO::PARAM_INT);
		$stmt->bindParam(":Jefe_idEmpleados", $data['Jefe_idEmpleados'], PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlActivadoresVacantes($idDepto){
		$pdo =Conexion::conectar();
		$sql = "SELECT e.idEmpleados, d.Pertenencia FROM departamentos d
				JOIN empleados e ON e.idEmpleados = d.Empleados_idEmpleados
				WHERE e.status = 1 AND d.status = 1 AND d.idDepartamentos = :idDepto;";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idDepto", $idDepto, PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt -> fetch();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlCrearExamen($datos){
		$pdo =Conexion::conectar();
		$sql = "INSERT INTO examenes(titulo, Descripcion, tiempo_limite, fecha_inicio, fecha_fin, intentos_maximos) VALUES (:titulo, :mensaje, :tiempo_limite, :fecha_inicio, :fecha_fin, :intentos_maximos)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":titulo", $datos['titulo']);
		$stmt->bindParam(":mensaje", $datos['mensaje']);
		$stmt->bindParam(":tiempo_limite", $datos['tiempo_limite']);
		$stmt->bindParam(":fecha_inicio", $datos['fecha_inicio']);
		$stmt->bindParam(":fecha_fin", $datos['fecha_fin']);
		$stmt->bindParam(":intentos_maximos", $datos['intentos_maximos']);
		
		if ($stmt->execute()) {
			return $datos['titulo'];
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlBorrarExamen($idExamen){
		$pdo =Conexion::conectar();
		$sql = "DELETE FROM examenes WHERE idExamen = :idExamen";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idExamen", $idExamen, PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlBorrarPregunta($idPregunta){
		$pdo =Conexion::conectar();
		$sql = "DELETE FROM preguntas WHERE idPregunta = :idPregunta";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idPregunta", $idPregunta, PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarRespuesta($idRespuesta){
		$pdo =Conexion::conectar();
		$sql = "DELETE FROM respuestas WHERE idRespuesta = :idRespuesta";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idRespuesta", $idRespuesta, PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlCrearPregunta($datos){
		$pdo =Conexion::conectar();
		$sql = "INSERT INTO preguntas(pregunta, idExamen, tipo_pregunta) VALUES (:pregunta, :idExamen, :tipo_pregunta)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":pregunta", $datos['pregunta'], PDO::PARAM_STR);
		$stmt->bindParam(":idExamen", $datos['idExamen'], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_pregunta", $datos['tipo_pregunta'], PDO::PARAM_STR);
		
		if ($stmt->execute()) {
		    return $pdo->lastInsertId();
		} else {
		    return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarRespuestas($datos){
		$pdo =Conexion::conectar();
		$sql = "INSERT INTO respuestas(idPregunta, respuesta, valor) VALUES (:idPregunta, :respuesta, :valor)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idPregunta", $datos['idPregunta'], PDO::PARAM_INT);
		$stmt->bindParam(":respuesta", $datos['respuesta'], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos['valor'], PDO::PARAM_INT);
		
		if ($stmt->execute()) {
		    return 'ok';
		} else {
		    return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizarExamenes($datos){
		$pdo =Conexion::conectar();
		$sql = "UPDATE examenes SET titulo = :titulo, descripcion = :mensaje, tiempo_limite = :tiempo_limite, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, intentos_maximos = :intentos_maximos WHERE idExamen=:idExamen";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":titulo", $datos['titulo']);
		$stmt->bindParam(":mensaje", $datos['mensaje']);
		$stmt->bindParam(":tiempo_limite", $datos['tiempo_limite']);
		$stmt->bindParam(":fecha_inicio", $datos['fecha_inicio']);
		$stmt->bindParam(":fecha_fin", $datos['fecha_fin']);
		$stmt->bindParam(":intentos_maximos", $datos['intentos_maximos']);
		$stmt->bindParam(":idExamen", $datos['idExamen'],PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return $datos['titulo'];
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerEvaluaciones($item, $dato){
		$pdo =Conexion::conectar();
		if ($item == null && $dato == null) {
			$sql = "SELECT * FROM examenes";

			$stmt = $pdo->prepare($sql);
			
			$stmt->execute();
			return $stmt -> fetchAll();
		}else{
			$sql = "SELECT * FROM examenes WHERE $item = :$item";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":".$item, $dato);
			
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerPreguntas($item, $dato){
		$pdo =Conexion::conectar();
		if ($item == null && $dato == null) {
			$sql = "SELECT * FROM preguntas";

			$stmt = $pdo->prepare($sql);
			
			$stmt->execute();
			return $stmt -> fetchAll();
		}else{
			$sql = "SELECT * FROM preguntas WHERE $item = :$item";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":".$item, $dato);
			
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerPreguntasExamen($item, $dato){
		$pdo =Conexion::conectar();

		$sql = "SELECT * FROM preguntas WHERE $item = :$item";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":".$item, $dato);
		
		$stmt->execute();
		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerRespuestas($item, $dato){
		$pdo =Conexion::conectar();
		if ($item == null && $dato == null) {
			$sql = "SELECT * FROM respuestas";

			$stmt = $pdo->prepare($sql);
			
			$stmt->execute();
			return $stmt -> fetchAll();
		}else{
			$sql = "SELECT * FROM respuestas WHERE $item = :$item";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":".$item, $dato);
			
			$stmt->execute();
			return $stmt -> fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerRespuestasExamen($item, $dato){
		$pdo =Conexion::conectar();
			$sql = "SELECT * FROM respuestas WHERE $item = :$item";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":".$item, $dato);
			
			$stmt->execute();
			return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEmpleadosExamenes($dato){
		$pdo = Conexion::conectar();

		$sql = "SELECT ee.*
				FROM empleados_has_examenes ee
				JOIN examenes ex ON ee.idExamen = ex.idExamen
				JOIN empleados em ON ee.idEmpleado = em.idEmpleados
				WHERE ex.idExamen = :dato";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":dato", $dato, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerEvaluacionesEmpleados($item, $dato){
		$pdo =Conexion::conectar();
		$sql = "SELECT * FROM empleados_has_examenes WHERE $item = :$item";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":".$item, $dato, PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlIniciarExamen($datos){
		$pdo = Conexion::conectar();

		date_default_timezone_set("America/Mexico_City");
		$fecha_inicio = date("Y-m-d H:i:s");
		$sql = "UPDATE empleados_has_examenes SET fecha_inicio = :fecha_inicio WHERE idExamen = :idExamen AND idEmpleado = :idEmpleado";

		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(":fecha_inicio",$fecha_inicio, PDO::PARAM_STR);
		$stmt->bindParam(":idExamen",$datos['idExamen'], PDO::PARAM_INT);
		$stmt->bindParam(":idEmpleado",$datos['idEmpleado'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlResponderPreguntaExamen($datos){
		$pdo = Conexion::conectar();
		$sql = "INSERT INTO empleado_examen_respuesta(idEmpleado, idPregunta, respuesta, idExamen) VALUES (:idEmpleado, :idPregunta, :respuesta, :idExamen)";

		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(":idEmpleado",$datos['idEmpleado'], PDO::PARAM_INT);
		$stmt->bindParam(":idPregunta",$datos['idPregunta'], PDO::PARAM_INT);
		$stmt->bindParam(":idExamen",$datos['idExamen'], PDO::PARAM_INT);
		$stmt->bindParam(":respuesta",$datos['respuesta'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlBuscarRespuestas($datos){
		$pdo =Conexion::conectar();
		$sql = "SELECT * FROM empleado_examen_respuesta WHERE idEmpleado = :idEmpleado AND idPregunta = :idPregunta AND idExamen = :idExamen";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idEmpleado",$datos['idEmpleado'], PDO::PARAM_INT);
		$stmt->bindParam(":idPregunta",$datos['idPregunta'], PDO::PARAM_INT);
		$stmt->bindParam(":idExamen",$datos['idExamen'], PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt -> fetch();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizarPreguntaExamen($datos){
		$pdo = Conexion::conectar();
		$sql = "UPDATE empleado_examen_respuesta SET respuesta = :respuesta WHERE idEmpleado = :idEmpleado AND idPregunta = :idPregunta AND idExamen = :idExamen";

		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(":idEmpleado",$datos['idEmpleado'], PDO::PARAM_INT);
		$stmt->bindParam(":idPregunta",$datos['idPregunta'], PDO::PARAM_INT);
		$stmt->bindParam(":idExamen",$datos['idExamen'], PDO::PARAM_INT);
		$stmt->bindParam(":respuesta",$datos['respuesta'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return $datos['respuesta'];
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlBuscarEvaluacionAsignada($datos){
		$pdo =Conexion::conectar();
		$sql = "SELECT * FROM empleados_has_examenes WHERE idEmpleado = :idEmpleado AND idExamen = :idExamen";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idEmpleado",$datos['idEmpleado'], PDO::PARAM_INT);
		$stmt->bindParam(":idExamen",$datos['idExamen'], PDO::PARAM_INT);
		
		$stmt->execute();
		return $stmt -> fetch();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlTerminarExamen($datos){
		$pdo = Conexion::conectar();

		date_default_timezone_set("America/Mexico_City");
		$fecha_fin = date("Y-m-d H:i:s");
		$fecha_Inicio = $datos['fecha_inicio'];

		// Convertir las fechas a objetos DateTime
		$inicio = new DateTime($fecha_Inicio);
		$fin = new DateTime($fecha_fin);

		// Calcular la diferencia entre las fechas
		$diferencia = $inicio->diff($fin);

		// Obtener la diferencia en minutos
		$minutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;

		if ($datos['timeMax'] <= $minutos) {
			$minutos = $datos['timeMax'];
			// Sumar los minutos adicionales al objeto $inicio
		    $inicio->add(new DateInterval('PT' . $datos['timeMax'] . 'M'));
		    // Obtener la nueva fecha de fin en formato Y-m-d H:i:s
		    $fecha_fin = $inicio->format('Y-m-d H:i:s');
		}

		$sql = "UPDATE empleados_has_examenes SET fecha_fin = :fecha_fin, tiempo_utilizado = :tiempo_utilizado WHERE idEmpleados_has_Examenes = :idEmpleados_has_Examenes";

		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(":fecha_fin",$fecha_fin, PDO::PARAM_STR);
		$stmt->bindParam(":tiempo_utilizado",$minutos, PDO::PARAM_STR);
		$stmt->bindParam(":idEmpleados_has_Examenes",$datos['idExamenEmpleados'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlExamenesEmpleados($idExamen){
		$sql = "SELECT e.idEmpleados, CONCAT(e.lastname, ' ', e.name) AS nombre FROM examenes ex
				JOIN empleados_has_examenes ee ON ee.idExamen = ex.idExamen
				JOIN empleados e ON e.idEmpleados = ee.idEmpleado
				WHERE ex.idExamen = :idExamen
				ORDER BY ee.idEmpleado ASC;";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':idExamen', $idExamen, PDO::PARAM_INT);

		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlExamenesPreguntas($idExamen){
		$sql = "SELECT p.idPregunta, p.pregunta, p.tipo_pregunta FROM examenes ex
				JOIN preguntas p ON p.idExamen = ex.idExamen
				WHERE ex.idExamen = :idExamen;";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':idExamen', $idExamen, PDO::PARAM_INT);

		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEmpleadoPreguntas($idPregunta, $idEmpleado){
		$sql = "SELECT er.respuesta FROM preguntas p 
				JOIN empleado_examen_respuesta er ON er.idPregunta = p.idPregunta
				WHERE p.idPregunta = :idPregunta AND er.idEmpleado = :idEmpleado;";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':idPregunta', $idPregunta, PDO::PARAM_INT);
		$stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);

		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlAddDivisa($nameDivisa, $divisa){
		$sql = "INSERT INTO divisas (nameDivisa, divisa) VALUES (:nameDivisa, :divisa)";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':nameDivisa', $nameDivisa, PDO::PARAM_STR);
		$stmt->bindParam(':divisa', $divisa, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			return 'error';
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerDivisa($item, $value){
		$pdo = Conexion::conectar();
		if ($item == null && $value == null) {
			$sql = "SELECT * FROM divisas";

			$stmt = $pdo->prepare($sql);

			$stmt->execute();
			return $stmt->fetchAll();

		}else{
			$sql = "SELECT * FROM divisas WHERE $item = :item";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':item', $value, PDO::PARAM_INT); // Ajusta el enlace del parámetro aquí

			$stmt->execute();
			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlDelDivisa($idDivisa){
		$pdo =Conexion::conectar();
		$sql = "DELETE FROM divisas WHERE idDivisa = :idDivisa";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idDivisa", $idDivisa, PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlAddCategoria($nameCategoria){
		$sql = "INSERT INTO categorias_gastos (nameCategoria) VALUES (:nameCategoria)";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':nameCategoria', $nameCategoria, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			return 'error';
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerCategoria($item, $value){
		$pdo = Conexion::conectar();
		if ($item == null && $value == null) {
			$sql = "SELECT * FROM categorias_gastos";

			$stmt = $pdo->prepare($sql);

			$stmt->execute();
			return $stmt->fetchAll();

		}else{
			$sql = "SELECT * FROM categorias_gastos WHERE $item = :$item";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':'.$item, $value);

			$stmt->execute();
			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlDelCategoria($idCategoria){
		$pdo =Conexion::conectar();
		$sql = "DELETE FROM categorias_gastos WHERE idCategoria = :idCategoria";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlAddGasto($datos){
		$pdo =Conexion::conectar();
		$sql = "INSERT INTO gastos(categoria, nameVendedor, divisa, importeTotal, importeIVA, fechaDocumento, descripcionGasto, referenciaInterna) VALUES (:categoria,:nameVendedor,:divisa,:importeTotal,:importeIVA,:fechaDocumento,:descripcionGasto,:referenciaInterna)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':categoria', $datos['categoria'], PDO::PARAM_INT);
		$stmt->bindParam(':nameVendedor', $datos['nameVendedor'], PDO::PARAM_STR);
		$stmt->bindParam(':divisa', $datos['divisa'], PDO::PARAM_INT);
		$stmt->bindParam(':importeTotal', $datos['importeTotal'], PDO::PARAM_STR);
		$stmt->bindParam(':importeIVA', $datos['importeIVA'], PDO::PARAM_STR);
		$stmt->bindParam(':fechaDocumento', $datos['fechaDocumento'], PDO::PARAM_STR);
		$stmt->bindParam(':descripcionGasto', $datos['descripcionGasto'], PDO::PARAM_STR);
		$stmt->bindParam(':referenciaInterna', $datos['referenciaInterna'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return $pdo->lastInsertId();

		}else{
			return 'error';
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlRegistrarDocumentosGastos($datos){
		$pdo =Conexion::conectar();
		$sql = "INSERT INTO documentos_gastos(Gastos_idGastos, tipo, nameDocumento) VALUES (:Gastos_idGastos,:tipo,:nameDocumento)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':Gastos_idGastos', $datos['Gastos_idGastos'], PDO::PARAM_INT);
		$stmt->bindParam(':tipo', $datos['tipo'], PDO::PARAM_STR);
		$stmt->bindParam(':nameDocumento', $datos['nameDocumento'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok"; //obtener el ID del empleado recién insertado
		}else{
			return 'error';
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerGastos($item, $valor){
		$pdo =Conexion::conectar();
		if ($item == null && $valor == null) {
			$sql = "SELECT * FROM gastos ORDER BY idGastos ASC";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}else{
			$sql = "SELECT * FROM gastos WHERE $item = :$item";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':'.$item, $valor);
			$stmt->execute();
			return $stmt->fetch();
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerDocGastos($item, $valor){
		$pdo =Conexion::conectar();
		if ($item == null && $valor == null) {
			$sql = "SELECT * FROM documentos_gastos ORDER BY idDocumento_Gasto ASC";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}else{
			$sql = "SELECT * FROM documentos_gastos WHERE $item = :$item";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':'.$item, $valor);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlDelGastos($idGastos){
		$pdo =Conexion::conectar();
		$sql = "DELETE FROM gastos WHERE idGastos = :idGastos";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idGastos", $idGastos, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlUpdateGasto($datos){
		$pdo = Conexion::conectar();
		$sql = "UPDATE gastos SET categoria = :categoria, nameVendedor = :nameVendedor, divisa = :divisa, importeTotal = :importeTotal, importeIVA = :importeIVA, fechaDocumento = :fechaDocumento, descripcionGasto = :descripcionGasto, referenciaInterna = :referenciaInterna WHERE idGastos = :idGastos";
		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(':categoria', $datos['categoria'], PDO::PARAM_INT);
		$stmt->bindParam(':nameVendedor', $datos['nameVendedor'], PDO::PARAM_STR);
		$stmt->bindParam(':divisa', $datos['divisa'], PDO::PARAM_INT);
		$stmt->bindParam(':importeTotal', $datos['importeTotal'], PDO::PARAM_STR);
		$stmt->bindParam(':importeIVA', $datos['importeIVA'], PDO::PARAM_STR);
		$stmt->bindParam(':fechaDocumento', $datos['fechaDocumento'], PDO::PARAM_STR);
		$stmt->bindParam(':descripcionGasto', $datos['descripcionGasto'], PDO::PARAM_STR);
		$stmt->bindParam(':referenciaInterna', $datos['referenciaInterna'], PDO::PARAM_STR);
		$stmt->bindParam(':idGastos', $datos['idGastos'], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlDelDocGasto($idDocumento_Gasto){
		$pdo =Conexion::conectar();
		$sql = "DELETE FROM documentos_gastos WHERE idDocumento_Gasto = :idDocumento_Gasto";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":idDocumento_Gasto", $idDocumento_Gasto, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return 'ok';
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	/*---------- Fin de ModeloFormularios ---------- */
}