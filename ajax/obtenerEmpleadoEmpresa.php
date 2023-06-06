<?php

// Conectamos a la base de datos
require_once "../model/conexion.php";

// Obtener el ID de la empresa enviado por AJAX
$idEmpresa = $_POST['idEmpresa'];

$conexion = Conexion::conectar();
// Realizar la consulta SQL para obtener los empleados de la empresa
$sql = "SELECT CONCAT(e.lastname, ' ', e.name) AS Nombre, e.idEmpleados
        FROM empleados e
        JOIN puesto p ON p.Empleados_idEmpleados = e.idEmpleados
        JOIN departamentos d ON d.idDepartamentos = p.Departamentos_idDepartamentos
        JOIN empresas em ON em.idEmpresas = d.Empresas_idEmpresas
        WHERE em.idEmpresas = :idEmpresa AND e.status = 1";

// Ejecutar la consulta
// Asegúrate de utilizar la misma configuración de conexión a la base de datos que utilizas en otros archivos
$stmt = $conexion->prepare($sql);
$stmt->bindParam(":idEmpresa", $idEmpresa, PDO::PARAM_INT);
$stmt->execute();

// Obtener los resultados de la consulta
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados como respuesta AJAX
echo json_encode($resultados);
?>
