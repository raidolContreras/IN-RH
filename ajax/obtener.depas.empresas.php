<?php 
require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";

require_once "../model/modelo.empleados.php";
require_once "../controller/controlador.empleados.php";

class FormulariosAjax{

	public function buscarDepasEmpleadoAjax(){
		$idEmpresas = $this->idEmpresas;
		$Departamento = $this->Departamento;
		$buscarDepas = ControladorFormularios::ctrDeptosEspecial2("Empresas_idEmpresas", $idEmpresas);
		$options = '';
		foreach ($buscarDepas as $datos) {
			$opcion = '<option value="' . $datos['id'] . '"';
			if (intval($datos['id']) == intval($Departamento)) {
			    $opcion .= ' selected';
			}

			$opcion .= '>' . $datos['name'];
			if ($datos['Pertenencia'] !== null) {
				$opcion .= ' (' . $datos['Pertenencia'] . ')';
			}
			$opcion .= '</option>';
			$options .= $opcion;
		}

		// Devolver las opciones generadas como respuesta
		echo $options;
	}

}

if (isset($_POST['EmpresaActual'])) {
	$EmpresaActual = $_POST['EmpresaActual'];
	$Departamento = $_POST['Departamento'];

	$generarDepas = new FormulariosAjax();
	$generarDepas -> idEmpresas = $EmpresaActual;
	$generarDepas -> Departamento = $Departamento;
	$generarDepas -> buscarDepasEmpleadoAjax();
}
