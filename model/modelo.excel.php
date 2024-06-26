<?php 

require_once "conexion.php";

require_once "autoload.php";

		// Importar las clases necesarias para TCPDF y PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Tcpdf;
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

	static public function mdlGenerarExcelAsistencias($tabla, $idEmpleados, $fechaSelected){
		
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$diasmin = array("Do","Lu","Ma","Mi","Ju","Vi","Sá");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		if ($fechaSelected == null) {
			// Obtener la fecha actual
			$dia = date('d');
			$mesNumero = date('n'); // Número del mes actual
			$anio = date('Y');

			$mesActual = $meses[date('n') - 1];
		} else {
			// Usar la fecha seleccionada
			$fechaParts = explode('-', $fechaSelected);
			$anio = $fechaParts[0];
			$mesNumero = intval($fechaParts[1]);
			$dia = '01'; // Si solo tienes año y mes, puedes usar el primer día del mes

			$fechaParts = explode('-', $fechaSelected);
			$mesNumero = intval($fechaParts[1]); // Convertir el mes a entero
			$mesActual = $meses[$mesNumero - 1];
		}

		// Obtener el nombre del mes en español
		$mesNombre = $meses[$mesNumero - 1];

		// Formatear la fecha
		$fecha = "$dia/$mesNombre/$anio";

		/*-------- Datos generales --------*/
		$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $idEmpleados);
		$nombre = ucwords(mb_strtolower($empleado['lastname']." ".$empleado['name']));
		$nombreDescarga = ModeloExcel::quitarAcentos($nombre);

		$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $idEmpleados);
		$departamento = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']);
		$empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $departamento['Empresas_idEmpresas']);


		/*-------- Datos de los días (festivos, asistencias, horarios) --------*/
		$festivos = ControladorEmpleados::ctrDiasFestivos($fechaSelected);
		$asistencias = ControladorEmpleados::ctrAsistenciasJustificantes($idEmpleados, $fechaSelected);
		$horarios = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("idEmpleados", $idEmpleados);
		$default = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("h.default", 1);
		$vacaciones = ControladorFormularios::ctrVerSolicitudesVacaciones($idEmpleados,$fechaSelected);
		$permisos = ControladorFormularios::ctrVerSolicitudesPermisos($idEmpleados,$fechaSelected);

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
		->setDescription("Reporte de Asistencias del mes de ".$mesActual);

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

		
		// Obtener el número del día actual
		$diaActual = date('j');
		
		// Obtener el mes actual
		if ($fechaSelected != null) {
			$fechaParts = explode('-', $fechaSelected);
			$mesActual = intval($fechaParts[1]); 
			$añoActual = intval($fechaParts[0]);
			$numeroDias = date('t', mktime(0, 0, 0, $mesActual, 1, $añoActual));
		} else {
			$numeroDias = date('t');
			$mesActual = date('m');
			$añoActual = date('Y');
		}

		$primerQuincena = 0;
		$segundaQuincena = 0;
		$horasPrimerQuincena = 0;
		$horasSegundaQuincena = 0;

		$diasVacaciones = 0;
		$vacacionesAprobadas = 0;
		$Entrada = '';
		$Salida = '';

		$diasPermiso = 0;
		$permisosAprobados = 0;

		$diasFestivos = 0;

		$HorasEsperadasPermisos = '';


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
					$Entrada = $value['entrada'];
					$Salida = $value['salida'];
					$HorasEsperadasPermisos = ModeloExcel::mdlformatearHora($value['hora_dia']);
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

			if ($diasVacaciones == 0) {
				foreach ($vacaciones as $vacacion) {
					if ($vacacion['inicio'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {
						if ($vacacion['status_vacaciones'] == 1) {
							if ($vacacion['respuesta'] == 1) {
								$diasVacaciones = $vacacion['dias']-1;
								$activeWorksheet->setCellValue('E'.$i, $Entrada.' - '.$Salida);
								$activeWorksheet->setCellValue('G'.$i, ' - ');
								$activeWorksheet->setCellValue('I'.$i, $HorasEsperadasPermisos);
								$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ff47aeda');
								$activeWorksheet->setCellValue('J'.$i, 'Vacaciones Aprobadas');
								$vacacionesAprobadas = 1;
							}elseif ($vacacion['respuesta'] != 2){
								$diasVacaciones = $vacacion['dias']-1;
								$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
								$activeWorksheet->setCellValue('J'.$i, 'Vacaciones Pendientes de aprobación');
								$vacacionesAprobadas = 0;
							}
						}
					}
				}
			}else{
				if ($vacacionesAprobadas == 1) {
					$activeWorksheet->setCellValue('E'.$i, $Entrada.' - '.$Salida);
					$activeWorksheet->setCellValue('G'.$i, ' - ');
					$activeWorksheet->setCellValue('I'.$i, $HorasEsperadasPermisos);
					$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ff47aeda');
					$activeWorksheet->setCellValue('J'.$i, 'Vacaciones Aprobadas');
					$diasVacaciones--;
				}else{
					$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
					$activeWorksheet->setCellValue('J'.$i, 'Vacaciones Pendientes de aprobación');
					$diasVacaciones--;
				}
			}

			if ($diasPermiso == 0) {
				foreach ($permisos as $permiso) {
					if ($permiso['fechaPermiso'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {
						if ($permiso['statusPermiso'] == 1) {
								$colorTransformado = 'ff' . substr($permiso['colorPermisos'], 1);
								$diasPermiso = $permiso['rango']-1;
								$activeWorksheet->setCellValue('E'.$i, $Entrada.' - '.$Salida);
								$activeWorksheet->setCellValue('G'.$i, ' - ');
								$activeWorksheet->setCellValue('I'.$i, $HorasEsperadasPermisos);
								$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorTransformado);
								$activeWorksheet->setCellValue('J'.$i, $permiso['namePermisos'].': '.$permiso['descripcion']);
								$permisosAprobados = 1;
						}elseif ($permiso['statusPermiso'] != 2){
							$diasPermiso = $permiso['rango']-1;
							$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
							$activeWorksheet->setCellValue('J'.$i, 'Permiso Pendiente de aprobación');
							$permisosAprobados = 0;
						}
					}
				}
			}else{
				if ($permisosAprobados == 1) {
					$activeWorksheet->setCellValue('E'.$i, $Entrada.' - '.$Salida);
					$activeWorksheet->setCellValue('G'.$i, ' - ');
					$activeWorksheet->setCellValue('I'.$i, $HorasEsperadasPermisos);
					$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorTransformado);
					$activeWorksheet->setCellValue('J'.$i, $permiso['namePermisos'].': '.$permiso['descripcion']);
					$diasPermiso--;
				}else{
					$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
					$activeWorksheet->setCellValue('J'.$i, 'Permiso Pendiente de aprobación');
					$diasPermiso--;
				}
			}

			if ($diasFestivos == 0) {
				foreach ($festivos as $festivo) {
					if ($festivo['fechaFestivo'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {
						$colorTransformado = 'FFDCDCDC';
						$diasPermiso = $festivo['rango']-1;
						$activeWorksheet->setCellValue('E'.$i, $Entrada.' - '.$Salida);
						$activeWorksheet->setCellValue('G'.$i, ' - ');
						$activeWorksheet->setCellValue('I'.$i, $HorasEsperadasPermisos);
						$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorTransformado);
						$activeWorksheet->setCellValue('J'.$i, 'Dia Festivo: '.$festivo['nameFestivo']);
					}
				}
			}else{
					$activeWorksheet->setCellValue('E'.$i, $Entrada.' - '.$Salida);
					$activeWorksheet->setCellValue('G'.$i, ' - ');
					$activeWorksheet->setCellValue('I'.$i, $HorasEsperadasPermisos);
					$activeWorksheet->getStyle('B'.$i.':L'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorTransformado);
					$activeWorksheet->setCellValue('J'.$i, 'Dia Festivo: '.$festivo['nameFestivo']);
					$diasPermiso--;
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
		$horas = floor($hora); 		// Obtener la parte entera de las horas
		$minutos = round(($hora - $horas) * 60); 		// Obtener los minutos y redondearlos

		$hora_formateada = $horas.'h '. $minutos . 'min';
		return $hora_formateada;
	}

	static public function mdlTotalDiasLaborables($mes,$anio,$ndia){

			// Obtener el número de días en el mes
		$num_dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);

		$num_dias_trabajo = 0;

			// Contar los días de trabajo en el mes
		for ($dia = 1; $dia <= $num_dias_mes; $dia++) {
			$num_dia_semana = date('w', strtotime("$anio-$mes-$dia")); 		// Obtener el número del día de la semana (0: domingo, 1: lunes, etc.)

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

	$festivos = ControladorEmpleados::ctrDiasFestivos(null);

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
		$asistencias = ControladorEmpleados::ctrAsistenciasJustificantes($empleado['idEmpleados'], null);
		$horarios = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("Empleados_idEmpleados", $empleado['idEmpleados']);
		$default = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("h.default", 1);

		$vacaciones = ControladorFormularios::ctrVerSolicitudesVacaciones($empleado['idEmpleados'], null);
		$permisos = ControladorFormularios::ctrVerSolicitudesPermisos($empleado['idEmpleados'], null);

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
		
		$diasVacaciones = 0;
		$vacacionesAprobadas = 0;
		$Entrada = '';
		$Salida = '';

		$diasPermiso = 0;
		$permisosAprobados = 0;

		$diasFestivos = 0;

		$HorasEsperadasPermisos = '';
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
					$Entrada = $value['entrada'];
					$Salida = $value['salida'];
					$HorasEsperadasPermisos = ModeloExcel::mdlformatearHora($value['hora_dia']);
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

			if ($diasVacaciones == 0) {
				foreach ($vacaciones as $vacacion) {
					if ($vacacion['inicio'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {
						if ($vacacion['status_vacaciones'] == 1) {
							if ($vacacion['respuesta'] == 1) {
								$diasVacaciones = $vacacion['dias']-1;
								$activeWorksheet->setCellValue('E'.$a, $Entrada.' - '.$Salida);
								$activeWorksheet->setCellValue('G'.$a, ' - ');
								$activeWorksheet->setCellValue('I'.$a, $HorasEsperadasPermisos);
								$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ff47aeda');
								$activeWorksheet->setCellValue('J'.$a, 'Vacaciones Aprobadas');
								$vacacionesAprobadas = 1;
							}elseif ($vacacion['respuesta'] != 2){
								$diasVacaciones = $vacacion['dias']-1;
								$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
								$activeWorksheet->setCellValue('J'.$a, 'Vacaciones Pendientes de aprobación');
								$vacacionesAprobadas = 0;
							}
						}
					}
				}
			}else{
				if ($vacacionesAprobadas == 1) {
					$activeWorksheet->setCellValue('E'.$a, $Entrada.' - '.$Salida);
					$activeWorksheet->setCellValue('G'.$a, ' - ');
					$activeWorksheet->setCellValue('I'.$a, $HorasEsperadasPermisos);
					$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ff47aeda');
					$activeWorksheet->setCellValue('J'.$a, 'Vacaciones Aprobadas');
					$diasVacaciones--;
				}else{
					$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
					$activeWorksheet->setCellValue('J'.$a, 'Vacaciones Pendientes de aprobación');
					$diasVacaciones--;
				}
			}

			if ($diasPermiso == 0) {
				foreach ($permisos as $permiso) {
					if ($permiso['fechaPermiso'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {
						if ($permiso['statusPermiso'] == 1) {
								$colorTransformado = 'ff' . substr($permiso['colorPermisos'], 1);
								$diasPermiso = $permiso['rango']-1;
								$activeWorksheet->setCellValue('E'.$a, $Entrada.' - '.$Salida);
								$activeWorksheet->setCellValue('G'.$a, ' - ');
								$activeWorksheet->setCellValue('I'.$a, $HorasEsperadasPermisos);
								$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorTransformado);
								$activeWorksheet->setCellValue('J'.$a, $permiso['namePermisos'].': '.$permiso['descripcion']);
								$permisosAprobados = 1;
						}elseif ($permiso['statusPermiso'] != 2){
							$diasPermiso = $permiso['rango']-1;
							$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
							$activeWorksheet->setCellValue('J'.$a, 'Permiso Pendiente de aprobación');
							$permisosAprobados = 0;
						}
					}
				}
			}else{
				if ($permisosAprobados == 1) {
					$activeWorksheet->setCellValue('E'.$a, $Entrada.' - '.$Salida);
					$activeWorksheet->setCellValue('G'.$a, ' - ');
					$activeWorksheet->setCellValue('I'.$a, $HorasEsperadasPermisos);
					$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorTransformado);
					$activeWorksheet->setCellValue('J'.$a, $permiso['namePermisos'].': '.$permiso['descripcion']);
					$diasPermiso--;
				}else{
					$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffbababa');
					$activeWorksheet->setCellValue('J'.$a, 'Permiso Pendiente de aprobación');
					$diasPermiso--;
				}
			}

			if ($diasFestivos == 0) {
				foreach ($festivos as $festivo) {
					if ($festivo['fechaFestivo'] == sprintf("%04d-%02d-%02d", $añoActual, $mesActual, $dia)) {
						$colorTransformado = 'FFDCDCDC';
						$diasPermiso = $festivo['rango']-1;
						$activeWorksheet->setCellValue('E'.$a, $Entrada.' - '.$Salida);
						$activeWorksheet->setCellValue('G'.$a, ' - ');
						$activeWorksheet->setCellValue('I'.$a, $HorasEsperadasPermisos);
						$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorTransformado);
						$activeWorksheet->setCellValue('J'.$a, 'Dia Festivo: '.$festivo['nameFestivo']);
					}
				}
			}else{
					$activeWorksheet->setCellValue('E'.$a, $Entrada.' - '.$Salida);
					$activeWorksheet->setCellValue('G'.$a, ' - ');
					$activeWorksheet->setCellValue('I'.$a, $HorasEsperadasPermisos);
					$activeWorksheet->getStyle('B'.$a.':L'.$a)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorTransformado);
					$activeWorksheet->setCellValue('J'.$a, 'Dia Festivo: '.$festivo['nameFestivo']);
					$diasPermiso--;
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

	static public function mdlGeneralExcelCalificaciones($idExamen){
		$datos_preguntas = array();
		$datos_empleados = array();

		$escalaFile = file_get_contents('../view/pages/json/escalas.json');
		$escala = json_decode($escalaFile, true);

		$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $idExamen);
		$empleados = ControladorFormularios::ctrExamenesEmpleados($idExamen);
		$preguntas = ControladorFormularios::ctrExamenesPreguntas($idExamen);
		$i = 0;
		$e = 0;
		$a = 8;
		$barra = 0;
		$barra2 = 0;

		foreach ($preguntas as $pregunta) {
			$preguntaSinHTML = strip_tags($pregunta['pregunta']);
			$letraPregunta = ModeloExcel::sumarLetra('F', $i); 		// Sumamos 'A' más el número de pregunta
			$i++;
			$datos_preguntas[] = array(
				"pregunta" => $preguntaSinHTML,
				"tipo_pregunta" => $pregunta['tipo_pregunta'],
				"letra_Pregunta" => $letraPregunta 		// Guardamos la letra resultante
			);
		}

		foreach ($empleados as $empleado) {
			$total_preguntas = 0;
			$total_correctas = 0;
			$e++;

			if (strlen($e)==1) {
				$num = '0'.$e;
			}else{
				$num = $e;
			}
			$resultado = array();
			foreach ($preguntas as $pregunta) {
				$valor = '';
				$i++;
				$respuesta = ModeloFormularios::mdlEmpleadoPreguntas($pregunta['idPregunta'], $empleado['idEmpleados']);
				$respuestasExamen = ControladorFormularios::ctrVerRespuestasExamen('idPregunta', $pregunta['idPregunta']);
				$total_preguntas++;
				$total_correctas++;

				$preguntaName = strip_tags($pregunta['pregunta']);

				if (empty($respuesta['respuesta'])) {
					if ($pregunta['tipo_pregunta'] == 'abierta') {
						$total_preguntas--;
						$total_correctas--;
						$valor = 'abierta';
					}elseif ($pregunta['tipo_pregunta'] == 'escala') {
						foreach ($respuestasExamen as $respuestaExamen) {
							if ($respuestaExamen['respuesta'] == 'escala') {
								$total_preguntas--;
								$total_correctas--;
								$valor = 'escala';
							}else{
								foreach ($opciones as $key => $opcion) {
									$resultados = $respuestaExamen['valor'];
									if ($key == $resultados) {
											$total_correctas--;
											$valor = 'binario';
									}
								}
							}
						}
					}else{
						foreach ($respuestasExamen as $respuestaExamen) {
							if ($respuestaExamen['valor'] == 1) {
									$total_correctas--;
									$valor = 0;
							}
						}
					}
					$resultado[] = array(
						'pregunta' => $preguntaName,
						'respuesta' => "-",
						'valor' => $valor
					);
				}else{
					if ($pregunta['tipo_pregunta'] == 'abierta') {
						$total_preguntas--;
						$total_correctas--;
						$valor = 'abierta';
					}elseif ($pregunta['tipo_pregunta'] == 'escala') {
						foreach ($respuestasExamen as $respuestaExamen) {
							$opciones = $escala[$respuestaExamen['valor']];
							$resultados = $respuesta['respuesta'];
							if ($respuestaExamen['respuesta'] == 'escala') {
								$total_preguntas--;
								$total_correctas--;
								$valor = 'escala';
								foreach ($opciones as $key => $opcion){
									if ($respuesta['respuesta'] == $key) {
										$respuesta['respuesta'] = $opcion;
									}
								}
							}else{
								foreach ($opciones as $key => $opcion) {
									if ($key == $resultados) {
										if ($respuestaExamen['valor'] == $key) {
											$resultados = $opcion;
											$valor = 1;
										}else{
											$total_correctas--;
											$valor = 'binario';
										}
										if ($respuesta['respuesta'] == 4) {
											$respuesta['respuesta'] = 'Verdadero';
										}else{
											$respuesta['respuesta'] = 'Falso';
										}
									}
								}
							}
						}
					}else{
						foreach ($respuestasExamen as $respuestaExamen) {
							if ($respuestaExamen['valor'] == 1) {
								if ($respuestaExamen['respuesta'] == $respuesta['respuesta']) {
									$valor = $respuestaExamen['valor'];
								}else{
									$total_correctas = $total_correctas - 1;
									$valor = 0;
								}
							}
						}
					}
					$resultado[] = array(
						'pregunta' => $preguntaName,
						'respuesta' => $respuesta['respuesta'],
						'valor' => $valor
					);
				}
			}

			$datos_empleados[] = array(
				"nombre" => mb_strtoupper($empleado['nombre']),
				"idEmpleado" => $empleado['idEmpleados'],
				"num_empleado" => $num,
				"tupla" => $a,
				"total_preguntas" => $total_preguntas,
				"total_correctas" => $total_correctas,
				"respuestas" => $resultado
			);

			$a++;
		}

				//print_r($datos_empleados);

		$spreadsheet = new Spreadsheet();
		$spreadsheet
		->getProperties()
		->setCreator("IN Consulting México")
		->setLastModifiedBy('IN Consulting México')
		->setTitle("Reporte de Calificaciones IN Consulting")
		->setDescription("Reporte de Calificaciones de ".$Evaluaciones['titulo']);

		$spreadsheet->setActiveSheetIndex(0);

		$activeWorksheet = $spreadsheet->getActiveSheet();

		// Set the print header
		$activeWorksheet->getHeaderFooter()->setOddHeader('&L&G');

		$activeWorksheet->setCellValue('B3', 'Reporte de Calificaciones:');
		$activeWorksheet->setCellValue('B4', 'Total de empleados:');
		$activeWorksheet->setCellValue('D3', $Evaluaciones['titulo']);
		$activeWorksheet->setCellValue('D4', $num);

		$activeWorksheet->mergeCells('B3:C3');
		$activeWorksheet->mergeCells('B4:C4');
		$activeWorksheet->mergeCells('B6:B7');
		$activeWorksheet->mergeCells('C6:C7');
		$activeWorksheet->mergeCells('D6:D7');
		$activeWorksheet->mergeCells('E6:E7');
		$activeWorksheet->mergeCells('F6:'.$letraPregunta.'6');
		$activeWorksheet->setCellValue('B6', '#');
		$activeWorksheet->setCellValue('C6', 'Empleado');
		$activeWorksheet->setCellValue('D6', 'Total preguntas');
		$activeWorksheet->setCellValue('E6', 'Preguntas correctas');
		$activeWorksheet->setCellValue('F6', 'Preguntas');
		foreach ($datos_preguntas as $pregunta) {
			$activeWorksheet->setCellValue($pregunta['letra_Pregunta'].'7', html_entity_decode($pregunta['pregunta']));
		}
		foreach ($datos_empleados as $empleado) {
			$activeWorksheet->setCellValue('B'.$empleado['tupla'], $empleado['num_empleado']);
			$activeWorksheet->setCellValue('C'.$empleado['tupla'], $empleado['nombre']);
			$activeWorksheet->setCellValue('D'.$empleado['tupla'], $empleado['total_preguntas']);
			$activeWorksheet->setCellValue('E'.$empleado['tupla'], $empleado['total_correctas']);
			$promedioFinal = ControladorFormularios::calcularCalificacion($empleado['total_correctas'],$empleado['total_preguntas']);
			$promedioFinal = strip_tags($promedioFinal);
			$r = 0;
			if ($barra == 1) {
				$activeWorksheet->getStyle('B'.$empleado['tupla'].':'.$pregunta['letra_Pregunta'].$empleado['tupla'])->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffc1c1c1');
				$barra = 0;
			}else{
				$barra = 1;
			}
			foreach ($datos_preguntas as $pregunta) {
				$activeWorksheet->setCellValue($pregunta['letra_Pregunta'].$empleado['tupla'], $empleado['respuestas'][$r]['respuesta']);
				if ($empleado['respuestas'][$r]['valor'] == 1) {
					$activeWorksheet->getStyle($pregunta['letra_Pregunta'].$empleado['tupla'])->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffa4ffa4');
				}elseif ($empleado['respuestas'][$r]['valor'] == 0 || $empleado['respuestas'][$r]['valor'] == 'binario') {
					$activeWorksheet->getStyle($pregunta['letra_Pregunta'].$empleado['tupla'])->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('EB3737');
				}

				$activeWorksheet->getColumnDimension($pregunta['letra_Pregunta'])->setWidth(30);
				$r++;
			}
			$lastLetra = ModeloExcel::sumarLetra($pregunta['letra_Pregunta'], 1);
			$activeWorksheet->setCellValue($lastLetra.$empleado['tupla'], $promedioFinal);
			if ($barra2 == 1) {
				$activeWorksheet->getStyle($lastLetra.$empleado['tupla'].':'.$lastLetra.$empleado['tupla'])->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffc1c1c1');
				$barra2 = 0;
			}else{
				$barra2 = 1;
			}
		}
		$activeWorksheet->setCellValue($lastLetra.'6', 'Total');
		$activeWorksheet->mergeCells($lastLetra.'6:'.$lastLetra.'7');
		$activeWorksheet->getColumnDimension($lastLetra)->setWidth(30);
		$activeWorksheet->getStyle($lastLetra.'6')->getAlignment()->setHorizontal('center')->setVertical('center');

		$activeWorksheet->getStyle('B6:'.$lastLetra.'7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffeeeeee');

		$activeWorksheet->getStyle('B6')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('C6')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('D6')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('E6')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getStyle('F6')->getAlignment()->setHorizontal('center')->setVertical('center');
		$activeWorksheet->getColumnDimension('B')->setWidth(3);
		$activeWorksheet->getColumnDimension('C')->setWidth(30);
		$activeWorksheet->getColumnDimension('D')->setWidth(20);
		$activeWorksheet->getColumnDimension('E')->setWidth(20);


		$writer = new Xlsx($spreadsheet);
		$writer->save('../view/Calificaciones/'.$Evaluaciones['titulo'].'.xlsx');

		return $Evaluaciones['titulo'];
	}

	static public function sumarLetra($letra, $numero) {
		$asciiBase = ord(ctype_upper($letra) ? 'A' : 'a');
		$asciiSumado = ord($letra) + $numero - $asciiBase;
		$asciiFinal = ($asciiSumado % 26) + $asciiBase;
		$letraResultado = chr($asciiFinal);
		return $letraResultado;
	}

	static public function ctrGenerarExcelGastoIndividual($datos){
		$spreadsheet = new Spreadsheet();
		$spreadsheet
		->getProperties()
		->setCreator("IN Consulting México")
		->setLastModifiedBy('IN Consulting México')
		->setTitle("Reporte de Gasto Individual IN Consulting")
		->setDescription("Reporte de Gasto Individual de ".$datos['nombre']);

		$spreadsheet->setActiveSheetIndex(0);
		$borderStyle = [
			'borders' => [
				'outline' => [
					'borderStyle' => Border::BORDER_THIN,
					'color' => ['rgb' => '949494'],
				],
			],
		];

		$filleee = [
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startColor' => ['argb' => 'ffeeeeee'],
			],
		];

		$fill_solid = \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID;

		$activeWorksheet = $spreadsheet->getActiveSheet();
		/*-- Generación de columnas y  campos --*/

		$activeWorksheet->setCellValue('C1', 'Información del gasto:');
		$activeWorksheet->setCellValue('F2', 'Fecha de creación: '.$datos['fecha_creacion']);
		$activeWorksheet->setCellValue('A2', 'Empleado que registro: '.$datos['nombre']);
		$activeWorksheet->setCellValue('F3', 'Estatus: '.$datos['status']);

		$activeWorksheet->setCellValue('B6', 'Categoria:');
		$activeWorksheet->setCellValue('B7', $datos['categoria']);

		$activeWorksheet->setCellValue('E6', 'Fecha del documento:');
		$activeWorksheet->setCellValue('E7', $datos['fechaDocumento']);

		$activeWorksheet->setCellValue('B9', 'Nombre del vendedor:');
		$activeWorksheet->setCellValue('B10', $datos['nameVendedor']);

		$activeWorksheet->setCellValue('B12', 'Importe total:');
		$activeWorksheet->setCellValue('B13', $datos['importeTotal']);

		$activeWorksheet->setCellValue('E12', 'Importe del IVA:');
		$activeWorksheet->setCellValue('E13', $datos['importeIVA']);

		$activeWorksheet->setCellValue('B15', 'Descripción:');
		$activeWorksheet->setCellValue('B16', $datos['descripcionGasto']);

		$activeWorksheet->setCellValue('B19', 'Referencia interna:');
		$activeWorksheet->setCellValue('B20', $datos['referenciaInterna']);

		$activeWorksheet->mergeCells('C1:E1');
		$activeWorksheet->mergeCells('A2:D2');
		$activeWorksheet->mergeCells('F2:G2');
		$activeWorksheet->mergeCells('F3:G3');
		$activeWorksheet->mergeCells('B6:C6');
		$activeWorksheet->mergeCells('B7:C7');
		$activeWorksheet->mergeCells('E6:F6');
		$activeWorksheet->mergeCells('E7:F7');
		$activeWorksheet->mergeCells('B9:F9');
		$activeWorksheet->mergeCells('B10:F10');
		$activeWorksheet->mergeCells('B12:C12');
		$activeWorksheet->mergeCells('E12:F12');
		$activeWorksheet->mergeCells('B13:C13');
		$activeWorksheet->mergeCells('E13:F13');
		$activeWorksheet->mergeCells('B15:F15');
		$activeWorksheet->mergeCells('B16:F17');
		$activeWorksheet->mergeCells('B19:F19');
		$activeWorksheet->mergeCells('B20:F20');

		$activeWorksheet->getColumnDimension('A')->setWidth(20);
				// Establecer la altura de la fila 1 (por ejemplo, 25 puntos)
		$activeWorksheet->getRowDimension(1)->setRowHeight(25);

		$activeWorksheet->getColumnDimension('B')->setWidth(20);
		$activeWorksheet->getColumnDimension('C')->setWidth(20);
		$activeWorksheet->getColumnDimension('D')->setWidth(0);
		$activeWorksheet->getColumnDimension('E')->setWidth(20);
		$activeWorksheet->getColumnDimension('F')->setWidth(20);
		$activeWorksheet->getColumnDimension('G')->setWidth(20);

		$activeWorksheet->getStyle('B6:C7')->applyFromArray($borderStyle);
		$activeWorksheet->getStyle('E6:F7')->applyFromArray($borderStyle);
		$activeWorksheet->getStyle('B9:F10')->applyFromArray($borderStyle);
		$activeWorksheet->getStyle('B12:C13')->applyFromArray($borderStyle);
		$activeWorksheet->getStyle('E12:F13')->applyFromArray($borderStyle);
		$activeWorksheet->getStyle('B15:F17')->applyFromArray($borderStyle);
		$activeWorksheet->getStyle('B19:F20')->applyFromArray($borderStyle);

		$activeWorksheet->getStyle('B6:F20')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM)->setColor(new Color('ff949494'));
		$activeWorksheet->getStyle('A2:G3')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM)->setColor(new Color('ff949494'));

		$activeWorksheet->getStyle('A2:G3')->applyFromArray($filleee);
		$activeWorksheet->getStyle('B6:F20')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffffffff');
		$activeWorksheet->getStyle('B6:C6')->applyFromArray($filleee);
		$activeWorksheet->getStyle('E6:F6')->applyFromArray($filleee);
		$activeWorksheet->getStyle('B9:C9')->applyFromArray($filleee);
		$activeWorksheet->getStyle('E9:F9')->applyFromArray($filleee);
		$activeWorksheet->getStyle('B12:C12')->applyFromArray($filleee);
		$activeWorksheet->getStyle('E12:F12')->applyFromArray($filleee);
		$activeWorksheet->getStyle('B15:F15')->applyFromArray($filleee);
		$activeWorksheet->getStyle('B19:F19')->applyFromArray($filleee);

		$activeWorksheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$activeWorksheet->getStyle('C1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

		/*-- Finalización de columnas y  campos --*/
		$writer = new Xlsx($spreadsheet);
		$writer->save('../view/Gastos/excel/'.$datos['idGasto'].".".$datos['nombre'].'.xlsx');

		return $datos['idGasto'].".".$datos['nombre'].'.xlsx';
	}

}