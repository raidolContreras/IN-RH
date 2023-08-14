<?php $empleados = ControladorEmpleados::ctrVerEmpleados(null, null) ?>
<section class="dashboard-content">
    <div class="container">
        <div class="card rounded-card">
            <header class="card-header">
                <h2 class="m-0">Análisis e Informes de Recursos Humanos</h2>
            </header>
        </div>
        <div class="card p-4">
            <section class="row">
                <article class="col-md-6">
                    <div class="analysis-item">
                        <h3>Informe de Empleados</h3>
                        <p>Resumen detallado de la información clave de los empleados.</p>
                        <a href="#" class="btn btn-primary">Ver Informe</a>
                    </div>
                </article>
                <article class="col-md-6">
                    <div class="analysis-item">
                        <h3>Análisis de Rotación</h3>
                        <p>Explora las tasas de rotación para tomar decisiones estratégicas.</p>
                        <a href="#" class="btn btn-primary">Ver Análisis</a>
                    </div>
                </article>
            </section>
        </div>
        <div class="card p-4 mt-4">
            <h3>Tabla de Datos de Rendimiento de Empleados</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Departamento</th>
                            <th>Salario</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php foreach ($empleados as $empleado): 
                    		$nombre = $empleado['lastname']." ".$empleado['name'];
                    		$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $empleado['idEmpleados']);
                    		$depa = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']);
                    		?>
                        <tr>
                            <td><?php echo mb_strtoupper($nombre, 'UTF-8') ?></td>
                            <td><?php echo mb_strtoupper($depa['nameDepto'], 'UTF-8') ?></td>
                            <td><?php echo ControladorFormularios::formatearNumero($puesto['salario'], 'MXN') ?></td>
                        </tr>
                    	<?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>