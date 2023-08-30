<?php
$reunionId = isset($_GET['reunion']) ? $_GET['reunion'] : null;
$isEvaluado = isset($_GET['Evaluado']) && $_GET['Evaluado'] == true;
$reuniones = ControladorFormularios::ctrVerReuniones("idReuniones", $reunionId);
$postulante = ControladorFormularios::ctrVerPostulantes("idPostulantes", $reuniones['Postulantes_idPostulantes']);
?>

<style>
    /* Estilos CSS personalizados */
    .custom-form-label {
        font-weight: bold;
    }

    .custom-form-group {
        margin-bottom: 20px;
    }

    .custom-textarea {
        resize: none;
    }

    .custom-card {
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-top: 50px;
    }

    .custom-header {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .custom-submit-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-submit-button:hover {
        background-color: #0056b3;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card custom-card">
                <div class="card-body">
                    <div id="form-result"></div>
                    <h1 class="custom-header">Encuesta del entrevistador</h1>

                    <form method="POST" id="reunion-form">
                        <div class="custom-form-group">
                            <label for="pregunta1" class="custom-form-label">Calificación para la preparación del entrevistado</label>
                            <select class="form-control" id="pregunta1" name="pregunta1" required<?= $isEvaluado ? ' disabled' : '' ?>>
                                <option value="" disabled <?= $isEvaluado ? '' : 'selected' ?>>Seleccione una opción</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= $reuniones['pregunta1'] == $i ? 'selected' : '' ?>>
                                        <?= ($i == 1) ? 'Excelente' : (($i == 2) ? 'Bueno' : (($i == 3) ? 'Regular' : (($i == 4) ? 'Malo' : 'Muy malo'))) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="custom-form-group">
                            <label for="pregunta2" class="custom-form-label">Calificación para la actitud del entrevistado</label>
                            <select class="form-control" id="pregunta2" name="pregunta2" required<?= $isEvaluado ? ' disabled' : '' ?>>
                                <option value="" disabled <?= $isEvaluado ? '' : 'selected' ?>>Seleccione una opción</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= $reuniones['pregunta2'] == $i ? 'selected' : '' ?>>
                                        <?= ($i == 1) ? 'Excelente' : (($i == 2) ? 'Bueno' : (($i == 3) ? 'Regular' : (($i == 4) ? 'Malo' : 'Muy malo'))) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="custom-form-group">
                            <label for="pregunta3" class="custom-form-label">Calificación para la calidad de las respuestas</label>
                            <select class="form-control" id="pregunta3" name="pregunta3" required<?= $isEvaluado ? ' disabled' : '' ?>>
                                <option value="" disabled <?= $isEvaluado ? '' : 'selected' ?>>Seleccione una opción</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= $reuniones['pregunta3'] == $i ? 'selected' : '' ?>>
                                        <?= ($i == 1) ? 'Excelente' : (($i == 2) ? 'Bueno' : (($i == 3) ? 'Regular' : (($i == 4) ? 'Malo' : 'Muy malo'))) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="custom-form-group">
                            <label for="pregunta4" class="custom-form-label">¿Recomendaría contratar al entrevistado?</label>
                            <select class="form-control" id="pregunta4" name="pregunta4" required<?= $isEvaluado ? ' disabled' : '' ?>>
                                <option value="" disabled <?= $isEvaluado ? '' : 'selected' ?>>Seleccione una opción</option>
                                <?php for ($i = 1; $i <= 3; $i++): ?>
                                    <option value="<?= $i ?>" <?= $reuniones['pregunta4'] == $i ? 'selected' : '' ?>>
                                        <?= ($i == 1) ? 'Sí, definitivamente' : (($i == 2) ? 'No estoy seguro' : 'No, definitivamente no') ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="custom-form-group">
                            <label for="comentariosReunion" class="custom-form-label">Comentarios adicionales sobre el entrevistado</label>
                            <textarea class="form-control custom-textarea" id="comentariosReunion" name="comentariosReunion" rows="3"<?= $isEvaluado ? ' disabled' : '' ?>><?= $isEvaluado ? $reuniones['comentariosReunion'] : '' ?></textarea>
                        </div>
                        <?php if (!$isEvaluado): ?>
                            <input type="hidden" name="reunion" value="<?= $reunionId ?>">
                            <input type="hidden" name="postulante" value="<?= $reuniones['Postulantes_idPostulantes'] ?>">
                            <button id="submit-btn" type="submit" class="btn btn-primary custom-submit-button">Enviar</button>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!$isEvaluado): ?>
<script>
    $(document).ready(function() {
        $("#reunion-form").submit(function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            var formData = $(this).serialize(); // Obtener los datos del formulario

            $.ajax({
                url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.indexOf('ok') !== -1) {
                        // El servidor ha devuelto "ok" o alguna cadena que contenga "ok"
                        $("#reunion-form")[0].reset(); // Reiniciar el formulario
                        $("#form-result").parent().append(`
                            <div class='alert alert-success'>Se calificó la reunión con éxito</div>
                        `);
                        setTimeout(function() {
                            window.location.href = "Reuniones&Evaluado=true&reunion=<?= $reunionId ?>";
                        }, 500);
                    } else {
                        // El servidor ha devuelto algo diferente a "ok"
                        $("#form-result").parent().append(`
                            <div class='alert alert-danger'><b>Error</b>, al calificar la reunión, intenta nuevamente</div>
                        `);
                    }
                }
            });
        });
    });
</script>
<?php endif ?>
