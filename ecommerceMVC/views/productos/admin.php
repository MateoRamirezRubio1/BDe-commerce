<main>
    <h1>Administrador de E-Commerce</h1>
    <?php if (intval($resultado) == 1) : ?>
        <p> Producto Creado Correctamente</p>
    <?php elseif (intval($resultado) == 2) : ?>
        <p> Producto Actualizado Correctamente</p>
    <?php elseif (intval($resultado) == 3) : ?>
        <p> Producto Eliminado Correctamente</p>
    <?php endif; ?>

    <a href="/BDe-commerce/ecommerceMVC/public/index.php/productos/crear">Nuevo Producto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($productos as $producto) : ?>
                <tr>
                    <td><?php echo $producto->id; ?></td>
                    <td><?php echo $producto->sku; ?></td>
                    <td><?php echo $producto->name; ?></td>
                    <td><?php echo $producto->price; ?></td>
                    <td>
                        <form method="POST" action="/BDe-commerce/ecommerceMVC/public/index.php/productos/eliminar">
                            <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                            <input type="submit" value="Eliminar">
                        </form>
                        <a href="/BDe-commerce/ecommerceMVC/public/index.php/productos/actualizar?id=<?php echo $producto->id; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>