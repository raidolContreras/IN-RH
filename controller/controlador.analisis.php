<?php

Class ControladorAnalisis{

	static public function vacaciones(){
		$respuesta = ModeloAnalisis::vacaciones();
		return $respuesta;
	}

}