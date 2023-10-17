<?php

	$diasCotizados = 15; // Ejemplo de número de días cotizados
	$porcentajeRetencionIMSS = 2.38; // Ejemplo de porcentaje de retención IMSS

	// Función para formatear un número con el símbolo de moneda
	function formatearNumero($numero) {
		$numero = ControladorFormularios::formatearNumero($numero, 'MXN');
		return $numero;
	}

	if (!isset($_GET['Empleado'])): 
	$empleados = ControladorEmpleados::ctrVerEmpleados(null,null);
?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card menu-ajustes">
				<div class="card-body">
					<div class="tab-content" id="myTabContent">
						<?php if (!empty($empleados)): ?>
							<div class="tab-pane fade show active" id="card-1" role="tabpanel" aria-labelledby="general">
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered nomina" style="width:100%; height:100%">
										<thead>
											<tr>
												<th>NOMBRE COMPLETO</th>
                                                <th>SALARIO QUINCENAL (BRUTO)</th>
                                                <th>SUBSIDIO</th>
                                                <th>I.M.S.S.</th>
                                                <th>I.S.R.</th>
                                                <th>SALARIO QUINCENAL (NETO)</th>
                                                <th>VER NÓMINAS</th>
											</tr>
										</thead>
										<tbody style="font-size: 12px !important">
										<?php foreach ($empleados as $value):
											if ($value['status'] == 1):

												$credito = ControladorEmpleados::ctrVerCredito($value['idEmpleados']);
												$puesto = ControladorFormularios::ctrVerPuestos('Empleados_idEmpleados', $value['idEmpleados']);
												$quincena = $puesto['salario_integrado'] * $diasCotizados;

												$retencionIMSS = ControladorEmpleados::calcularRetencionIMSS($quincena, $diasCotizados, $porcentajeRetencionIMSS);

												$ISR = ControladorEmpleados::calcularISR($quincena);
												$subsidios = ControladorEmpleados::obtenerSubsidios($quincena);
												$cuotaFija = formatearNumero($subsidios['cuotaFija']);
												$salFinal = $quincena - $ISR + floatval($cuotaFija);

												$neto = $quincena - $ISR;
												$ISRFormateado = formatearNumero($ISR);

												$datoSeguro = "$" . number_format($retencionIMSS, 2);

												$neto = $neto - $retencionIMSS;


												$quincenaFormateada = formatearNumero($quincena);
												$netoFormateado = formatearNumero($neto);

											?>
											<tr>
												<td>
													<?php echo mb_strtoupper($value['lastname'].' '.$value['name'], 'UTF-8'); ?>
												</td>
												<td><?php echo $quincenaFormateada ?></td>
												<td><?php echo $cuotaFija ?></td>
												<td><?php echo $datoSeguro ?></td>
												<td><?php echo $ISRFormateado ?></td>
												<td><?php echo $netoFormateado ?></td>
												<td>
													<a class="btn btn-link" href="Nominas&Empleado=<?php echo $value['idEmpleados'];?>">
														<i class=" fas fa-arrow-right"></i>
													</a>
												</td>
											</tr>
											<?php endif;
											endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php else: 

// Obtener datos del empleado y crédito del empleado
$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados', $_GET['Empleado']);

$dExtra = 0;

if (date('d') <= 15) {
    $month = date('m') - 1;
    if ($month == 0) {
        $month = 12;
        $year = date('Y') - 1;
    } else {
        $year = date('Y');
    }
    $fechaInicio = "$year-$month-16";
    $fechaFin = "$year-$month-30";
    $fechaNomina = "30-$month-$year";
} else {
    $fechaInicio = date('Y-m-01');
    $fechaFin = date('Y-m-16');
    $fechaNomina = date('Y-m-15');
}

$asistenciasTotales = ControladorEmpleados::ctrCalcularFaltasEmpleado($_GET['Empleado'], $fechaInicio, $fechaFin);

if ($asistenciasTotales['diasNetos'] == $asistenciasTotales['diasAsistidos']) {
    $diasCotizados = 15;
} elseif ($asistenciasTotales['diasNetos'] < $asistenciasTotales['diasAsistidos']) {
    $diastotales = $asistenciasTotales['diasAsistidos'] - $asistenciasTotales['diasNetos'];
    $diasCotizados = 15 + ($diastotales * 2);
    $dExtra = 1;
} elseif($asistenciasTotales['diasNetos'] > $asistenciasTotales['diasAsistidos']) {
	$diasCotizados = $asistenciasTotales['diasAsistidos'];
    $diastotales = 0;
}

// Calcular la quincena
$quincenaBruta = $empleado['salario_integrado'] * 15;
$quincena = $empleado['salario_integrado'] * $diasCotizados;

