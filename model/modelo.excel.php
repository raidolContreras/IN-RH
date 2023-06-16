<?php 

	require_once "conexion.php";

	require_once($_SERVER['DOCUMENT_ROOT'].'/IN-RH/assets/vendor/autoload.php'); //Cambiar en el servidor, quitar IN-RH y funcionara correctamente

	//Librerias
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\Worksheet;
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Style\Border;
	use PhpOffice\PhpSpreadsheet\Style\Color;
	use PhpOffice\PhpSpreadsheet\Style\Fill;
	use PhpOffice\PhpSpreadsheet\Style\Style;

class ModeloExcel{


	static public function mdlGenerarExcelAsistencias($tabla, $idEmpleados){
		$fecha= date("d-M-Y");
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		$mesActual = $meses[date('n')-1];

	/*-------- Datos generales --------*/
		$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $idEmpleados);
			$nombre = $empleado['lastname']." ".$empleado['name'];

		$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $idEmpleados);
		$departamento = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']);
		$empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $departamento['Empresas_idEmpresas']);


	/*-------- Datos de los días (festivos, asistencias, horarios) --------*/
		$festivos = ControladorEmpleados::ctrDiasFestivos();
		$asistencias = ControladorEmpleados::ctrAsistenciasJustificantes($idEmpleados);
		$horarios = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("idEmpleados", $idEmpleados);

		$dia_semana = array();
		$horas_esperadas = 0;

		while ($fila = $horarios->fetch(PDO::FETCH_ASSOC)) {
		    $dia_semana[] = array(
		    	"ndia" => $fila['dia_Laborable'],
		    	"día" => $dias[$fila['dia_Laborable']],
		    	"hora_dia" => $fila['numero_Horas'],
		    	"entrada" => $fila['hora_Entrada'],
		    	"salida" => $fila['hora_Salida']
		    );
		    $horas_esperadas = $horas_esperadas + $fila['numero_Horas']-1;
		}

		if ($dia_semana == []) {
		    $horarios = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("h.default", 1);
		    while ($fila = $horarios->fetch(PDO::FETCH_ASSOC)) {
			    $dia_semana[] = array(
		    		"ndia" => $fila['dia_Laborable'],
			    	"dia" => $dias[$fila['dia_Laborable']],
		    		"hora_dia" => $fila['numero_Horas'],
		    		"entrada" => $fila['hora_Entrada'],
		    		"salida" => $fila['hora_Salida']
			    );
		    	$horas_esperadas = $horas_esperadas + $fila['numero_Horas']-1;
		    }
		}

		$spreadsheet = new Spreadsheet();

		$spreadsheet
		->getProperties()
		->setCreator("IN Consulting México")
		->setLastModifiedBy('IN Consulting México')
		->setTitle("Reporte de Asistencias IN Consulting")
		->setDescription("Reporte de Asistencias del mes de ".$meses[date('n')-1]);

		//Informacion de la campaña
		$spreadsheet->setActiveSheetIndex(0);

		$activeWorksheet = $spreadsheet->getActiveSheet();

		$activeWorksheet->setTitle('Reporte de '.$mesActual );

		$activeWorksheet->mergeCells('B2:E3');
		$activeWorksheet->setCellValue('B2', $nombre);

		$activeWorksheet->mergeCells('B8:C8');
		$activeWorksheet->mergeCells('B9:C9');
		$activeWorksheet->setCellValue('L3', 'Reporte de Asistencias IN Consulting');
		$activeWorksheet->setCellValue('L4', $fecha);

		$activeWorksheet->getStyle('C8:C9')->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));
		$activeWorksheet->getStyle('B4:L4')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));
		$activeWorksheet->getStyle('B7:L7')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));
		$activeWorksheet->getStyle('B8:L9')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));

		$activeWorksheet->getStyle('B8:L9')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffeeeeee');;

		$activeWorksheet->getStyle('B2')->getAlignment()->setHorizontal('right')->setVertical('center');
		$activeWorksheet->getStyle('B2')->getFont()->setSize(14);

		$activeWorksheet->getStyle('L3')->getAlignment()->setHorizontal('right');
		$activeWorksheet->getStyle('L4')->getAlignment()->setHorizontal('right');

		$activeWorksheet->getStyle('B8')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('B8')->getFont()->setSize(12)->setBold(true);

		$activeWorksheet->getStyle('B9')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('B9')->getFont()->setSize(12)->setBold(true);

		//$activeWorksheet->getColumnDimension('L')->setAutoSize(true);

		$activeWorksheet->setCellValue('B5', 'Nombre: '.$nombre);
		$activeWorksheet->setCellValue('B6', 'RFC: '.$empleado['RFC']);
		$activeWorksheet->setCellValue('B7', 'CURP: '.$empleado['CURP']);

		$activeWorksheet->setCellValue('G5', 'Empresa: '.$empresa['nombre_razon_social']);
		$activeWorksheet->setCellValue('G6', 'Puesto: '.$puesto['namePuesto']);
		$activeWorksheet->setCellValue('G7', 'Departamento: '.$departamento['nameDepto']);


		$activeWorksheet->setCellValue('B8', $mesActual);
		$activeWorksheet->setCellValue('B9', date("Y"));

		$writer = new Xlsx($spreadsheet);
		$writer->save('../view/Asistencias/'.$nombre.'.xlsx');
		return $nombre;

	}

}