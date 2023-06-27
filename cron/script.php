<?php
require_once "../model/conexion.php";
$sql = "UPDATE vacaciones v
		INNER JOIN empleados e ON v.Empleados_idEmpleados = e.idEmpleados
		SET v.status_vacaciones = 2
		WHERE DATE_FORMAT(e.fecha_contratado, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d')
		AND v.status_vacaciones = 1;";

$stmt = Conexion::conectar()->prepare($sql);
$stmt->execute();
$stmt->closeCursor();
$stmt = null;
