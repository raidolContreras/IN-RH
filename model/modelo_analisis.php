<?php 

require_once "conexion.php";

class ModeloAnalisis{

	static public function vacaciones(){

		$sql = "SELECT CONCAT(e.lastname, ' ', e.name) AS nombre, v.fecha_inicio_vacaciones, v.fecha_fin_vacaciones, v.fecha_solicitud,
				       CASE WHEN v.respuesta = 1 THEN 'Aprobado' WHEN v.respuesta = 2 THEN 'Rechazado' ELSE 'Pendiente' END AS Estado
				FROM vacaciones v
				INNER JOIN empleados e ON v.Empleados_idEmpleados = e.idEmpleados";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}
	
}