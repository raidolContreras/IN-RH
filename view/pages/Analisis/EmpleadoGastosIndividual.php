
<style>
    #gastosChart {
        width: 100%;
        max-height: 300px;
    }

    .permisos-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .permisos-table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    .permisos-table th,
    .permisos-table td {
        padding: 12px;
        text-align: center;
    }

    .permisos-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .permisos-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
<div class="container-fluid dashboard-content">
    <div class="card col-12 p-4 row">

<?php if (isset($_GET['informe'])): 
	$informe = $_GET['informe'];
	$gastos = ControladorAnalisis::gasto($informe); ?>
        <h3>Tabla de Datos de Gastos</h3>
        <div class="col-12">
            <center>
                <div class="card">
                    <div class="card-body" style="max-height: 400px">
                        <canvas id="gastosChart">
                            <p>Gastos</p>
                        </canvas>
                    </div>
                </div>
            </center>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped vacaciones-table analisis">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Descripción</th>
                        <th>Vendedor</th>
                        <th>Total de Gastos</th>
                        <th>Tipo de Gasto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gastos as $gasto) : ?>
                        <tr>
                            <td><?php echo $gasto['nombre'] ?></td>
                            <td><?php echo $gasto['Descripción'] ?></td>
                            <td><?php echo $gasto['Vendedor'] ?></td>
                            <td><?php echo ControladorFormularios::formatearNumero($gasto['Total_de_Gastos'], $gasto['Divisa']) ?></td>
                            <td><?php echo $gasto['Tipo_de_Gasto'] ?></td>
                            <td><?php echo $gasto['Status'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('gastosChart');

    function actualizarGrafico(data) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Aprobados', 'Rechazados', 'Pendientes', 'Pagados'],
                datasets: [{
                    label: 'Cantidad de Gastos',
                    data: data,
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(220, 53, 69, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(0, 123, 255, 0.8)'
                    ],
                    borderRadius: 5,
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Gastos',
                        padding: {
                            top: 20,
                            bottom: 20
                        },
                        font: {
                            size: 24,
                            weight: 'bold',
                            family: 'Arial, sans-serif'
                        },
                        color: 'rgba(0, 0, 0, 0.8)'
                    },
                    tooltips: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        bodyFont: {
                            size: 14,
                            weight: 'bold',
                            family: 'Arial, sans-serif'
                        },
                        titleFont: {
                            size: 16,
                            weight: 'bold',
                            family: 'Arial, sans-serif'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e0e0e0'
                        },
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });
    }

    // Llamada AJAX para obtener datos y actualizar el gráfico
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `ajax/gastos.contador.php?informe=${encodeURIComponent(<?php echo $informe; ?>)}`, true); // Aquí pasamos el valor de $informe a la URL
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const responseData = JSON.parse(xhr.responseText);
                const data = [responseData.Aprobados, responseData.Rechazados, responseData.Pendientes, responseData.Pagados];
                actualizarGrafico(data);
            } else {
                console.error('Error en la solicitud AJAX');
            }
        }
    };
    xhr.send();
</script>
<?php else: 
	$empleados = ControladorAnalisis::empleadosGasto();
	?>

        <h3>Selecciona un empleado a analizar</h3>

        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped vacaciones-table analisis">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>N° de gastos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado) : ?>
                        <tr>
                            <td><a class="btn btn-in-consulting" href="Analisis-EmpleadoGastosIndividual&informe=<?php echo $empleado['idEmpleados'] ?>"><span><?php echo $empleado['nombre'] ?></span></a></td>
                            <td><?php echo $empleado['Numero_de_Gastos'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

<?php endif ?>

    </div>
</div>