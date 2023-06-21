<?php 

require_once "conexion.php";

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
		$nombre = ucwords(mb_strtolower($empleado['lastname']." ".$empleado['name']));
		$nombreDescarga = ModeloExcel::quitarAcentos($nombre);

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

		while ($fila = $horarios->fetch(PDO::FETCH_ASSOC)) {
			$dia_semana[] = array(
				"ndia" => $fila['dia_Laborable'],
				"día" => $dias[$fila['dia_Laborable']],
				"hora_dia" => $fila['numero_Horas'],
				"entrada" => $fila['hora_Entrada'],
				"salida" => $fila['hora_Salida']
			);
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
		$activeWorksheet->setCellValue('L3', 'Reporte de Asistencias IN Consulting');
		$activeWorksheet->setCellValue('L4', $fecha);

		$activeWorksheet->mergeCells('B5:E5');
		$activeWorksheet->mergeCells('B6:E6');
		$activeWorksheet->mergeCells('B7:E7');

		$activeWorksheet->mergeCells('G5:L5');
		$activeWorksheet->mergeCells('G6:L6');
		$activeWorksheet->mergeCells('G7:L7');

		$activeWorksheet->mergeCells('B8:C8');
		$activeWorksheet->mergeCells('B9:C9');
		$activeWorksheet->mergeCells('G8:I8');
		$activeWorksheet->mergeCells('G9:I9');
		$activeWorksheet->mergeCells('D8:F8');
		$activeWorksheet->mergeCells('D9:F9');
		$activeWorksheet->mergeCells('J8:K8');
		$activeWorksheet->mergeCells('J9:K9');

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

		$activeWorksheet->setCellValue('B5', 'RFC: '.$empleado['RFC']);
		$activeWorksheet->setCellValue('B6', 'CURP: '.$empleado['CURP']);
		$activeWorksheet->setCellValue('B7', 'NSS: '.$empleado['NSS']);

		$activeWorksheet->setCellValue('G5', 'Empresa: '.$empresa['nombre_razon_social']);
		$activeWorksheet->setCellValue('G6', 'Puesto: '.$puesto['namePuesto']);
		$activeWorksheet->setCellValue('G7', 'Departamento: '.$departamento['nameDepto']);


		$activeWorksheet->setCellValue('B8', $mesActual);
		$activeWorksheet->setCellValue('B9', date("Y"));
		$activeWorksheet->setCellValue('D8', 'Horas esperadas (1er quincena)');
		$activeWorksheet->setCellValue('G8', 'Horas esperadas (2da quincena)');
		$activeWorksheet->setCellValue('J8', 'Horas registradas');
		$activeWorksheet->setCellValue('L8', 'Diferencia');

		$activeWorksheet->setCellValue('B10', '* Ausencias y festivos');

		$activeWorksheet->mergeCells('B11:C11');
		$activeWorksheet->mergeCells('E11:F11');
		$activeWorksheet->mergeCells('G11:H11');
		$activeWorksheet->mergeCells('J11:L11');
		$activeWorksheet->setCellValue('B11', 'Fecha');
		$activeWorksheet->setCellValue('D11', 'Esperado');
		$activeWorksheet->setCellValue('E11', 'Inicio - Fin');
		$activeWorksheet->setCellValue('G11', 'Descanso: Inicio - Fin');
		$activeWorksheet->setCellValue('I11', 'Registrado');
		$activeWorksheet->setCellValue('J11', 'Comentario');

		$i=12;

// Ordenar los datos de asistencia por fecha
		usort($datos_asistencia, function($a, $b) {
			$fecha1 = DateTime::createFromFormat('Y-m-d', $a['fecha_asistencia']);
			$fecha2 = DateTime::createFromFormat('Y-m-d', $b['fecha_asistencia']);
			return $fecha1 <=> $fecha2;
		});

		$numeroDias = date('t');

// Obtener el número del día actual
		$diaActual = date('j');

// Obtener el mes actual
		$mesActual = date('m');

// Obtener el año actual
		$añoActual = date('Y');

		$primerQuincena = 0;
		$segundaQuincena = 0;
		$horasPrimerQuincena = 0;
		$horasSegundaQuincena = 0;
// Generar celdas para cada día del mes
		for ($dia = 1; $dia <= $numeroDias; $dia++) {

			$activeWorksheet->setCellValue('E'.$i, ' - ');
			$activeWorksheet->setCellValue('G'.$i, ' - ');
			$status = 0;

// Formatear la fecha completa en el formato "dd/mm/yyyy"
			$fechaCompleta = sprintf("%02d/%02d/%04d", $dia, $mesActual, $añoActual);
			$fechasInformato = date('N', strtotime(sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)));

			if ($fechasInformato == 7) {
				$fechasInformato = 0;
			}

			foreach ($datos_asistencia as $value){
				$relleno = ($value['status_justificante'] == null) ? 'ffeeeeee' : (($value['status_justificante'] == 1) ? 'ff52dc96' : 'ffeeab59');
				if ($value['fecha_asistencia'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {

					if (date('d', strtotime($value['fecha_asistencia'])) <= 15) {
						$horasPrimerQuincena += $value['horas_diarias_totales'];
					}else{
						$horasSegundaQuincena += $value['horas_diarias_totales'];
					}

					$activeWorksheet->setCellValue('E'.$i, $value['hEntrada'].' - '.$value['hSalida']);
					$activeWorksheet->setCellValue('G'.$i, $value['dEntrada'].' - '.$value['dSalida']);
					$activeWorksheet->setCellValue('I'.$i,ModeloExcel::mdlformatearHora($value['horas_diarias_totales']));
					$activeWorksheet->getStyle('J'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($relleno);
					$activeWorksheet->setCellValue('J'.$i, $value['Comentario']);
				}
			}

			foreach ($dia_semana as $value) {

				if ($value['ndia'] == $fechasInformato) {
					$activeWorksheet->setCellValue('D'.$i, ModeloExcel::mdlformatearHora($value['hora_dia']));
					$primerQuincena += $value['hora_dia'];
					$segundaQuincena += $value['hora_dia'];
					$status = 1;
				}

// Verificar si es el día 15 para agregar la línea divisoria
				if ($dia === 15) {
// Agregar una línea divisoria
					$activeWorksheet->setCellValue('D9', ModeloExcel::mdlformatearHora($primerQuincena));
					$activeWorksheet->getStyle('B'.$i.':L'.$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					$activeWorksheet->getStyle('B'.$i.':L'.$i)->getBorders()->getBottom()->getColor()->setARGB('000000');
					$segundaQuincena = 0;
				}
			}

			$activeWorksheet->setCellValue('G9', ModeloExcel::mdlformatearHora($segundaQuincena));
			$activeWorksheet->setCellValue('B'.$i, $diasmin[$fechasInformato]);
// Imprimir la fecha completa en la celda correspondiente
			$activeWorksheet->setCellValue('C'.$i, $fechaCompleta);

			if ($status == 0) {
				$activeWorksheet->setCellValue('D'.$i, ' - ');
				$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
			}else{
				$activeWorksheet->mergeCells('E'.$i.':F'.$i);
				$activeWorksheet->mergeCells('G'.$i.':H'.$i);
				$activeWorksheet->mergeCells('J'.$i.':L'.$i);
			}

// Incrementar el número de fila
			$i++;
		}
		if (date('d') <= 15) {
			$activeWorksheet->setCellValue('J9', ModeloExcel::mdlformatearHora($horasPrimerQuincena));

			$activeWorksheet->setCellValue('L9', ModeloExcel::mdlformatearHora($primerQuincena - $horasPrimerQuincena));
		}else{
			$activeWorksheet->setCellValue('J9', ModeloExcel::mdlformatearHora($horasSegundaQuincena));

			$activeWorksheet->setCellValue('L9', ModeloExcel::mdlformatearHora($segundaQuincena - $horasSegundaQuincena));
		}

		$activeWorksheet->getColumnDimension('B')->setWidth(3);
		$activeWorksheet->getColumnDimension('C')->setWidth(11);
		$activeWorksheet->getColumnDimension('D')->setWidth(10);
		$activeWorksheet->getColumnDimension('H')->setWidth(10);
		$activeWorksheet->getColumnDimension('I')->setWidth(10);
		$activeWorksheet->getColumnDimension('L')->setWidth(20);

		$writer = new Xlsx($spreadsheet);
		$writer->save('../view/Asistencias/'.$nombreDescarga.'.xlsx');

		return $nombreDescarga;

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

static public function quitarAcentos($texto) {
	$acentos = array(
		'á' => 'a',
		'é' => 'e',
		'í' => 'i',
		'ó' => 'o',
		'ú' => 'u',
		'Á' => 'A',
		'É' => 'E',
		'Í' => 'I',
		'Ó' => 'O',
		'Ú' => 'U',
		'ä' => 'a',
		'ë' => 'e',
		'ï' => 'i',
		'ö' => 'o',
		'ü' => 'u',
		'Ä' => 'A',
		'Ë' => 'E',
		'Ï' => 'I',
		'Ö' => 'O',
		'Ü' => 'U',
		'à' => 'a',
		'è' => 'e',
		'ì' => 'i',
		'ò' => 'o',
		'ù' => 'u',
		'À' => 'A',
		'È' => 'E',
		'Ì' => 'I',
		'Ò' => 'O',
		'Ù' => 'U',
		'â' => 'a',
		'ê' => 'e',
		'î' => 'i',
		'ô' => 'o',
		'û' => 'u',
		'Â' => 'A',
		'Ê' => 'E',
		'Î' => 'I',
		'Ô' => 'O',
		'Û' => 'U',
		'ç' => 'c',
		'Ç' => 'C',
		'ñ' => 'n',
		'Ñ' => 'N',
		' ' => '_',
	);

	return strtr($texto, $acentos);
}

static public function mdlGenerarExcelAsistenciasEmpresas($tabla, $idEmpresas){

	$fecha= date("d/M/Y");
	$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	$diasmin = array("Do","Lu","Ma","Mi","Ju","Vi","Sá");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	$nombreMesActual = $meses[date('n')-1];

	$festivos = ControladorEmpleados::ctrDiasFestivos();

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
	$activeWorksheet->setTitle('Reporte de '.$nombreMesActual );

	if ($idEmpresas == 0) {

		$empleados = ControladorEmpleados::ctrVerEmpleados(null,null);

		$activeWorksheet->mergeCells('B2:E3');
		$activeWorksheet->setCellValue('B2', 'Reporte General');

		$nombreArchivo = 'Reporte_General_'.$nombreMesActual.'_'.date("Y");

	}else{
		$empleados = ControladorFormularios::ctrEmpleadosEspecial("idEmpresas", $idEmpresas);
		$empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $idEmpresas);
		$activeWorksheet->mergeCells('B2:E3');
		$activeWorksheet->setCellValue('B2', $empresa['nombre_razon_social']);

		$nombreArchivo = 'Reporte_'.$empresa['nombre_razon_social'].'_'.$nombreMesActual.'_'.date("Y");
	}

	$activeWorksheet->setCellValue('L3', 'Reporte de Asistencias IN Consulting');
	$activeWorksheet->setCellValue('L4', $fecha);

	$activeWorksheet->getStyle('B2')->getAlignment()->setHorizontal('left')->setVertical('center');
	$activeWorksheet->getStyle('B2')->getFont()->setSize(14);

	$activeWorksheet->getStyle('L3')->getAlignment()->setHorizontal('right');
	$activeWorksheet->getStyle('L4')->getAlignment()->setHorizontal('right');

	$activeWorksheet->getStyle('B4:L4')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));

	$activeWorksheet->getColumnDimension('B')->setWidth(3);
	$activeWorksheet->getColumnDimension('C')->setWidth(11);
	$activeWorksheet->getColumnDimension('D')->setWidth(10);
	$activeWorksheet->getColumnDimension('H')->setWidth(10);
	$activeWorksheet->getColumnDimension('I')->setWidth(10);
	$activeWorksheet->getColumnDimension('L')->setWidth(20);

	$a = 5;

	foreach ($empleados as $empleado) {

		$nombre = ucwords(mb_strtolower($empleado['lastname']." ".$empleado['name']));
		$nombreDescarga = ModeloExcel::quitarAcentos($nombre);

		$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $empleado['idEmpleados']);
		$departamento = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']);
		$empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $departamento['Empresas_idEmpresas']);

		/*-------- Datos de los días (festivos, asistencias, horarios) --------*/
		$asistencias = ControladorEmpleados::ctrAsistenciasJustificantes($empleado['idEmpleados']);
		$horarios = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("Empleados_idEmpleados", $empleado['idEmpleados']);
		$default = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("h.default", 1);

		$datos_asistencia = array();
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

		while ($fila = $horarios->fetch(PDO::FETCH_ASSOC)) {
			$dia_semana[] = array(
				"ndia" => $fila['dia_Laborable'],
				"día" => $dias[$fila['dia_Laborable']],
				"hora_dia" => $fila['numero_Horas'],
				"entrada" => $fila['hora_Entrada'],
				"salida" => $fila['hora_Salida']
			);
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
			}
		}

		$ndia = array_column($dia_semana, 'ndia');
		$totalDiasLaborables = ModeloExcel::mdlTotalDiasLaborables(date("n"), date("Y"), $ndia);

		$activeWorksheet->mergeCells('B'.$a.':E'.$a);
		$activeWorksheet->mergeCells('B'.($a+1).':E'.($a+1));
		$activeWorksheet->mergeCells('B'.($a+2).':E'.($a+2));

		$activeWorksheet->mergeCells('G'.$a.':L'.$a);
		$activeWorksheet->mergeCells('G'.($a+1).':L'.($a+1));
		$activeWorksheet->mergeCells('G'.($a+2).':L'.($a+2));

		$activeWorksheet->mergeCells('B'.($a+3).':C'.($a+3));
		$activeWorksheet->mergeCells('B'.($a+4).':C'.($a+4));

		$activeWorksheet->mergeCells('G'.($a+3).':I'.($a+3));
		$activeWorksheet->mergeCells('G'.($a+4).':I'.($a+4));

		$activeWorksheet->mergeCells('D'.($a+3).':F'.($a+3));
		$activeWorksheet->mergeCells('D'.($a+4).':F'.($a+4));

		$activeWorksheet->mergeCells('J'.($a+3).':K'.($a+3));
		$activeWorksheet->mergeCells('J'.($a+4).':K'.($a+4));

		$activeWorksheet->getStyle('C'.($a+3).':C'.($a+4))->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));
		$activeWorksheet->getStyle('B'.($a+2).':L'.($a+2))->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));
		$activeWorksheet->getStyle('B'.($a+3).':L'.($a+4))->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));

		$activeWorksheet->getStyle('B'.($a+3).':L'.($a+4))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffeeeeee');
		$activeWorksheet->getStyle('B'.($a+6).':L'.($a+6))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffeeeeee');
		$activeWorksheet->getStyle('B'.($a+6).':L'.($a+6))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('ff949494'));

		$activeWorksheet->getStyle('B'.($a+3))->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('B'.($a+3))->getFont()->setSize(12)->setBold(true);

		$activeWorksheet->getStyle('B'.($a+4))->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('B'.($a+4))->getFont()->setSize(12)->setBold(true);

		$activeWorksheet->setCellValue('B'.$a, 'RFC: '.$empleado['RFC']);
		$activeWorksheet->setCellValue('B'.($a+1), 'CURP: '.$empleado['CURP']);
		$activeWorksheet->setCellValue('B'.($a+2), 'NSS: '.$empleado['NSS']);

		$activeWorksheet->setCellValue('G'.$a, 'Empleado: '.$nombre);
		$activeWorksheet->setCellValue('G'.($a+1), 'Puesto: '.$puesto['namePuesto']);
		$activeWorksheet->setCellValue('G'.($a+2), 'Departamento: '.$departamento['nameDepto']);

		$activeWorksheet->setCellValue('B'.($a+3), $nombreMesActual);
		$activeWorksheet->setCellValue('B'.($a+4), date("Y"));
		$activeWorksheet->setCellValue('D'.($a+3), 'Horas esperadas (1er quincena)');
		$activeWorksheet->setCellValue('G'.($a+3), 'Horas esperadas (2da quincena)');
		$activeWorksheet->setCellValue('J'.($a+3), 'Horas registradas');
		$activeWorksheet->setCellValue('L'.($a+3), 'Diferencia');

		$activeWorksheet->setCellValue('B'.($a+5), '* Ausencias y festivos');

		$activeWorksheet->mergeCells('B'.($a+6).':C'.($a+6));
		$activeWorksheet->mergeCells('E'.($a+6).':F'.($a+6));
		$activeWorksheet->mergeCells('G'.($a+6).':H'.($a+6));
		$activeWorksheet->mergeCells('J'.($a+6).':L'.($a+6));
		$activeWorksheet->setCellValue('B'.($a+6), 'Fecha');
		$activeWorksheet->setCellValue('D'.($a+6), 'Esperado');
		$activeWorksheet->setCellValue('E'.($a+6), 'Inicio - Fin');
		$activeWorksheet->setCellValue('G'.($a+6), 'Descanso: Inicio - Fin');
		$activeWorksheet->setCellValue('I'.($a+6), 'Registrado');
		$activeWorksheet->setCellValue('J'.($a+6), 'Comentario');

		$x = $a + 4;
		$a = $a + 7;

		$numeroDias = date('t');

