<?php

require_once "conexion.php";

class ModeloFormularios{
	

/*---------- Función Hecha para registrar a los empleados---------- */

	static public function mdlRegistrarEmpleados($tabla1, $table2, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla1(name, lastname, genero, fNac, phone, email, identificacion, NSS, RFC, street, numE, numI, colonia, CP, estado, pais) VALUES (:nombre, :apellidos, :genero, :fecha_nacimiento, :telefono, :email, :num_identificacion, :num_seguro_social, :rfc, :calle, :num_exterior, :num_interior, :colonia, :cp, :municipio, :estado)");

		$stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(':apellidos', $datos['apellidos'], PDO::PARAM_STR);
		$stmt->bindParam(':genero', $datos['genero'], PDO::PARAM_STR);
		$stmt->bindParam(':fecha_nacimiento', $datos['fecha_nacimiento'], PDO::PARAM_STR);
		$stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_INT);
		$stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
		$stmt->bindParam(':num_identificacion', $datos['num_identificacion'], PDO::PARAM_STR);
		$stmt->bindParam(':num_seguro_social', $datos['num_seguro_social'], PDO::PARAM_INT);
		$stmt->bindParam(':rfc', $datos['rfc'], PDO::PARAM_STR);
		$stmt->bindParam(':calle', $datos['calle'], PDO::PARAM_STR);
		$stmt->bindParam(':num_exterior', $datos['num_exterior'], PDO::PARAM_STR);
		$stmt->bindParam(':num_interior', $datos['num_interior'], PDO::PARAM_STR);
		$stmt->bindParam(':colonia', $datos['colonia'], PDO::PARAM_STR);
		$stmt->bindParam(':cp', $datos['cp'], PDO::PARAM_INT);
		$stmt->bindParam(':municipio', $datos['municipio'], PDO::PARAM_STR);
		$stmt->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;

		}


/*---------- Fin de ModeloFormularios ---------- */
}