<?php

use App\Producto;

session_start();

$productos = Producto::all();


if ($_GET) {
    $_SESSION['idCategoria'] = $_GET['categoria'] ?? '';
    $_SESSION['nombreCategoria'] = $_GET['nombre'] ?? '';
}

$precioMin = $_POST['precioMinimo'] ?? '';
$precioMax = $_POST['precioMaximo'] ?? '';
$buscarNombre = $_POST['buscar'] ?? '';

$filtros = [
    "categoria" => $_SESSION['idCategoria'],
    "precio" => $precioMax === '' && $precioMin === '' ? '' : [$precioMin, $precioMax],
    "buscar" => $buscarNombre,
];


$productosCategoria = Producto::aplicarFiltros($filtros);
?>

<section>
    <?php if ($_SESSION['idCategoria'] == -1) : ?>
        <h2>Todos los Productos</h2>
    <?php
    endif;
    if ($_SESSION['idCategoria'] != -1) :
    ?>
        <h2>Productos de <?php echo $_SESSION['nombreCategoria'] ?></h2>
    <?php endif; ?>

    <?php foreach ($productosCategoria as $producto) :
        echo $producto->sku;
        echo $producto->name;
        echo $producto->price;
    ?>
        <hr>
    <?php
    endforeach;

    ?>
</section>
</main>


</body>

</html>