// Obtener el número del día actual
		$diaActual = date('j');

// Obtener el mes actual
		$mesActual = date('m');

// Obtener el año actual
		$añoActual = date('Y');

		$primerQuincena = 0;
		$segundaQuincena = 0;
		$horasPrimerQuincena = 0;
		$horasSegundaQuincena = 0;
// Generar celdas para cada día del mes
		for ($dia = 1; $dia <= $numeroDias; $dia++) {

			$activeWorksheet->setCellValue('E'.$a, ' - ');
			$activeWorksheet->setCellValue('G'.$a, ' - ');
			$status = 0;

// Formatear la fecha completa en el formato "dd/mm/yyyy"
			$fechaCompleta = sprintf("%02d/%02d/%04d", $dia, $mesActual, $añoActual);
			$fechasInformato = date('N', strtotime(sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)));

			if ($fechasInformato == 7) {
				$fechasInformato = 0;
			}

			foreach ($datos_asistencia as $value){
				$relleno = ($value['status_justificante'] == null) ? 'ffeeeeee' : (($value['status_justificante'] == 1) ? 'ff52dc96' : 'ffeeab59');
				if ($value['fecha_asistencia'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {

					if (date('d', strtotime($value['fecha_asistencia'])) <= 15) {
						$horasPrimerQuincena += $value['horas_diarias_totales'];
					}else{
						$horasSegundaQuincena += $value['horas_diarias_totales'];
					}

					$activeWorksheet->setCellValue('E'.$a, $value['hEntrada'].' - '.$value['hSalida']);
					$activeWorksheet->setCellValue('G'.$a, $value['dEntrada'].' - '.$value['dSalida']);
					$activeWorksheet->setCellValue('I'.$a,ModeloExcel::mdlformatearHora($value['horas_diarias_totales']));
					$activeWorksheet->getStyle('J'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($relleno);
					$activeWorksheet->setCellValue('J'.$a, $value['Comentario']);
				}
			}

			foreach ($dia_semana as $value) {

				if ($value['ndia'] == $fechasInformato) {
					$activeWorksheet->setCellValue('D'.$a, ModeloExcel::mdlformatearHora($value['hora_dia']));
					$primerQuincena += $value['hora_dia'];
					$segundaQuincena += $value['hora_dia'];
					$status = 1;
				}

// Verificar si es el día 15 para agregar la línea divisoria
				if ($dia === 15) {
// Agregar una línea divisoria
					$activeWorksheet->setCellValue('D'.($a-17), ModeloExcel::mdlformatearHora($primerQuincena));
					$activeWorksheet->getStyle('B'.$a.':L'.$a)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
					$activeWorksheet->getStyle('B'.$a.':L'.$a)->getBorders()->getBottom()->getColor()->setARGB('000000');
					$segundaQuincena = 0;
				}
			}

			$activeWorksheet->setCellValue('B'.$a, $diasmin[$fechasInformato]);
// Imprimir la fecha completa en la celda correspondiente
			$activeWorksheet->setCellValue('C'.$a, $fechaCompleta);

			if ($status == 0) {
				$activeWorksheet->setCellValue('D'.$a, ' - ');
				$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
			}else{
				$activeWorksheet->mergeCells('E'.$a.':F'.$a);
				$activeWorksheet->mergeCells('G'.$a.':H'.$a);
				$activeWorksheet->mergeCells('J'.$a.':L'.$a);
			}

// Incrementar el número de fila
			$a++;
		}

		$activeWorksheet->setCellValue('G'.$x, ModeloExcel::mdlformatearHora($segundaQuincena));

		if (date('d') <= 15) {
			$activeWorksheet->setCellValue('J'.$x, ModeloExcel::mdlformatearHora($horasPrimerQuincena));

			$activeWorksheet->setCellValue('L'.$x, ModeloExcel::mdlformatearHora($primerQuincena - $horasPrimerQuincena));
		}else{
			$activeWorksheet->setCellValue('J'.$x, ModeloExcel::mdlformatearHora($horasSegundaQuincena));

			$activeWorksheet->setCellValue('L'.$x, ModeloExcel::mdlformatearHora($segundaQuincena - $horasSegundaQuincena));
		}
		$a++;
	}

	$writer = new Xlsx($spreadsheet);
	$writer->save('../view/Asistencias/'.$nombreArchivo.'.xlsx');

	return $nombreArchivo;
}

}