<?php 

	require_once "conexion.php";

	require_once($_SERVER['DOCUMENT_ROOT'].'/IN-RH/assets/vendor/autoload.php'); //Cambiar en el servidor /IN-RH/assets/vendor/autoload.php, por /assets/vendor/autoload.php

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
		$fecha= date("d/M/Y");
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$diasmin = array("Do","Lu","Ma","Mi","Ju","Vi","Sá");
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
		$default = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("h.default", 1);

		$datos_asistencia = array();
		$horas_totales = 0;

		$datos_asistencia = [];
		$horas_totales = 0;

		foreach ($asistencias as $asistencia) {
		    $horaEntrada = $asistencia['entrada'];
		    $horaSalida = $asistencia['salida'];
		    $dEntrada = $asistencia['entrada_descanso'];
		    $dSalida = $asistencia['salida_descanso'];

		    $entrada = DateTime::createFromFormat('H:i:s', $horaEntrada);
		    $salida = DateTime::createFromFormat('H:i:s', $horaSalida);
		    $entrada_descanso = DateTime::createFromFormat('H:i:s', $dEntrada);
		    $salida_descanso = DateTime::createFromFormat('H:i:s', $dSalida);

		    $intervalo = $entrada->diff($salida);
		    $intervalo_descanso = $entrada_descanso->diff($salida_descanso);

		    $horasDecimales = $intervalo->h + ($intervalo->i / 60);
		    $horasDecimales_descanso = $intervalo_descanso->h + ($intervalo_descanso->i / 60);

		    $horas_diarias_totales = $horasDecimales - $horasDecimales_descanso;
		    $horas_totales += $horas_diarias_totales;

		    $datos_asistencia[] = [
		        "fecha_asistencia" => $asistencia['fecha_asistencia'],
		        "hEntrada" => $horaEntrada,
		        "hSalida" => $horaSalida,
		        "dEntrada" => $dEntrada,
		        "dSalida" => $dSalida,
		        "pausa" => $horasDecimales_descanso,
		        "idJustificantes" => $asistencia['idJustificantes'],
		        "Comentario" => $asistencia['Comentario'],
		        "status_justificante" => $asistencia['status_justificante'],
		        "horas_diarias_totales" => $horas_diarias_totales
		    ];
		}


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
		    while ($fila = $default->fetch(PDO::FETCH_ASSOC)) {
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


		$ndia = array_column($dia_semana, 'ndia');
		$totalDiasLaborables = ModeloExcel::mdlTotalDiasLaborables(date("n"), date("Y"), $ndia);


		$spreadsheet = new Spreadsheet();
		$spreadsheet
		->getProperties()
		->setCreator("IN Consulting México")
		->setLastModifiedBy('IN Consulting México')
		->setTitle("Reporte de Asistencias IN Consulting")
		->setDescription("Reporte de Asistencias del mes de ".$meses[date('n')-1]);

		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing();

		// Set the name of the logo
		$drawing->setName('inconsulting.com');
		$drawing->setPath('../assets/images/logo.png');

		//Informacion de la campaña
		$spreadsheet->setActiveSheetIndex(0);

		$activeWorksheet = $spreadsheet->getActiveSheet();

		
		$activeWorksheet->getHeaderFooter()->addImage($drawing, \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter::IMAGE_HEADER_LEFT);

		// Set the print header
		$activeWorksheet->getHeaderFooter()->setOddHeader('&L&G');

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

		$activeWorksheet->getStyle('B8:L9')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffeeeeee');
		$activeWorksheet->getStyle('B11:L11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffeeeeee');
		$activeWorksheet->getStyle('B11:L11')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));

		$activeWorksheet->getStyle('B2')->getAlignment()->setHorizontal('left')->setVertical('center');
		$activeWorksheet->getStyle('B2')->getFont()->setSize(14);

		$activeWorksheet->getStyle('L3')->getAlignment()->setHorizontal('right');
		$activeWorksheet->getStyle('L4')->getAlignment()->setHorizontal('right');

		$activeWorksheet->getStyle('B8')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('B8')->getFont()->setSize(12)->setBold(true);

		$activeWorksheet->getStyle('B9')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('B9')->getFont()->setSize(12)->setBold(true);

		//$activeWorksheet->getColumnDimension('L')->setAutoSize(true);

		$activeWorksheet->setCellValue('B5', 'RFC: '.$empleado['RFC']);
		$activeWorksheet->setCellValue('B6', 'CURP: '.$empleado['CURP']);
		$activeWorksheet->setCellValue('B7', 'NSS: '.$empleado['NSS']);

		$activeWorksheet->setCellValue('G5', 'Empresa: '.$empresa['nombre_razon_social']);
		$activeWorksheet->setCellValue('G6', 'Puesto: '.$puesto['namePuesto']);
		$activeWorksheet->setCellValue('G7', 'Departamento: '.$departamento['nameDepto']);


		$activeWorksheet->setCellValue('B8', $mesActual);
		$activeWorksheet->setCellValue('B9', date("Y"));
		$activeWorksheet->setCellValue('D8', 'Horas esperadas');
		$activeWorksheet->setCellValue('D9', ModeloExcel::mdlformatearHora($horas_esperadas));
		$activeWorksheet->setCellValue('F8', 'Horas registradas');
		$activeWorksheet->setCellValue('F9', ModeloExcel::mdlformatearHora($horas_totales));
		$activeWorksheet->setCellValue('H8', 'Diferencia');
		$activeWorksheet->setCellValue('H9', ModeloExcel::mdlformatearHora($horas_totales-$horas_esperadas));

		$activeWorksheet->setCellValue('B10', '* Ausencias y festivos');

		$activeWorksheet->mergeCells('B11:C11');
		$activeWorksheet->mergeCells('E11:F11');
		$activeWorksheet->mergeCells('I11:L11');
		$activeWorksheet->setCellValue('B11', 'Fecha');
		$activeWorksheet->setCellValue('D11', 'Esperado');
		$activeWorksheet->setCellValue('E11', 'Inicio - Fin');
		$activeWorksheet->setCellValue('G11', 'Pausa');
		$activeWorksheet->setCellValue('H11', 'Registrado');
		$activeWorksheet->setCellValue('I11', 'Comentario');

		$i=12;

