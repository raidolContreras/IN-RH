<div class="card-side-nav col-xl-2 col-lg-3 col-md-4 col-3 lista-ajustes">
	<?php
	// Define un arreglo de páginas y nombres
	$paginas = array();

	// Verifica si la condición se cumple y agrega una página para Divisas
	if (!empty($rol) && $rol['Configuracion_Divisas'] == 1) {
		$paginas['Configuraciones-Divisas'] = 'Divisas';
	}

	// Verifica si la condición se cumple y agrega una página para Categorías
	if (!empty($rol) && $rol['Configuracion_Categorias'] == 1) {
		$paginas['Configuraciones-Categorias'] = 'Categorías';
	}

	// Verifica si la condición se cumple y agrega una página para Permisos
	if (!empty($rol) && $rol['Configuracion_Permisos'] == 1) {
		$paginas['Configuraciones-Roles'] = 'Permisos';
	}


	// Itera sobre el arreglo de páginas y nombres
	foreach ($paginas as $pagina => $nombre) {
		$isActive = (isset($_GET['pagina']) && $_GET['pagina'] === $pagina) ? 'active' : '';
	?>
		<div>
			<a href="<?php echo $pagina; ?>" class="btn btn-block btn-in-consulting-link <?php echo $isActive; ?>">
				<?php echo $nombre; ?>
			</a>
		</div>
	<?php
	}
	?>
</div>
