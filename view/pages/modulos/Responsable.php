<?php 

$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $_SESSION['idEmpleado']);
$departamento = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']);
$jefeDirecto = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $departamento['Empleados_idEmpleados']);
$foto = ControladorEmpleados::ctrVerEmpleados("Empleados_idEmpleados", $jefeDirecto['idEmpleados']);
?>
<p class="titulo-tablero titulo">Mi grupo de trabajo</p>
<hr class="titulo">
<div class="row">
	<div class="col-12 mt-2">
		<?php 
			if ($jefeDirecto['idEmpleados'] == $_SESSION['idEmpleado']) {
				echo '<p class="titulo-sup m-0">Sin jefe directo</p>';
			}else{ 
		?>

			<p class="subtitulo-tablero titulo">Mi responsable</p>
		<div class="row">
			<button class="btn btn-link float-left">

				<?php if (isset($foto['namePhoto'])): ?>
					<img src="view/fotos/thumbnails/<?php echo $foto['namePhoto'] ?>"
				<?php else: ?>
					<?php if ($jefeDirecto['genero']==1): ?>
						<img src="assets/images/Ejecutivo.webp"
					<?php else: ?>
						<img src="assets/images/Ejecutiva.webp"
					<?php endif ?>
				<?php endif ?>

					 	size="large"  alt="User Avatar" class="rounded-circle user-avatar-xl2">
			</button>
		</div>

		<?php 
			}
		?>
	</div>
</div>