// Ordenar los datos de asistencia por fecha
usort($datos_asistencia, function($a, $b) {
    $fecha1 = DateTime::createFromFormat('Y-m-d', $a['fecha_asistencia']);
    $fecha2 = DateTime::createFromFormat('Y-m-d', $b['fecha_asistencia']);
    return $fecha1 <=> $fecha2;
});

// Generar celdas para cada dato de asistencia
foreach ($datos_asistencia as $value) {
    $relleno = ($value['status_justificante'] == null) ? 'ffeeeeee' : (($value['status_justificante'] == 1) ? 'ff52dc96' : 'ffeeab59');

    $dia = date('N', strtotime($value['fecha_asistencia']));

    $activeWorksheet->mergeCells('E'.$i.':F'.$i);
    $activeWorksheet->mergeCells('I'.$i.':L'.$i);

    $activeWorksheet->setCellValue('B'.$i, $diasmin[$dia]);
    $activeWorksheet->setCellValue('C'.$i, date("d/M/Y", strtotime($value['fecha_asistencia'])));
    $activeWorksheet->setCellValue('D'.$i, ModeloExcel::mdlformatearHora($horas_esperadas));
    $activeWorksheet->setCellValue('E'.$i, $value['hEntrada'].' - '.$value['hSalida']);
    $activeWorksheet->setCellValue('G'.$i, ModeloExcel::mdlformatearHora($value['pausa']));
    $activeWorksheet->setCellValue('H'.$i, ModeloExcel::mdlformatearHora($value['horas_diarias_totales']));
    $activeWorksheet->getStyle('I'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($relleno);
    $activeWorksheet->setCellValue('I'.$i, $value['Comentario']);
    $i++;
}


		$writer = new Xlsx($spreadsheet);
		$writer->save('../view/Asistencias/'.$nombre.'.xlsx');

		return $nombre;

	}

	static public function mdlformatearHora($hora){
		$horas = floor($hora); // Obtener la parte entera de las horas
		$minutos = round(($hora - $horas) * 60); // Obtener los minutos y redondearlos

		$hora_formateada = $horas.'h '. $minutos . 'min';
		return $hora_formateada;
	}

	static public function mdlTotalDiasLaborables($mes,$anio,$ndia){

		// Obtener el número de días en el mes
		$num_dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);

		$num_dias_trabajo = 0;

		// Contar los días de trabajo en el mes
		for ($dia = 1; $dia <= $num_dias_mes; $dia++) {
		    $num_dia_semana = date('w', strtotime("$anio-$mes-$dia")); // Obtener el número del día de la semana (0: domingo, 1: lunes, etc.)
		    
		    if (in_array($num_dia_semana, $ndia)) {
		        $num_dias_trabajo++;
		    }
		}

		return $num_dias_trabajo;

	}

}