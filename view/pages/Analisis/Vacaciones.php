<?php if (!empty($rol) && $rol['Ver_Analisis'] == 1): ?>
<?php $vacaciones = ControladorAnalisis::vacaciones(); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    #myVacacionesChart {
        width: 100%;
        max-height: 300px;
    }

    .vacaciones-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .vacaciones-table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    .vacaciones-table th,
    .vacaciones-table td {
        padding: 12px;
        text-align: center;
    }

    .vacaciones-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .vacaciones-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<div class="container-fluid dashboard-content">
    <div class="card col-12 p-4 row">
        <h3 class="mb-4">Tabla de Datos de Vacaciones</h3>
        <div class="col-12">
            <center>
                <div class="card vacaciones-card">
                    <div class="card-body">
                        <canvas id="myVacacionesChart"></canvas>
                    </div>
                </div>
            </center>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped vacaciones-table analisis">
                <thead>
                    <tr>
                        <th>EMPLEADO</th>
                        <th>FECHA DE INICIO</th>
                        <th>FECHA DE FIN</th>
                        <th>FECHA DE SOLICITUD</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vacaciones as $vacacion): ?>
                        <tr>
                            <td><?php echo $vacacion['nombre'] ?></td>
                            <td><?php echo $vacacion['fecha_inicio_vacaciones'] ?></td>
                            <td><?php echo $vacacion['fecha_fin_vacaciones'] ?></td>
                            <td><?php echo $vacacion['fecha_solicitud'] ?></td>
                            <td><?php echo $vacacion['Estado'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const ctxVacaciones = document.getElementById('myVacacionesChart');

    function actualizarGraficoVacaciones(data) {
        new Chart(ctxVacaciones, {
            type: 'bar',
            data: {
                labels: ['Aceptados', 'Rechazados', 'Pendientes'],
                datasets: [{
                    label: 'Total de Peticiones',
                    data: data,
                    data: data,backgroundColor: [
                        'rgba(52, 152, 219, 0.8)', // Azul con 80% de opacidad
                        'rgba(231, 76, 60, 0.8)',  // Rojo con 80% de opacidad
                        'rgba(243, 156, 18, 0.8)'  // Amarillo con 80% de opacidad
                    ],

                    hoverBackgroundColor: ['#217AB6', '#C53E30', '#C9851A'],
                    borderRadius: 5,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Estado de Vacaciones',
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
			                stepSize: 1, // Aquí ajustamos el paso a 1 para mostrar solo números enteros
			                precision: 0 // Aquí establecemos la precisión en 0 para evitar decimales
			            }
			        }
			    }
            }
        });
    }

    // Llamada AJAX para obtener datos y actualizar el gráfico de vacaciones
    const xhrVacaciones = new XMLHttpRequest();
    xhrVacaciones.open('GET', 'ajax/vacaciones.contador.php', true);
    xhrVacaciones.onreadystatechange = function () {
        if (xhrVacaciones.readyState === XMLHttpRequest.DONE) {
            if (xhrVacaciones.status === 200) {
                const responseDataVacaciones = JSON.parse(xhrVacaciones.responseText);
                const dataVacaciones = [responseDataVacaciones.Aprobados, responseDataVacaciones.Rechazados, responseDataVacaciones.Pendientes];
                actualizarGraficoVacaciones(dataVacaciones);
            } else {
                console.error('Error en la solicitud AJAX');
            }
        }
    };
    xhrVacaciones.send();
</script>
<?php else: ?>
    <script>
        window.location.href = 'Inicio';
    </script>
<?php endif ?>