$Extra = $dExtra ? ($quincena - $quincenaBruta) : 0;

$ISR = ControladorEmpleados::calcularISR($quincena);
$subsidios = ControladorEmpleados::obtenerSubsidios($quincena);
$cuotaFija = formatearNumero($subsidios['cuotaFija']);

$salFinal = $quincena - $ISR + floatval($cuotaFija);

$fechaNominaFormateada = ControladorFormularios::ctrFormatearFechaNomina($fechaNomina);

$retencionIMSS = ControladorEmpleados::calcularRetencionIMSS($quincena, $diasCotizados, $porcentajeRetencionIMSS);

$salFinal -= $retencionIMSS;
?>
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    <div class="float-right">
                        <h3 class="mb-0">Nomina</h3>
                        <?php echo "Fecha: " . $fechaNominaFormateada; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <table class="table">
                                <tr>
                                    <td colspan="2">
                                        <h3 class="text-dark mb-1">
                                            <?php echo "{$empleado['idEmpleados']} - {$empleado['lastname']} {$empleado['name']}"; ?>
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>RFC:</td>
                                    <td><?php echo mb_strtoupper($empleado['RFC']); ?></td>
                                </tr>
                                <tr>
                                    <td>CURP:</td>
                                    <td><?php echo mb_strtoupper($empleado['CURP']); ?></td>
                                </tr>
                                <tr>
                                    <td>Fecha ini Relación Lab:</td>
                                    <td><?php echo date('d/m/Y', strtotime($empleado['fecha_contratado'])); ?></td>
                                </tr>
                                <tr>
                                    <td>NSS:</td>
                                    <td><?php echo $empleado['NSS']; ?></td>
                                </tr>
                                <tr>
                                    <td>Domicilio Fiscal:</td>
                                    <td><?php echo $empleado['CP']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="50%" colspan="2" style="text-align:center;">Percepciones</th>
                                    <th width="50%" colspan="2" style="text-align:center;">Deducciones</th>
                                </tr>
                                <tr>
                                    <th style="text-align:left;">Concepto</th>
                                    <th style="text-align:right;">Total</th>
                                    <th style="border-left: 2px solid #e6e6f2;text-align:left;">Concepto</th>
                                    <th style="text-align:right;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sueldo</td>
                                    <td style="text-align:right;"><?php echo formatearNumero($quincenaBruta)."(".formatearNumero($quincena).")"; ?></td>
                                    <td style="border-left: 2px solid #e6e6f2;">I.M.S.S.</td>
                                    <td style="text-align:right;"><?php echo formatearNumero($retencionIMSS); ?></td>
                                </tr>
                                <?php if ($dExtra == 1): ?>
                                    <tr>
                                        <td>Extra</td>
                                        <td style="text-align:right;"><?php echo formatearNumero($Extra); ?></td>
                                        <td style="border-left: 2px solid #e6e6f2;">I.S.R. mes</td>
                                        <td style="text-align:right;"><?php echo formatearNumero($ISR); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Subsidio</td>
                                        <td style="text-align:right;"><?php echo $cuotaFija; ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td>Subsidio</td>
                                        <td style="text-align:right;"><?php echo $cuotaFija; ?></td>
                                        <td style="border-left: 2px solid #e6e6f2;">I.S.R. mes</td>
                                        <td style="text-align:right;"><?php echo formatearNumero($ISR); ?></td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-clear">
                            <tr>
                                <th width="25%"></th>
                                <th width="25%"></th>
                                <th width="25%" style="border-left: 2px solid #e6e6f2;text-align:left;"></th>
                                <th width="25%"></th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;">
                                        <strong class="text-dark">Total Percepc. más Otros Pagos</strong>
                                    </td>
                                    <td style="text-align:right;">
                                        <strong class="text-dark"><?php echo formatearNumero($quincena); ?></strong>
                                    </td>
                                    <td style="border-left: 2px solid #e6e6f2;text-align:left;">
                                        <strong class="text-dark">Subtotal</strong>
                                    </td>
                                    <td style="text-align:right;">
                                        <strong class="text-dark"><?php echo formatearNumero($quincena); ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>
                                        <strong class="text-dark">Descuentos</strong>
                                    </td>
                                    <td style="text-align:right;">
                                        <strong class="text-dark"><?php echo formatearNumero($retencionIMSS); ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>
                                        <strong class="text-dark">Retenciones</strong>
                                    </td>
                                    <td style="text-align:right;">
                                        <strong class="text-dark"><?php echo formatearNumero($ISR); ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>
                                        <strong class="text-dark">Total</strong>
                                    </td>
                                    <td style="text-align:right;">
                                        <strong class="text-dark"><?php echo formatearNumero($salFinal); ?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php endif ?>