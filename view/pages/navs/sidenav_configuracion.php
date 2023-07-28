<div class="card-side-nav col-xl-2 col-lg-3 col-md-4 col-3 lista-ajustes">
	<div>
	<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Configuraciones-Divisas'))): ?>
		<a href="Configuraciones-Divisas" class="btn btn-block btn-in-consulting-link active">
	<?php else: ?>
		<a href="Configuraciones-Divisas" class="btn btn-block btn-in-consulting-link">
	<?php endif ?>
			Divisas
		</a>
	</div>
	<div>
	<?php if (isset($_GET['pagina']) && in_array($_GET['pagina'], array('Configuraciones-Categorias'))): ?>
		<a href="Configuraciones-Categorias" class="btn btn-block btn-in-consulting-link active">
	<?php else: ?>
		<a href="Configuraciones-Categorias" class="btn btn-block btn-in-consulting-link">
	<?php endif ?>
			Categorías
		</a>
	</div>
</div>
