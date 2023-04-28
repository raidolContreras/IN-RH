<?php

require_once "conexion.php";

class ModeloFormularios{


/*---------- Función hecha para registrar a los empleados---------- */

static public function mdlRegistrarEmpleados($tabla1, $table2, $datos){

	$pdo=Conexion::conectar();

	$stmt = $pdo->prepare("INSERT INTO $tabla1(name, lastname, genero, fNac, phone, email, identificacion, CURP, NSS, RFC, street, numE, numI, colonia, CP, municipio, estado) VALUES (:nombre, :apellidos, :genero, :fecha_nacimiento, :telefono, :email, :num_identificacion, :curp, :num_seguro_social, :rfc, :calle, :num_exterior, :num_interior, :colonia, :cp, :municipio, :estado)");

	$stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
	$stmt->bindParam(':apellidos', $datos['apellidos'], PDO::PARAM_STR);
	$stmt->bindParam(':genero', $datos['genero'], PDO::PARAM_STR);
	$stmt->bindParam(':fecha_nacimiento', $datos['fecha_nacimiento'], PDO::PARAM_STR);
	$stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_INT);
	$stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
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


	if($stmt->execute()){

	$id_empleado = $pdo->lastInsertId(); //obtener el ID del empleado recién insertado

	if ($id_empleado == 0) {
		echo $consulta->errorInfo()[2];
	}else{
		$Registro = ModeloFormularios::mdlEmergencia($table2, $id_empleado, $datos);
	}


	return "ok";

	}else{

		print_r(Conexion::conectar()->errorInfo());

	}

	$stmt->close();

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

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;

	}

	static public function mdlRegistrarHistorial($tabla, $datos, $idEmpleado){
		if ($datos['noResponder'] == 0) {
			$salario = $datos['salario'];
		}else{
			$salario = null;
		}

		if ($datos['trabajo_actual'] == 0) {
			$fecha_fin = $datos['fecha_fin'];
		}else{
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
			}else{
				return 'terminar';
			}

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;
	}

	/*---------- Función hecha para ver a los empleados---------- */

	static public function mdlVerEmpleados($tabla, $item, $valor){

		if($item == null && $valor == null){

			$sql = "SELECT e.idEmpleados, e.name, e.lastname, e.genero, e.fNac, e.phone, e.email, e.identificacion, e.NSS, e.RFC, e.street, e.numE, e.numI, e.colonia, e.CP, e.estado, e.municipio, e.fecha_contratado, m.nameEmer, m.parentesco, m.phoneEmer 
			FROM empleados e 
			INNER JOIN emergencia m ON e.idEmpleados = m.Empleados_idEmpleados WHERE status = 1 ORDER BY idEmpleados DESC;";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT e.idEmpleados, e.name, e.lastname, e.genero, e.fNac, e.phone, e.email, e.identificacion, e.NSS, e.RFC, e.street, e.numE, e.numI, e.colonia, e.CP, e.estado, e.municipio, e.fecha_contratado, m.nameEmer, m.parentesco, m.phoneEmer 
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
	if($length == 10){ // Formato de 10 digitos
		$number = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $number);
	}elseif($length == 11){ // Formato de 11 digitos (con codigo de pais)
		$number = preg_replace('/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/', '+$1 ($2) $3-$4', $number);
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

	static public function mdlEliminarEmpleado($tabla, $idEmpleado){

		$sql = "UPDATE $tabla SET status = 0 WHERE idEmpleados=$idEmpleado";

		$stmt = Conexion::conectar()->prepare($sql);

		if ($stmt->execute()) {

			return 'ok';

		}else{
			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;

	}

	/*---------- Función hecha para Registrar las fotos de Empleados---------- */
	static public function mdlRegistroFotoEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (namePhoto, Empleados_idEmpleados) VALUES (:imageName, :idEmpleado)");

		$stmt->bindParam(":imageName", $datos["imageName"], PDO::PARAM_STR);
		$stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
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

		}else{

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
		} else {
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
	$div2 .= '<button type="submit" class="btn btn-secondary rounded btn-block">Enviar</button>';
	$div2 .= '</div>';
	$div2 .= '</div>';
	$div2 .= '</form>';

		if ($validar == 1) {
			return $div;
		}else{
			return $div2;
		}

	}

	static public function mdlRegistrarDeptos($tabla, $datos){

		$sql = "INSERT INTO $tabla(nameDepto, Empleados_idEmpleados) VALUES (:nameDepto, :Empleados_idEmpleados)";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":nameDepto", $datos['name'], PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['idEmpleado'], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}

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

	static public function mdlActualizarDepto($tabla, $datos){

		$sql = "UPDATE $tabla SET nameDepto=:nameDepto ,Empleados_idEmpleados=:Empleados_idEmpleados WHERE idDepartamentos = :idDepartamentos";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":nameDepto", $datos['name'], PDO::PARAM_STR);
		$stmt->bindParam(":description", $datos['description'], PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['idEmpleado'], PDO::PARAM_INT);
		$stmt->bindParam(":idDepartamentos", $datos['idDepto'], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}

	}
	
	static public function mdlEliminarDepto($tabla, $idDepto){

		$sql = "UPDATE $tabla SET status=0, Empleados_idEmpleados=0 WHERE idDepartamentos = :idDepartamentos";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":idDepartamentos", $idDepto, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}

	}
	static public function mdlRegistrarPuestos($tabla, $datos){
		$sql = "INSERT INTO $tabla(namePuesto, salario, salario_integrado, Empleados_idEmpleados, Departamentos_idDepartamentos, horario_entrada, horario_salida) VALUES (:namePuesto, :salario, :salario_integrado, :Empleados_idEmpleados, :Departamentos_idDepartamentos, :horario_entrada, :horario_salida)";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":namePuesto", $datos['namePuesto'], PDO::PARAM_STR);
		$stmt->bindParam(":salario", $datos['salario'], PDO::PARAM_STR);
		$stmt->bindParam(":salario_integrado", $datos['salario_integrado'], PDO::PARAM_STR);
		$stmt->bindParam(":Empleados_idEmpleados", $datos['Empleados_idEmpleados'], PDO::PARAM_STR);
		$stmt->bindParam(":Departamentos_idDepartamentos", $datos['Departamentos_idDepartamentos'], PDO::PARAM_STR);
		$stmt->bindParam(":horario_entrada", $datos['horario_entrada'], PDO::PARAM_STR);
		$stmt->bindParam(":horario_salida", $datos['horario_salida'], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';

		}else{
			print_r(Conexion::conectar()->errorInfo());

		}
	}

	/*---------- Función hecha para ver a los empleados---------- */

	static public function mdlVerPuestos($tabla, $item, $valor){

		if ($item == null && $valor == null) {
			$sql = "SELECT * FROM puesto 
			JOIN empleados ON empleados.idEmpleados = puesto.Empleados_idEmpleados 
			JOIN departamentos ON puesto.Departamentos_idDepartamentos = departamentos.idDepartamentos 
			WHERE empleados.status = 1;";

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

	/*---------- Fin de ModeloFormularios ---------- */

}