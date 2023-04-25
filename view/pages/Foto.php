<?php
$empleado = ControladorFormularios::ctrVerEmpleados("idEmpleados", $_POST["empleado"]); 
?>
<link rel="stylesheet" href="assets/libs/css/archivo.css">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Subir Fotografía</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="inicio" class="breadcrumb-link">Tablero</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="Alumnos" class="breadcrumb-link">Alumnos</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Subir Fotografía</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-5">
                        <div class="card-body">

                            <form method="POST" enctype="multipart/form-data">

                            <?php 

                                /*=============================================
                                FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
                                =============================================*/

                                $registro = ControladorFormularios::ctrSubirFoto();
                                if($registro == "ok"){

                                    echo '<script>

                                        if ( window.history.replaceState ) {

                                            window.history.replaceState( null, null, window.location.href );

                                        }

                                    </script>';

                                    echo '<div class="alert alert-success">¡Foto Subida Exitosamente!</div>';
                                
                                }

                                if($registro == "error"){

                                    echo '<script>

                                        if ( window.history.replaceState ) {

                                            window.history.replaceState( null, null, window.location.href );

                                        }

                                    </script>';

                                    echo '<div class="alert alert-danger">Error, no se pudo subir la foto, intente de nuevo</div>';

                                }

                                ?>

                            <div class="row">
                                <div class="form-container col-12">
                                    <label class="image_label pr-2 pl-5" for="image-upload">Selecciona una imagen:</label>
                                    <input class="pr-2 mr-5" type="file" id="image-upload" name="image-upload" accept=".jpg,.jpeg,.png">
                                    <input type="hidden" name="name" value="<?php echo $empleado['name'] ?>">
                                    <input type="hidden" name="lastname" value="<?php echo $empleado['lastname'] ?>">
                                    <input type="hidden" name="idEmpleado" value="<?php echo $empleado['idEmpleados'] ?>">
                                    <div class="image-preview-container pl-5 pr-5">
                                        <div id="image-preview" class="image-preview">
                                            <img id="preview-img" src="#" alt="Vista previa de la imagen" style="object-fit: contain; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <center>
                                    <button type="submit" class="btn btn-primary rounded col-6">Subir foto</button>
                                </center>

                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

        </div>

<script src="assets/libs/js/preview.js"></script>