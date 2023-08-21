<?php

Class ControladorAnalisis{

	static public function vacaciones(){
		$respuesta = ModeloAnalisis::vacaciones();
		return $respuesta;
	}

	static public function permisos(){
		$respuesta = ModeloAnalisis::permisos();
		return $respuesta;
	}

	static public function empleados(){
		$respuesta = ModeloAnalisis::empleados();
		return $respuesta;
	}

	static public function genero(){
		$respuesta = ModeloAnalisis::genero();
		return $respuesta;
	}

	static public function edad(){
		$respuesta = ModeloAnalisis::edad();
		return $respuesta;
	}

	static public function gasto($idEmpleados){
		$respuesta = ModeloAnalisis::gasto($idEmpleados);
		return $respuesta;
	}

	static public function empleadosGasto(){
		$respuesta = ModeloAnalisis::empleadosGasto();
		return $respuesta;
	}

}