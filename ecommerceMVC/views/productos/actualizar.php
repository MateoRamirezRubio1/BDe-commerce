<main>
    <h1>Actualizar Producto</h1>

    <a href="/admin">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div>
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST">

        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Actualizar Propiedad">
    </form>
</main>