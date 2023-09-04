<div class="card-side-nav col-xl-2 col-lg-3 col-md-4 col-3 lista-ajustes">
    <?php
    // Define un arreglo de páginas y nombres
    $paginas = array(
        'Configuraciones-Divisas' => 'Divisas',
        'Configuraciones-Categorias' => 'Categorías',
        'Configuraciones-Roles' => 'Permisos'
    );

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
