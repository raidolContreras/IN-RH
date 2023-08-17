<?php
require_once "../model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta para obtener el número total de empleados en cada empresa
$sql = "SELECT
            em.nombre_razon_social AS Empresa,
            COUNT(e.idEmpleados) AS Total_de_Empleados
        FROM empresas em
        LEFT JOIN departamentos d ON em.idEmpresas = d.Empresas_idEmpresas
        LEFT JOIN puesto p ON d.idDepartamentos = p.Departamentos_idDepartamentos
        LEFT JOIN empleados e ON p.Empleados_idEmpleados = e.idEmpleados AND e.status = 1
        GROUP BY em.idEmpresas, em.nombre_razon_social;";
$resultado = $conexion->query($sql);

$empresas = [];
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $empresas[] = $row;
}

// Convertimos el array de empresas a formato JSON
$json_empresas = json_encode($empresas);

// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
echo $json_empresas;

// Cerramos la conexión a la base de datos
$conexion = null;
?>
