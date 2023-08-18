<?php 

require_once "conexion.php";

class ModeloAnalisis{

	static public function vacaciones(){

		$sql = "SELECT CONCAT(e.lastname, ' ', e.name) AS nombre, v.fecha_inicio_vacaciones, v.fecha_fin_vacaciones, v.fecha_solicitud,
				       CASE WHEN v.respuesta = 1 THEN 'Aprobado' WHEN v.respuesta = 2 THEN 'Rechazado' ELSE 'Pendiente' END AS Estado
				FROM vacaciones v
				INNER JOIN empleados e ON v.Empleados_idEmpleados = e.idEmpleados 
				WHERE v.status_vacaciones = 1";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function permisos(){

		$sql = "SELECT
				    CONCAT(e.lastname, ' ', e.name) AS nombre,
				    DATE_FORMAT(ep.fechaPermiso, '%Y/%m/%d') AS FechaPermiso,
				    DATE_FORMAT(ep.fechaFin, '%Y/%m/%d') AS FechaFin,
				    p.namePermisos AS TipoPermiso,
				    ep.descripcion AS Descripcion,
				    CASE
				        WHEN ep.statusPermiso IS NULL THEN 'Pendiente'
				        WHEN ep.statusPermiso = 1 THEN 'Aprobado'
				        WHEN ep.statusPermiso = 2 THEN 'Rechazado'
				    END AS EstadoPermiso,
				    DATE_FORMAT(ep.fechaSolicitud, '%d/%m/%Y %H:%i:%s') AS FechaHoraSolicitud,
				    IFNULL((SELECT name FROM empleados WHERE idEmpleados = ehp.Empleados_idEmpleados), '') AS EmpleadoAprobador
				FROM
				    empleados_has_permisos ep
				INNER JOIN
				    empleados e ON ep.Empleados_idEmpleados = e.idEmpleados
				INNER JOIN
				    permisos p ON ep.Permisos_idPermisos = p.idPermisos
				LEFT JOIN
				    empleados_has_permisos ehp ON ep.idEm_has_Per = ehp.idEm_has_Per  
				";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function empleados(){

		$sql = "SELECT
				    CONCAT(e.lastname, ' ', e.name) AS nombre,
				    CASE e.genero
				        WHEN '1' THEN 'Masculino'
				        WHEN '0' THEN 'Femenino'
				        ELSE 'No binario'
				    END AS Género,
				    DATE_FORMAT(e.fNac, '%d/%m/%Y') AS Fecha_de_Nacimiento,
				    e.phone AS Teléfono,
				    p.salario AS Salario,
				    p.namePuesto AS Puesto,
				    d.nameDepto AS Departamento,
				    em.nombre_razon_social AS Empresa,
				    TIMESTAMPDIFF(YEAR, e.fecha_contratado, CURDATE()) AS Años_Trabajados,
				    DATE_FORMAT(e.fecha_contratado, '%d/%m/%Y') AS Fecha_de_Ingreso
				FROM empleados e
				LEFT JOIN puesto p ON p.Empleados_idEmpleados = e.idEmpleados
				LEFT JOIN departamentos d ON p.Departamentos_idDepartamentos = d.idDepartamentos
				LEFT JOIN empresas em ON d.Empresas_idEmpresas = em.idEmpresas
				WHERE e.status = 1;
				";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function genero(){

		$sql = "SELECT
				    em.nombre_razon_social AS Empresa,
				    CASE e.genero
				        WHEN '1' THEN 'Masculino'
				        WHEN '0' THEN 'Femenino'
				        ELSE 'No binario'
				    END AS Género,
				    COUNT(e.idEmpleados) AS Total_de_Empleados
				FROM empresas em
				LEFT JOIN departamentos d ON em.idEmpresas = d.Empresas_idEmpresas
				LEFT JOIN puesto p ON d.idDepartamentos = p.Departamentos_idDepartamentos
				LEFT JOIN empleados e ON p.Empleados_idEmpleados = e.idEmpleados AND e.status = 1
				WHERE e.genero IN ('1', '0')
				GROUP BY em.idEmpresas, em.nombre_razon_social, Género;
				";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}
	
}