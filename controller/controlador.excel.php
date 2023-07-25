<?php 

class ControladorExcel{

	static public function ctrGeneralExcelAsistencias($idEmpleados){
		$tabla = "empleados";
		$GenerarExcelAsistencia = ModeloExcel::mdlGenerarExcelAsistencias($tabla, $idEmpleados);
		return $GenerarExcelAsistencia;
	}

	static public function ctrGeneralExcelAsistenciasEmpresas($idEmpresas){
		$tabla = "empleados";
		$GenerarExcelAsistencia = ModeloExcel::mdlGenerarExcelAsistenciasEmpresas($tabla, $idEmpresas);
		return $GenerarExcelAsistencia;
	}

	static public function ctrGeneralExcelCalificaciones($idExamen){
		$GenerarExcelCalificaciones = ModeloExcel::mdlGeneralExcelCalificaciones($idExamen);
		return $GenerarExcelCalificaciones;
	}


}