<?php 

class ControladorExcel{

	static public function ctrGeneralExcelAsistencias($idEmpleados){
		$tabla = "empleados";
		$GenerarExcelAsistencia = ModeloExcel::mdlGenerarExcelAsistencias($tabla, $idEmpleados);
		return $GenerarExcelAsistencia;
	}


}