<main>
    <h1>Crear Nuevo Producto</h1>

    <a href="/BDe-commerce/ecommerceMVC/public/index.php/admin">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div>
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST">

        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Agregar Producto">
    </form>
</main>