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

	static public function altasBajas(){
		$respuesta = ModeloAnalisis::altasBajas();
		return $respuesta;
	}

	static public function birthday($idEmpresas){
		$respuesta = ModeloAnalisis::birthday($idEmpresas);
		return $respuesta;
	}

	static public function birthdayContador($idEmpresas){
		$respuesta = ModeloAnalisis::birthdayContador($idEmpresas);
		return $respuesta;
	}

	static public function documentos($empresa){
		$respuesta = ModeloAnalisis::documentos($empresa);
		return $respuesta;
	}

	static public function contrato($idEmpresas){
		$respuesta = ModeloAnalisis::contrato($idEmpresas);
		return $respuesta;
	}

	static public function contratoContador($idEmpresas){
		$respuesta = ModeloAnalisis::contratoContador($idEmpresas);
		return $respuesta;
	}

	static public function credito($idEmpresas){
		$respuesta = ModeloAnalisis::credito($idEmpresas);
		return $respuesta;
	}

	static public function contratoCredito($idEmpresas){
		$respuesta = ModeloAnalisis::contratoCredito($idEmpresas);
		return $respuesta;
	}

}