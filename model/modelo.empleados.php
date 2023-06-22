<?php 

require_once "conexion.php";

class ModeloEmpleados{

	static public function mdlActualizarEmpleado($tabla, $datos){
		$sql = "UPDATE empleados SET name=:name, lastname=:lastname, genero=:genero, fNac=:fNac, phone=:phone, email=:email, identificacion=:identificacion, CURP=:CURP, NSS=:NSS, RFC=:RFC, street=:street, numE=:numE, numI=:numI, colonia=:colonia, CP=:CP, municipio=:municipio, estado=:estado WHERE idEmpleados =:idEmpleados";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":name", $datos['nombre'],PDO::PARAM_STR);
		$stmt->bindParam(":lastname", $datos['apellidos'],PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos['genero'],PDO::PARAM_STR);
		$stmt->bindParam(":fNac", $datos['fecha_nacimiento'],PDO::PARAM_STR);
		$stmt->bindParam(":phone", $datos['telefono'],PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos['email'],PDO::PARAM_STR);
		$stmt->bindParam(":identificacion", $datos['num_identificacion'],PDO::PARAM_STR);
		$stmt->bindParam(":CURP", $datos['curp'],PDO::PARAM_STR);
		$stmt->bindParam(":NSS", $datos['num_seguro_social'],PDO::PARAM_STR);
		$stmt->bindParam(":RFC", $datos['rfc'],PDO::PARAM_STR);
		$stmt->bindParam(":street", $datos['calle'],PDO::PARAM_STR);
		$stmt->bindParam(":numE", $datos['num_exterior'],PDO::PARAM_STR);
		$stmt->bindParam(":numI", $datos['num_interior'],PDO::PARAM_STR);
		$stmt->bindParam(":colonia", $datos['colonia'],PDO::PARAM_STR);
		$stmt->bindParam(":CP", $datos['cp'],PDO::PARAM_STR);
		$stmt->bindParam(":municipio", $datos['municipio'],PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos['estado'],PDO::PARAM_STR);
		$stmt->bindParam(":idEmpleados", $datos['idEmpleados'],PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';		
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizarEmergencia($tabla, $datos){
		$sql = "UPDATE emergencia SET nameEmer=:nameEmer ,parentesco=:parentesco ,phoneEmer=:phoneEmer WHERE Empleados_idEmpleados=:Empleados_idEmpleados ";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":nameEmer", $datos['emergencia'],PDO::PARAM_STR);
		$stmt->bindParam(":parentesco", $datos['parentesco'],PDO::PARAM_STR);
		$stmt->bindParam(":phoneEmer", $datos['telefonoE'],PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['idEmpleados'],PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';		
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizarPuesto($tabla, $datos){
		$sql = "UPDATE puesto SET namePuesto=:namePuesto, salario=:salarioPuesto, salario_integrado=:salario_integrado, Departamentos_idDepartamentos=:Departamentos_idDepartamentos WHERE Empleados_idEmpleados=:Empleados_idEmpleados";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":namePuesto", $datos['namePuesto'],PDO::PARAM_STR);
		$stmt->bindParam(":salarioPuesto", $datos['salarioPuesto'],PDO::PARAM_STR);
		$stmt->bindParam(":salario_integrado", $datos['salario_integrado'],PDO::PARAM_STR);
		$stmt->bindParam(":Departamentos_idDepartamentos", $datos['Departamentos_idDepartamentos'],PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['Empleados_idEmpleados'],PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';		
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizarjefatura($tabla, $datos){

		$sql = "UPDATE $tabla SET Empleados_idEmpleados = :idEmpleados WHERE idDepartamentos = :idDepartamentos";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":idEmpleados", $datos['idEmpleados'],PDO::PARAM_INT);
		$stmt->bindParam(":idDepartamentos", $datos['idDepartamentos'],PDO::PARAM_INT);
		
		if ($stmt->execute()) {
			return 'ok';		
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;

	}

	static public function mdlFechaNacimiento($tabla){
		$sql = "SELECT *
				FROM $tabla e
				LEFT JOIN foto_empleado fe ON e.idEmpleados = fe.Empleados_idEmpleados
				WHERE DATE_FORMAT(e.fNac, '%m-%d')
				  BETWEEN DATE_FORMAT(CURDATE(), '%m-%d')
				  AND DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 30 DAY), '%m-%d')
				  AND e.status = 1
				ORDER BY DAY(e.fNac)";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlFechaAniversario($tabla){
		$sql = "SELECT *
				FROM $tabla e
				LEFT JOIN foto_empleado fe ON e.idEmpleados = fe.Empleados_idEmpleados
				WHERE YEAR(e.fecha_contratado) < YEAR(CURDATE())
				  AND MONTH(e.fecha_contratado) = MONTH(CURDATE())
				  AND e.status = 1";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlCambioPassword($tabla,$data){

		$sql = "UPDATE $tabla SET password=:password, cambio_password=1 WHERE idEmpleados = :idEmpleados";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":password", $data['password'], PDO::PARAM_STR);
		$stmt->bindParam(":idEmpleados", $data['idEmpleados'], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			return 'Error';
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlVerEmpleadosDeptos($departamento){
		$sql = "SELECT * FROM empleados e
				LEFT JOIN puesto p ON p.Empleados_idEmpleados = e.idEmpleados
				LEFT JOIN departamentos d ON p.Departamentos_idDepartamentos = d.idDepartamentos
				WHERE d.idDepartamentos = :idDepartamentos AND e.status = 1";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idDepartamentos", $departamento, PDO::PARAM_INT);

		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlCambioPasswordOlvidado($tabla,$item,$valor){
		$sql = "SELECT * FROM $tabla WHERE $item = :$item";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		
		$stmt->close();
		$stmt = null;
	}

	static public function mdlBorrarSolicitud($tabla,$id){
		$sql = "DELETE FROM $tabla WHERE idSolicitudPassword =:idSolicitudPassword";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idSolicitudPassword", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		}else{
			return 'Error';
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarEmpleado($tabla, $datos){

		$sql = "UPDATE $tabla SET status = 0, fecha_baja = :fecha_baja WHERE idEmpleados = :idEmpleados";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idEmpleados", $datos['idEmpleados'], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_baja", $datos['fecha_baja'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			$eliminarPuesto = ModeloEmpleados::mdlEliminarPuesto("puesto", $datos['idEmpleados']);
			if ($eliminarPuesto == "ok") {
				return "ok";
			}
		} else {
			print_r(Conexion::conectar()->errorInfo()); 
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarPuesto($tabla, $idEmpleados){

		$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $idEmpleados);
		$tablaVacantes = "vacantes";
		$data = array(
			"nameVacante" => $puesto['namePuesto'],
			"salarioVacante" => $puesto['salario'],
			"Departamentos_idDepartamentos" => $puesto['Departamentos_idDepartamentos'],
			"requisitos" => "Nueva Vacante"
		);

		$sql = "UPDATE $tabla SET status = 0 WHERE idPuesto = :idPuesto";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idPuesto", $puesto['idPuesto'], PDO::PARAM_INT);
			
		if ($stmt->execute()) {
			$quitarJefatura = ControladorFormularios::ctrVerDepartamentos("Empleados_idEmpleados", $idEmpleados);
			if ($quitarJefatura !== false) {
				$datosDepto = array(
					"idDepartamentos" => $quitarJefatura['idDepartamentos'],
					"idEmpleados" => NULL
				);
				$updateDataDepto = ModeloEmpleados::mdlActualizarjefatura('departamentos', $datosDepto);
					if ($updateDataDepto == 'ok') {
						$registro = ModeloFormularios::mdlRegistrarVacantes($tablaVacantes,$data);
						return $registro;
					}else{
						print_r(Conexion::conectar()->errorInfo());
					}
			}else{
				$registro = ModeloFormularios::mdlRegistrarVacantes($tablaVacantes,$data);
				return $registro;
			}
		} else {
			print_r(Conexion::conectar()->errorInfo()); 
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerEmpleadosHorariosDHorarios($tabla, $item, $valor){
		if ($item != "h.default") {
			$sql = "SELECT dh.dia_Laborable, dh.numero_Horas, dh.hora_Entrada, dh.hora_Salida
					FROM $tabla e
					RIGHT JOIN empleados_has_horarios eh ON e.idEmpleados = eh.Empleados_idEmpleados
					RIGHT JOIN horarios h ON eh.Horarios_idHorarios = h.idHorarios
					RIGHT JOIN dia_horario dh ON h.idHorarios = dh.Horarios_idHorarios
					WHERE $item = :valor"; 
		}else{
			$sql = "SELECT dh.dia_Laborable, dh.numero_Horas, dh.hora_Entrada, dh.hora_Salida
					FROM horarios h
					RIGHT JOIN dia_horario dh ON h.idHorarios = dh.Horarios_idHorarios
					WHERE $item = :valor"; 

		}

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR); // Modificación en esta línea
		$stmt->execute();

		return $stmt; // No usar fetchAll() aquí, devolver el statement completo
	}

	static public function mdlEquipoDeTrabajo($tabla, $item,$pertenece){
		if ($pertenece == null) {
			$sql = "SELECT CONCAT( e.lastname, ' ', e.name) As Nombre, e.idEmpleados, d.Empleados_idEmpleados AS jefeDepa, f.namePhoto, e.genero, d.nameDepto AS Depto, p.namePuesto AS Puesto, CONCAT( ep.lastname, ' ', ep.name) AS NombrePertenencia, fp.namePhoto AS fotoPertenencia, dp.nameDepto AS Pertenencia, d.idDepartamentos AS depto, d.Pertenencia AS idPertenencia
					FROM $tabla e
					LEFT JOIN foto_empleado f ON f.Empleados_idEmpleados = e.idEmpleados
					JOIN puesto p ON p.Empleados_idEmpleados = e.idEmpleados
					JOIN departamentos d ON d.idDepartamentos = p.Departamentos_idDepartamentos
					LEFT JOIN departamentos dp ON dp.idDepartamentos = d.Pertenencia
					LEFT JOIN empleados ep ON dp.Empleados_idEmpleados = ep.idEmpleados
					LEFT JOIN foto_empleado fp ON fp.Empleados_idEmpleados = ep.idEmpleados
					WHERE d.idDepartamentos = :idDepartamentos
					ORDER BY Nombre ASC;"; 
		}else{
			$sql = "SELECT CONCAT( e.lastname, ' ', e.name) As Nombre, e.idEmpleados, d.Empleados_idEmpleados AS jefeDepa, f.namePhoto, e.genero, d.nameDepto AS Depto, p.namePuesto AS Puesto, CONCAT( ep.lastname, ' ', ep.name) AS NombrePertenencia, fp.namePhoto AS fotoPertenencia, dp.nameDepto AS Pertenencia, d.idDepartamentos AS depto
					FROM $tabla e
					LEFT JOIN foto_empleado f ON f.Empleados_idEmpleados = e.idEmpleados
					JOIN puesto p ON p.Empleados_idEmpleados = e.idEmpleados
					JOIN departamentos d ON d.idDepartamentos = p.Departamentos_idDepartamentos
					LEFT JOIN departamentos dp ON dp.idDepartamentos = d.Pertenencia
					LEFT JOIN empleados ep ON dp.Empleados_idEmpleados = ep.idEmpleados
					LEFT JOIN foto_empleado fp ON fp.Empleados_idEmpleados = ep.idEmpleados
					WHERE d.Pertenencia = :idDepartamentos
					ORDER BY Nombre ASC;"; 
		}

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idDepartamentos", $item, PDO::PARAM_INT); // Modificación en esta línea
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlAsustenciasJustificantes($tabla, $item, $valor){
		$sql = "SELECT *
				FROM $tabla a
				LEFT JOIN justificantes j ON j.Asistencias_idAsistencias = a.idAsistencias
				WHERE $item = :idEmpleados
				AND MONTH(a.fecha_asistencia) = MONTH(CURRENT_DATE());";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idEmpleados", $valor, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlDiasFestivos($tabla){
		$sql = "SELECT * FROM $tabla";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlAsistenciasMes($idEmpleados, $mes){
		$sql = "SELECT *
				FROM asistencias a
				LEFT JOIN justificantes j ON j.Asistencias_idAsistencias = a.idAsistencias
				WHERE a.Empleados_idEmpleados = :idEmpleados
				AND MONTH(a.fecha_asistencia) = :mes";

		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":idEmpleados", $valor, PDO::PARAM_INT);
		$stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}
}
