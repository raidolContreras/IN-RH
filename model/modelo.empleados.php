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
		$stmt->bindParam(":parentesco", $datos['telefonoE'],PDO::PARAM_STR);
		$stmt->bindParam(":phoneEmer", $datos['parentesco'],PDO::PARAM_STR);
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
		$sql = "UPDATE puesto SET namePuesto=:namePuesto, salario=:salarioPuesto, salario_integrado=:salario_integrado, Departamentos_idDepartamentos=:Departamentos_idDepartamentos, horario_entrada=:horario_entrada, horario_salida=:horario_salida WHERE Empleados_idEmpleados=:Empleados_idEmpleados";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":namePuesto", $datos['namePuesto'],PDO::PARAM_STR);
		$stmt->bindParam(":salarioPuesto", $datos['salarioPuesto'],PDO::PARAM_STR);
		$stmt->bindParam(":salario_integrado", $datos['salario_integrado'],PDO::PARAM_STR);
		$stmt->bindParam(":horario_entrada", $datos['horario_entrada'],PDO::PARAM_STR);
		$stmt->bindParam(":horario_salida", $datos['horario_salida'],PDO::PARAM_STR);
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


}