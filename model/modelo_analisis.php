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

	static public function edad(){

		$sql = "SELECT
					em.nombre_razon_social AS Empresa,
					SUM(CASE WHEN TIMESTAMPDIFF(YEAR, e.fNac, CURDATE()) < 18 THEN 1 ELSE 0 END) AS Menores_de_18,
					SUM(CASE WHEN TIMESTAMPDIFF(YEAR, e.fNac, CURDATE()) BETWEEN 18 AND 25 THEN 1 ELSE 0 END) AS Edad_18_25,
					SUM(CASE WHEN TIMESTAMPDIFF(YEAR, e.fNac, CURDATE()) BETWEEN 26 AND 35 THEN 1 ELSE 0 END) AS Edad_26_35,
					SUM(CASE WHEN TIMESTAMPDIFF(YEAR, e.fNac, CURDATE()) BETWEEN 36 AND 45 THEN 1 ELSE 0 END) AS Edad_36_45,
					SUM(CASE WHEN TIMESTAMPDIFF(YEAR, e.fNac, CURDATE()) BETWEEN 46 AND 55 THEN 1 ELSE 0 END) AS Edad_46_55,
					SUM(CASE WHEN TIMESTAMPDIFF(YEAR, e.fNac, CURDATE()) > 55 THEN 1 ELSE 0 END) AS Edad_55_Plus
				FROM empresas em
				LEFT JOIN departamentos d ON em.idEmpresas = d.Empresas_idEmpresas
				LEFT JOIN puesto p ON d.idDepartamentos = p.Departamentos_idDepartamentos
				LEFT JOIN empleados e ON p.Empleados_idEmpleados = e.idEmpleados AND e.status = 1
				GROUP BY em.idEmpresas, em.nombre_razon_social;
				";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function empleadosGasto(){

		$sql = "SELECT
					e.idEmpleados,
				    CONCAT(e.lastname, ' ', e.name) AS nombre,
				    COUNT(g.idGastos) AS Numero_de_Gastos
				FROM empleados e
				INNER JOIN gastos g ON e.idEmpleados = g.Empleados_idEmpleados
				WHERE e.status = 1
				GROUP BY e.idEmpleados, e.name, e.lastname;
				";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function gasto($idEmpleados){

		if ($idEmpleados == null) {

			$sql = "SELECT
						CONCAT(e.lastname, ' ', e.name) AS nombre,
						g.descripcionGasto AS Descripción,
						g.nameVendedor AS Vendedor,
						d.divisa AS Divisa,
						tg.nameCategoria AS Tipo_de_Gasto,
						CASE g.status
							WHEN 0 THEN 'Pendiente'
							WHEN 1 THEN 'Aprobado'
							WHEN 2 THEN 'Rechazado'
							WHEN 3 THEN 'Pagado'
							ELSE 'Desconocido'
						END AS Status,
						SUM(g.importeTotal) AS Total_de_Gastos
					FROM empleados e
					LEFT JOIN gastos g ON e.idEmpleados = g.Empleados_idEmpleados
					LEFT JOIN divisas d ON g.divisa = d.idDivisa
					LEFT JOIN categorias_gastos tg ON g.categoria = tg.idCategoria
					WHERE e.status = 1
						AND YEAR(g.fechaDocumento) = YEAR(CURDATE())
						AND MONTH(g.fechaDocumento) = MONTH(CURDATE())
					GROUP BY e.idEmpleados, e.name, e.lastname, g.descripcionGasto, g.nameVendedor, d.nameDivisa, tg.nameCategoria, g.status;
					";

		}else{

			$sql = "SELECT
						CONCAT(e.lastname, ' ', e.name) AS nombre,
					    g.descripcionGasto AS Descripción,
					    g.nameVendedor AS Vendedor,
					    d.divisa AS Divisa,
					    tg.nameCategoria AS Tipo_de_Gasto,
					    CASE g.status
					        WHEN 0 THEN 'Pendiente'
					        WHEN 1 THEN 'Aprobado'
					        WHEN 2 THEN 'Rechazado'
					        WHEN 3 THEN 'Pagado'
					        ELSE 'Desconocido'
					    END AS Status,
					    SUM(g.importeTotal) AS Total_de_Gastos
					FROM empleados e
					LEFT JOIN gastos g ON e.idEmpleados = g.Empleados_idEmpleados
					LEFT JOIN divisas d ON g.divisa = d.idDivisa
					LEFT JOIN categorias_gastos tg ON g.categoria = tg.idCategoria
					WHERE e.status = 1
					    AND e.idEmpleados = $idEmpleados -- Reemplaza <ID_DEL_EMPLEADO> con el ID del empleado deseado
					    AND YEAR(g.fechaDocumento) = YEAR(CURDATE())
					GROUP BY e.idEmpleados, e.name, e.lastname, g.descripcionGasto, g.nameVendedor, d.nameDivisa, tg.nameCategoria, g.status;
					";

		}
				
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function altasBajas(){

		$sql = "SELECT
				    DATE_FORMAT(e.fecha_contratado, '%Y-%m') AS Periodo,
				    em.nombre_razon_social AS Empresa,
				    SUM(CASE WHEN e.fecha_baja IS NULL THEN 1 ELSE 0 END) AS Altas,
				    SUM(CASE WHEN e.fecha_baja IS NOT NULL THEN 1 ELSE 0 END) AS Bajas
				FROM empleados e
				LEFT JOIN puesto p ON e.idEmpleados = p.Empleados_idEmpleados
				LEFT JOIN departamentos d ON p.Departamentos_idDepartamentos = d.idDepartamentos
				LEFT JOIN empresas em ON d.Empresas_idEmpresas = em.idEmpresas
				WHERE e.fecha_contratado BETWEEN '2023-01-01' AND '2023-12-31'  -- Cambiar las fechas según el período deseado
				AND em.nombre_razon_social IS NOT NULL  -- Usar IS NOT NULL en lugar de NOT NULL
				GROUP BY Periodo, em.idEmpresas
				ORDER BY Periodo, em.nombre_razon_social;
				";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function empresasDepartamentos(){

		$sql = "SELECT
					em.nombre_razon_social AS nRazonSocial,
				    d.nameDepto AS Departamento,
				    SUM(CASE WHEN e.genero = '1' THEN 1 ELSE 0 END) AS Masculino,
				    SUM(CASE WHEN e.genero = '0' THEN 1 ELSE 0 END) AS Femenino,
				    AVG(TIMESTAMPDIFF(YEAR, e.fNac, CURDATE())) AS Edad_Promedio
				FROM empleados e
				LEFT JOIN puesto p ON e.idEmpleados = p.Empleados_idEmpleados
				LEFT JOIN departamentos d ON p.Departamentos_idDepartamentos = d.idDepartamentos
				LEFT JOIN empresas em ON d.Empresas_idEmpresas = em.idEmpresas
				WHERE d.nameDepto IS NOT NULL
				GROUP BY d.nameDepto;
				";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function birthday(){

		$sql = "SELECT
					CONCAT(e.lastname, ' ', e.name) AS nombre,
				    DATE_FORMAT(e.fNac, '%d/%m/%Y') AS Fecha_de_Cumpleaños,
				    e.fNac
				FROM empleados e
				WHERE e.status = 1  -- Para incluir solo empleados activos
				ORDER BY DATE_FORMAT(e.fNac, '%m-%d');";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function birthdayContador(){

		$sql = "SELECT
					DATE_FORMAT(e.fNac, '%m') AS Mes,
					COUNT(*) AS Cantidad_de_Empleados
				FROM empleados e
				WHERE e.status = 1  -- Para incluir solo empleados activos
				GROUP BY DATE_FORMAT(e.fNac, '%m')
				ORDER BY MONTH(e.fNac);";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function documentos($idEmpresas){

		$sql = "SELECT
				    e.idEmpleados AS ID_Empleado,
					CONCAT(e.lastname, ' ', e.name) AS nombre,
				    -- Subconsulta para el documento 'Curriculum'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'curriculum'),
				        'Entregado',
				        '-'
				    ) AS Curriculum,
				    -- Subconsulta para el documento 'Acta de Nacimiento'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'acta_nacimiento'),
				        'Entregado',
				        '-'
				    ) AS Acta_de_Nacimiento,
				    -- Subconsulta para el documento 'Comprobante de Domicilio'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'comprobante_domicilio'),
				        'Entregado',
				        '-'
				    ) AS Comprobante_de_Domicilio,
				    -- Subconsulta para el documento 'Identificación Anverso'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'identificacion_anverso'),
				        'Entregado',
				        '-'
				    ) AS Identificacion_Anverso,
				    -- Subconsulta para el documento 'Identificación Reverso'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'identificacion_reverso'),
				        'Entregado',
				        '-'
				    ) AS Identificacion_Reverso,
				    -- Subconsulta para el documento 'RFC'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'rfc'),
				        'Entregado',
				        '-'
				    ) AS RFC,
				    -- Subconsulta para el documento 'CURP'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'curp'),
				        'Entregado',
				        '-'
				    ) AS CURP,
				    -- Subconsulta para el documento 'NSS'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'nss'),
				        'Entregado',
				        '-'
				    ) AS NSS,
				    -- Subconsulta para el documento 'Comprobante último grado de estudios'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'comprobante_estudios'),
				        'Entregado',
				        '-'
				    ) AS Comprobante_Ultimo_Grado,
				    -- Subconsulta para el documento 'Carta de recomendación (Laboral)'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'recomendacion_laboral'),
				        'Entregado',
				        '-'
				    ) AS Recomendacion_Laboral,
				    -- Subconsulta para el documento 'Carta de recomendación (personal)'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'recomendacion_personal'),
				        'Entregado',
				        '-'
				    ) AS Recomendacion_Personal,
				    -- Subconsulta para el documento 'Estado de cuenta'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'estado_cuenta'),
				        'Entregado',
				        '-'
				    ) AS Estado_de_Cuenta,
				    -- Subconsulta para el documento 'Carta de no adeudos (infonavit)'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'infonavit'),
				        'Entregado',
				        '-'
				    ) AS Carta_de_No_Adeudos_Infonavit,
				    -- Subconsulta para el documento 'Carta de no adeudos (fonacot)'
				    IF(
				        EXISTS (SELECT 1 FROM documento d WHERE d.Empleados_idEmpleados = e.idEmpleados AND d.nameDoc = 'fonacot'),
				        'Entregado',
				        '-'
				    ) AS Carta_de_No_Adeudos_Fonacot
				FROM empleados e
				JOIN puesto p ON p.Empleados_idEmpleados = e.idEmpleados
				JOIN departamentos d ON p.Departamentos_idDepartamentos = d.idDepartamentos
				JOIN empresas em ON d.Empresas_idEmpresas = em.idEmpresas
				WHERE e.status = 1 AND em.idEmpresas = $idEmpresas";


		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}
	
}